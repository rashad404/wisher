const {chromium}=require('/Users/macmini/projects/elek/frontend/node_modules/playwright');const assert=require('node:assert/strict');const fs=require('node:fs');
(async()=>{const b=await chromium.launch({executablePath:'/Applications/Google Chrome.app/Contents/MacOS/Google Chrome',headless:true});const p=await b.newPage({viewport:{width:375,height:812}});const report=[];
for(const d of ['a','b','c']){
 await p.goto('http://localhost:3022/az/concepts/'+d);await p.evaluate(()=>document.fonts.ready);
 await p.evaluate(()=>{window.received=[];window.addEventListener('wisher:analytics',e=>window.received.push(e.detail));document.addEventListener('click',e=>e.preventDefault())});
 const primary=p.locator('[data-primary]');for(let i=0;i<await primary.count();i++)await primary.nth(i).click();
 const events=await p.evaluate(()=>window.received.filter(e=>e.action==='find_gift'));assert.equal(events.length,await primary.count());assert(events.every(e=>e.direction===d&&e.destination==='/gifts'));
 await p.reload();await p.keyboard.press('Tab');assert.equal(await p.locator(':focus').textContent(),'Məzmuna keç');await p.evaluate(()=>scrollTo(0,0));await p.screenshot({path:`docs/screenshots/design-directions/${d}-375-focus.png`});
 await p.route('**/concepts/product-*.webp',r=>r.abort());await p.reload();await p.getByText('Şəkil yoxdur').first().waitFor();await p.evaluate(()=>{document.activeElement?.blur();scrollTo(0,0)});await p.screenshot({path:`docs/screenshots/design-directions/${d}-375-image-error.png`,fullPage:true,style:'[class*="mobileAction"]{display:none!important}'});assert(await p.evaluate(()=>document.documentElement.scrollWidth<=innerWidth));await p.unroute('**/concepts/product-*.webp');
 await p.reload();await p.locator('[data-primary="hero"]').click();await p.waitForURL('**/gifts');assert(await p.locator('h1').count());
 report.push({direction:d,primaryEvents:events.length,ctaDestination:true,keyboardFocus:true,imageFailure:true});
}
for(const width of [1440,375]){await p.setViewportSize({width,height:900});await p.goto('http://localhost:3022/');await p.waitForTimeout(1800);await p.evaluate(()=>document.fonts.ready);await p.evaluate(()=>Promise.all([...document.images].map(i=>i.decode().catch(()=>{}))));await p.screenshot({path:`docs/screenshots/design-directions/after-home-${width}.png`});}
assert.equal((await p.request.get('http://localhost:3022/az/concepts/d')).status(),404);
fs.writeFileSync('docs/screenshots/design-directions/interactions.json',JSON.stringify(report,null,2)+'\n');console.log(report);await b.close()})().catch(e=>{console.error(e);process.exit(1)})
