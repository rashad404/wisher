// Run with PLAYWRIGHT_MODULE pointing to an existing Playwright installation.
// Every context blocks analytics before any navigation, including popups.
const {chromium}=require(process.env.PLAYWRIGHT_MODULE);
const fs=require('node:fs');
const assert=require('node:assert/strict');
const base='https://wisher.az';
const out=process.env.SCREENSHOT_DIR||'docs/screenshots/deploy-v2';
(async()=>{
 fs.mkdirSync(out,{recursive:true});
 const browser=await chromium.launch({headless:true,executablePath:'/Applications/Google Chrome.app/Contents/MacOS/Google Chrome'});
 const report={pages:[],checks:[],errors:[]};
 try {
  for(const width of [1440,375]) {
   const context=await browser.newContext({viewport:{width,height:width===1440?1000:812},serviceWorkers:'block'});
   await context.route('**/*',route=>{
    const u=new URL(route.request().url());
    if(/(^|\.)(googletagmanager\.com|google-analytics\.com|analytics\.google\.com|doubleclick\.net|connect\.facebook\.net|facebook\.com|clarity\.ms|hotjar\.com|segment\.(com|io)|plausible\.io|mixpanel\.com|amplitude\.com)$/.test(u.hostname)||/\/(collect|analytics|metrics)(\/|$)/.test(u.pathname))return route.abort();
    return route.continue();
   });
   const page=await context.newPage();
   page.on('pageerror',e=>report.errors.push({url:page.url(),message:e.message}));
   for(const path of ['/','/gifts','/gifts/1','/wishes','/companies','/about','/faq','/privacy','/terms','/user','/missing-wisher-page']) {
    const response=await page.goto(base+path,{waitUntil:'networkidle',timeout:45000});
    assert.equal(response.status(),path==='/missing-wisher-page'?404:200,path);
    if(path==='/user') {
     await page.getByRole('heading',{name:'Yaxınlarınızın özəl günləri bir yerdə',exact:true}).waitFor();
     assert.equal(await page.locator('.account-tabs').count(),0);
     assert.equal(await page.getByRole('button',{name:'kimlik.az ilə daxil ol',exact:true}).isVisible(),true);
    }
    await page.evaluate(()=>document.fonts.ready);
    await page.evaluate(()=>document.querySelectorAll('img').forEach(img=>{img.loading='eager'}));
    await page.waitForFunction(()=>Array.from(document.images).every(img=>img.complete),{},{timeout:15000});
    await page.locator('main').first().waitFor({timeout:10000}).catch(()=>{});
    const overflow=await page.evaluate(()=>document.documentElement.scrollWidth>innerWidth+1);
    const file=(path==='/'?'home':path.slice(1).replaceAll('/','-'))+'-'+width+'.png';
    await page.screenshot({path:out+'/'+file,fullPage:true});
    report.pages.push({path,width,status:response.status(),overflow,screenshot:file,title:await page.title()});
    assert.equal(overflow,false,'Horizontal overflow: '+path+' at '+width);
   }
   if(width===1440) {
    for(const path of ['/az/concepts/a','/concepts/logos.html','/concepts/wish-candle.html']) {
     const response=await context.request.get(base+path);assert.equal(response.status(),404,path);report.checks.push({path,status:response.status()});
    }
    for(const path of ['/login','/register']) {
     const response=await context.request.get(base+path,{maxRedirects:0});assert.equal(response.status(),308);assert.equal(response.headers().location,'/user');report.checks.push({path,status:308,destination:'/user'});
    }
    const conf=await (await context.request.get(base+'/api/workspace/config')).json();
    assert.equal(conf.demo,false);assert.equal(conf.provider,'deepseek');assert.equal(conf.kimlik_ready,true);report.checks.push({config:conf});
    const demo=await context.request.post(base+'/api/workspace/auth/demo',{headers:{Origin:base},data:{}});assert.equal(demo.status(),404);report.checks.push({demoEndpoint:404});
    const catalog=await (await context.request.get(base+'/api/workspace/catalog')).json();
    assert.equal(catalog.total,5);assert.equal(catalog.data.some(x=>/watering can/i.test(x.title)),false);report.checks.push({products:catalog.total});
    const robots=await (await context.request.get(base+'/robots.txt')).text();assert.match(robots,/Allow: \/\n/);assert.match(robots,/Sitemap: https:\/\/wisher.az\/sitemap.xml/);
    const sitemap=await (await context.request.get(base+'/sitemap.xml')).text();assert.match(sitemap,/<loc>https:\/\/wisher.az\/gifts<\/loc>/);
    report.checks.push({robots:true,sitemap:true});
    await page.goto(base,{waitUntil:'networkidle'});
    const popupPromise=page.waitForEvent('popup');await page.getByRole('link',{name:'Daxil ol',exact:true}).click();const popup=await popupPromise;
    await popup.waitForURL(/^https:\/\/kimlik\.az\//,{timeout:20000});
    const u=new URL(popup.url());assert.equal(u.searchParams.get('redirect_uri'),base+'/az/auth/kimlik/callback');
    report.checks.push({kimlikHost:u.hostname,callback:u.searchParams.get('redirect_uri'),pkce:u.searchParams.get('code_challenge_method')});
    await popup.close();
   } else {
    await page.goto(base,{waitUntil:'networkidle'});
    await page.getByRole('button',{name:'Menyunu aç'}).click();assert.equal(await page.locator('dialog').isVisible(),true);
    await page.screenshot({path:out+'/menu-375.png'});await page.getByRole('button',{name:'Bağla',exact:true}).click();report.checks.push({mobileMenu:true});
   }
   await context.close();
  }
  assert.deepEqual(report.errors,[]);
 } finally {fs.writeFileSync(process.env.CHECK_REPORT||'docs/evidence/deploy-v2-checks.json',JSON.stringify(report,null,2)+'\n');await browser.close();}
 console.log(JSON.stringify({pages:report.pages.length,checks:report.checks,errors:report.errors},null,2));
})().catch(e=>{console.error(e.message);process.exitCode=1});
