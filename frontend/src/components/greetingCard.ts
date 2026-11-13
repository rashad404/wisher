// Draws a Wisher greeting card (1080x1350 PNG) in the page fonts and triggers a download.
// Splits "Əziz Aysel, ad günün..." into a salutation and body for the card face.
export function splitGreeting(text:string){const m=text.match(/^([^,.!\n]{2,32}[,!])\s*([\s\S]*)$/);return m&&m[2]?{to:m[1],body:m[2]}:{to:'',body:text}}
function flamePath(c:CanvasRenderingContext2D,x:number,y:number,k:number){c.beginPath();c.moveTo(x,y);c.bezierCurveTo(x,y,x-6*k,y+7.5*k,x-6*k,y+12.5*k);c.arc(x,y+12.5*k,6*k,Math.PI,0,true);c.bezierCurveTo(x+6*k,y+7.5*k,x,y,x,y);c.fill()}
export async function downloadPng(text:string,signature:string,style:string,custom?:{bg:string;title?:string}){
 const css=getComputedStyle(document.body),display=css.getPropertyValue('--d-display').trim()||'Georgia',body=css.getPropertyValue('--d-text').trim()||'Arial';
 try{await Promise.all([document.fonts.load(`700 64px ${display}`),document.fonts.load(`italic 600 44px ${display}`),document.fonts.load(`500 40px ${body}`)])}catch{}
 const W=1080,H=1350,cv=document.createElement('canvas');cv.width=W;cv.height=H;const c=cv.getContext('2d');if(!c)return;
 const bg=custom?custom.bg:style==='red'?'#a3122f':style==='green'?'#0f6b4f':'#ffffff',light=custom?isLight(custom.bg):style==='white',ink=light?'#1d1416':'#ffffff',accent=custom?ink:style==='white'?'#a3122f':'#ffffff';
 c.fillStyle=bg;c.fillRect(0,0,W,H);
 if(style==='white'&&!custom){c.save();c.beginPath();c.rect(40,40,W-80,H-80);c.rect(52,52,W-104,H-104);c.clip('evenodd');for(let i=-H;i<W+H;i+=24){c.fillStyle='#a3122f';c.beginPath();c.moveTo(i,0);c.lineTo(i+12,0);c.lineTo(i+12-H,H);c.lineTo(i-H,H);c.fill();c.fillStyle='#f0b9c2';c.beginPath();c.moveTo(i+12,0);c.lineTo(i+24,0);c.lineTo(i+24-H,H);c.lineTo(i+12-H,H);c.fill()}c.restore()}
 else{c.fillStyle=light?'rgba(0,0,0,0.05)':'rgba(255,255,255,0.07)';for(let y=0;y<H;y+=128)for(let x=0;x<W;x+=128){flamePath(c,x+32,y+12,2);flamePath(c,x+96,y+76,2)}}
 const {to,body:main}=splitGreeting(text.trim());
 c.font=`500 42px ${body}`;const lines:string[]=[];
 for(const para of main.split('\n')){let line='';for(const word of para.split(/\s+/)){const t=line?line+' '+word:word;if(c.measureText(t).width>860&&line){lines.push(line);line=word}else line=t}lines.push(line)}
 const lh=lines.length>14?54:64;if(lines.length>17){c.font=`500 34px ${body}`}
 const shown=lines.slice(0,19),block=(to?90:0)+shown.length*lh;let y=Math.max(190,Math.round((H-block)/2-80));
 if(to){const f=c.font;c.fillStyle=accent;c.font=`700 72px ${display}`;c.fillText(to,110,y,860);y+=100;c.font=f}
 c.fillStyle=ink;shown.forEach((l,i)=>c.fillText(l,110,y+i*lh));
 if(signature.trim()){c.font=`italic 600 48px ${display}`;c.textAlign='right';c.fillStyle=ink;c.fillText(signature.trim(),W-110,H-200,860);c.textAlign='left'}
 c.fillStyle='#ffb627';flamePath(c,122,H-150,1.6);c.fillStyle=ink;c.font=`700 30px ${body}`;c.fillText(custom?.title||'wisher.az',146,H-112,800);
 const a=document.createElement('a');a.download='wisher-tebrik.png';a.href=cv.toDataURL('image/png');a.click();
}


export function isLight(hex:string){const m=hex.replace('#','').match(/^([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i);if(!m)return false;const [r,g,b]=m.slice(1).map(x=>parseInt(x,16)/255);return 0.2126*r+0.7152*g+0.0722*b>0.6}
