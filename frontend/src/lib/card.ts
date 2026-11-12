export function downloadCard(text:string,title:string,signature:string,background:string,color:string){
 const canvas=document.createElement('canvas');canvas.width=1080;const c=canvas.getContext('2d');if(!c)return;c.font='32px Arial';
 const lines:string[]=[];
 for(const paragraph of text.split('\n')){let line='';for(const word of paragraph.split(/(\s+)/)){if(c.measureText(line+word).width<=900){line+=word;continue;}if(line.trim())lines.push(line.trim());line='';for(const ch of word){if(c.measureText(line+ch).width>900){lines.push(line);line='';}line+=ch;}}lines.push(line.trim());}
 canvas.height=Math.max(1350,420+lines.length*48);c.fillStyle=background;c.fillRect(0,0,canvas.width,canvas.height);c.fillStyle=color;c.fillRect(64,64,952,8);c.font='bold 42px Arial';c.fillText(title,80,160,900);c.font='32px Arial';lines.forEach((line,i)=>c.fillText(line,80,270+i*48));c.font='26px Arial';c.fillText(signature,80,canvas.height-125,900);c.font='bold 25px Arial';c.fillText('wisher.az',80,canvas.height-70);const a=document.createElement('a');a.download='wisher-card.png';a.href=canvas.toDataURL('image/png');a.click();
}
