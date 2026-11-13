// Shared helpers for the account area (/user pages).
export const MONTHS=['Yanvar','Fevral','Mart','Aprel','May','İyun','İyul','Avqust','Sentyabr','Oktyabr','Noyabr','Dekabr'];
export const MONTHS_LOWER=MONTHS.map(m=>m.toLocaleLowerCase('az'));
export const WEEKDAYS=['bazar','bazar ertəsi','çərşənbə axşamı','çərşənbə','cümə axşamı','cümə','şənbə'];

// Occasion key -> label, Fluent 3D object and tile tint (same family as the approved home tiles).
export const OCC:Record<string,{label:string;img:string;tint:string}>={
 birthday:{label:'Ad günü',img:'birthday_cake',tint:'#fde8ec'},
 anniversary:{label:'İldönümü',img:'heart',tint:'#fbe9f3'},
 wedding:{label:'Toy',img:'ring',tint:'#f3ecfb'},
 novruz:{label:'Novruz',img:'seedling',tint:'#e6f4ea'},
 newyear:{label:'Yeni il',img:'christmas_tree',tint:'#e8f0fb'},
 graduation:{label:'Məzuniyyət',img:'graduation_cap',tint:'#fdf6dd'},
 thanks:{label:'Təşəkkür',img:'bouquet',tint:'#fff0e6'},
 support:{label:'Dəstək',img:'balloon',tint:'#e6f6f8'},
};
export const occ=(key:string)=>OCC[key]||{label:'Özəl gün',img:'wrapped_gift',tint:'#f6f3f4'};
export const objectSrc=(img:string)=>`/concepts/occasions/${img}.png`;

const TINTS=['#fde8ec','#e6f4ea','#fff0e6','#e8f0fb','#f3ecfb','#e6f6f8','#fdf6dd','#fbe9f3'];
export const tintFor=(text:string)=>TINTS[[...text].reduce((a,c)=>a+c.charCodeAt(0),0)%TINTS.length];

export const parse=(value:string)=>new Date(value.slice(0,10)+'T12:00:00');
export const dayMonth=(value:string)=>{const d=parse(value);return d.getDate()+' '+MONTHS_LOWER[d.getMonth()]};
export const weekday=(value:string)=>WEEKDAYS[parse(value).getDay()];
export function daysUntil(value:string){const t=new Date();const today=new Date(t.getFullYear(),t.getMonth(),t.getDate(),12);return Math.round((parse(value).getTime()-today.getTime())/86400000)}
export function countdown(value:string){const n=daysUntil(value);return n<0?'keçib':n===0?'bu gün':n===1?'sabah':n+' gün qaldı'}
export function shortCountdown(value:string){const n=daysUntil(value);return n<0?'keçib':n===0?'bu gün':n===1?'sabah':n<14?n+' gün':Math.round(n/7)+' həftə'}

// Next yearly occurrence of a birthday (month/day of any year).
export function nextYearly(value:string){const d=parse(value),t=new Date(),today=new Date(t.getFullYear(),t.getMonth(),t.getDate(),12);let y=today.getFullYear();for(let i=0;i<9;i++){const c=new Date(y+i,d.getMonth(),d.getDate(),12);if(c.getMonth()===d.getMonth()&&c>=today)return c.getFullYear()+'-'+String(c.getMonth()+1).padStart(2,'0')+'-'+String(c.getDate()).padStart(2,'0')}return value}

// Builds Y-m-d from day + month (+ optional year). Without a year the nearest valid year is used (29 Fevral -> next leap year).
export function buildDate(day:number,month:number,year?:number):string|null{
 if(!day||!month)return null;
 let y=year||new Date().getFullYear();
 if(!year&&month===2&&day===29){while(new Date(y,1,29).getMonth()!==1)y++}
 const d=new Date(y,month-1,day);if(d.getMonth()!==month-1)return null;
 return y+'-'+String(month).padStart(2,'0')+'-'+String(day).padStart(2,'0');
}
export function splitDate(value?:string|null){if(!value)return {day:0,month:0,year:0};const [y,m,d]=value.slice(0,10).split('-').map(Number);return {day:d||0,month:m||0,year:y||0}}

export const waLink=(text:string)=>'https://wa.me/?text='+encodeURIComponent(text);
