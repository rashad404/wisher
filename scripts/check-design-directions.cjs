const {chromium}=require('/Users/macmini/projects/elek/frontend/node_modules/playwright');
const fs=require('node:fs');const assert=require('node:assert/strict');
(async()=>{
 const browser=await chromium.launch({executablePath:'/Applications/Google Chrome.app/Contents/MacOS/Google Chrome',headless:true});const page=await browser.newPage({reducedMotion:'reduce'});const errors=[];page.on('pageerror',e=>errors.push(e.message));const results=[];
 for(const width of [1440,375])for(const direction of ['a','b','c']){
  await page.setViewportSize({width,height:width===375?812:900});await page.goto(`http://localhost:3022/az/concepts/${direction}`);await page.evaluate(()=>document.fonts.ready);await page.evaluate(()=>Promise.all([...document.images].map(i=>i.decode())));
  const checks=await page.evaluate(()=>{
   const visible=e=>e.getClientRects().length&&getComputedStyle(e).visibility!=='hidden';
   const text=[...document.querySelectorAll('main *,header *,footer *')].filter(e=>visible(e)&&[...e.childNodes].some(n=>n.nodeType===3&&n.textContent.trim()));
   const rgb=s=>(s.match(/[\d.]+/g)||[]).map(Number);const lum=c=>c.slice(0,3).map(v=>v/255).map(v=>v<=.04045?v/12.92:((v+.055)/1.055)**2.4).reduce((a,c,i)=>a+c*[.2126,.7152,.0722][i],0);
   const contrast=text.flatMap(e=>{let bg=[255,255,255];for(let n=e;n;n=n.parentElement){const c=rgb(getComputedStyle(n).backgroundColor);if(c.length===3||c[3]===1){bg=c;break}}const l=[lum(rgb(getComputedStyle(e).color)),lum(bg)].sort((a,b)=>a-b);const ratio=(l[1]+.05)/(l[0]+.05);return ratio<4.5?[{text:e.textContent.slice(0,50),ratio}]:[]});
   const cta=document.querySelector('[data-primary="hero"]').getBoundingClientRect();
   return {overflow:document.documentElement.scrollWidth>innerWidth,small:text.filter(e=>parseFloat(getComputedStyle(e).fontSize)<12.5).map(e=>e.textContent),smallTargets:[...document.querySelectorAll('a')].filter(e=>visible(e)&&!e.className.includes('skip')&&(e.getBoundingClientRect().height<44||e.getBoundingClientRect().width<44)).map(e=>({text:e.textContent,height:e.getBoundingClientRect().height,width:e.getBoundingClientRect().width})),contrast,ctaVisible:cta.top>=0&&cta.bottom<innerHeight,images:[...document.images].every(i=>i.complete&&i.naturalWidth>0)};
  });results.push({direction,width,...checks});
  await page.screenshot({path:`docs/screenshots/design-directions/${direction}-${width}-first.png`});await page.screenshot({path:`docs/screenshots/design-directions/${direction}-${width}-full.png`,fullPage:true,style:'[class*="mobileAction"]{display:none!important}'});
 }
 fs.writeFileSync('docs/screenshots/design-directions/verification.json',JSON.stringify({results,errors},null,2)+'\n');console.log(JSON.stringify({results,errors},null,2));await browser.close();assert.equal(errors.length,0);assert(results.every(r=>!r.overflow&&!r.small.length&&!r.smallTargets.length&&!r.contrast.length&&r.ctaVisible&&r.images));
})().catch(e=>{console.error(e);process.exit(1)});
