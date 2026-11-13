'use client';
import Link from 'next/link';
import {usePathname} from 'next/navigation';
import {useEffect,useId,useRef} from 'react';
import {MONTHS,objectSrc} from './lib';
import s from './AccountShell.module.css';

const ICONS:Record<string,string>={
 home:'M4 11l8-7 8 7v9a1 1 0 0 1-1 1h-4v-6h-6v6H5a1 1 0 0 1-1-1z',
 people:'M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8M2 21v-1a6 6 0 0 1 6-6h2a6 6 0 0 1 6 6v1M17 3.5a4 4 0 0 1 0 7.5M22 21v-1a6 6 0 0 0-4-5.6',
 calendar:'M4 6h16v15H4zM8 3v5M16 3v5M4 11h16',
 bell:'M6 16V11a6 6 0 0 1 12 0v5l2 2H4zM10 21h4',
 gift:'M3 9h18v4H3zM5 13v8h14v-8M12 9v12M12 9S10.5 4 8 4a2 2 0 0 0 0 5M12 9s1.5-5 4-5a2 2 0 0 1 0 5',
 card:'M4 5h16v14H4zM8 10h8M8 14h5',
 pen:'M4 20h4L19 9l-4-4L4 16zM14 6l4 4',
 company:'M4 21V7l8-4 8 4v14M9 21v-5h6v5M8 10h2M14 10h2',
 settings:'M12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6M19 12a7 7 0 0 0-.1-1.2l2-1.5-2-3.4-2.3.9a7 7 0 0 0-2-1.2L14 3h-4l-.6 2.6a7 7 0 0 0-2 1.2l-2.3-.9-2 3.4 2 1.5a7 7 0 0 0 0 2.4l-2 1.5 2 3.4 2.3-.9a7 7 0 0 0 2 1.2L10 21h4l.6-2.6a7 7 0 0 0 2-1.2l2.3.9 2-3.4-2-1.5c.1-.4.1-.8.1-1.2',
 plus:'M12 5v14M5 12h14',
 search:'M11 18a7 7 0 1 0 0-14 7 7 0 0 0 0 14M20 20l-4-4',
 edit:'M4 20h4L19 9l-4-4L4 16z',
 trash:'M4 7h16M9 7V4h6v3M6 7l1 14h10l1-14',
 left:'M15 5l-7 7 7 7',
 right:'M9 5l7 7-7 7',
 check:'M5 12l5 5L20 7',
 copy:'M8 8h12v12H8zM4 16V4h12',
 logout:'M9 4H4v16h5M10 12h10M16 8l4 4-4 4',
 heart:'M12 21s-7.5-4.6-9.5-9.3C1 8 3.4 4.5 7 4.5c2 0 3.6 1.1 5 3 1.4-1.9 3-3 5-3 3.6 0 6 3.5 4.5 7.2C19.5 16.4 12 21 12 21z',
 whatsapp:'M4 20l1.3-4A8 8 0 1 1 8 18.8zM9 8.5c0 3.5 3 6.5 6.5 6.5l1-1.6-2-1-1 1a5 5 0 0 1-2.5-2.5l1-1-1-2z',
};
export function AIcon({name,size=20}:{name:string;size?:number}){return <svg width={size} height={size} viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true"><path d={ICONS[name]||ICONS.card}/></svg>}

export const NAV:[string,string,string][]=[
 ['/user','Ümumi baxış','home'],
 ['/user/contacts','Yaxınlarım','people'],
 ['/user/occasions','Təqvim','calendar'],
 ['/user/reminders','Xatırlatmalar','bell'],
 ['/user/wishlist','Hədiyyə siyahım','gift'],
 ['/user/saved','Təbriklərim','card'],
 ['/user/wishes','Təbrik yaz','pen'],
 ['/user/company','Şirkətim','company'],
 ['/user/settings','Tənzimləmələr','settings'],
];

export default function AccountShell({name,demo,children}:{name?:string;demo?:boolean;children:React.ReactNode}){
 const path=usePathname();
 const current=(href:string)=>href==='/user'?path==='/user':path.startsWith(href);
 const navRef=useRef<HTMLElement>(null);
 // On the mobile tab bar, bring the current section into view without scrolling the page.
 useEffect(()=>{const nav=navRef.current,a=nav?.querySelector<HTMLElement>('[aria-current]');if(nav&&a&&nav.scrollWidth>nav.clientWidth)nav.scrollLeft=a.offsetLeft-(nav.clientWidth-a.offsetWidth)/2},[path]);
 return <div className={s.root}>
  <aside className={s.rail} aria-label="Hesab">
   <div className={s.me}>
    <span className={s.avatar} aria-hidden="true">{(name||'W').charAt(0)}</span>
    <span><b>{name||'Hesabım'}</b><small>Şəxsi hesab</small></span>
   </div>
   <nav ref={navRef} className={s.nav} aria-label="Hesab bölmələri">
    {NAV.map(([href,label,icon])=><Link key={href} href={href} aria-current={current(href)?'page':undefined}><AIcon name={icon}/><span>{label}</span></Link>)}
   </nav>
   {demo&&<p className={s.demo}>Nümunə hesabdakı adlar və tarixlər uydurmadır. Yazdıqlarınız yalnız bu hesabda saxlanır.</p>}
  </aside>
  <div className={s.content}>{children}</div>
 </div>;
}

export function PageHead({title,lead,action}:{title:string;lead?:React.ReactNode;action?:React.ReactNode}){return <header className={s.head}><div><h1>{title}</h1>{lead&&<p>{lead}</p>}</div>{action}</header>}

export function Empty({img,title,text,action}:{img:string;title:string;text?:string;action?:React.ReactNode}){return <div className={s.empty}><img src={objectSrc(img)} alt="" width="88" height="88"/><h2>{title}</h2>{text&&<p>{text}</p>}{action}</div>}

export function Loading({rows=3}:{rows?:number}){return <div className={s.loading} role="status" aria-label="Yüklənir">{Array.from({length:rows},(_,i)=><i key={i}/>)}<span>Yüklənir...</span></div>}

export function Alert({children,onRetry}:{children:React.ReactNode;onRetry?:()=>void}){return <p className={s.alert} role="alert">{children}{onRetry&&<button type="button" onClick={onRetry}>Yenidən yoxla</button>}</p>}

export function Toast({children,action}:{children:React.ReactNode;action?:React.ReactNode}){return <p className={s.toast} role="status"><AIcon name="check" size={18}/>{children}{action}</p>}

// Day + month (+ year) selects in Azerbaijani; never a native date input.
export function DateFields({day,month,year,onChange,yearMode='hidden',label='Tarix'}:{day:number;month:number;year:number;onChange:(v:{day:number;month:number;year:number})=>void;yearMode?:'hidden'|'optional'|'required';label?:string}){
 const id=useId(),now=new Date().getFullYear();
 const years=yearMode==='optional'?Array.from({length:100},(_,i)=>now-i):Array.from({length:6},(_,i)=>now+i);
 if(yearMode==='optional'&&year&&!years.includes(year))years.push(year);
 if(yearMode==='required'&&year&&!years.includes(year))years.unshift(year);
 return <fieldset className={s.dateFields}><legend>{label}</legend><div>
  <label className={s.well}><span id={id+'d'}>Gün</span><select value={day||''} onChange={e=>onChange({day:Number(e.target.value),month,year})} aria-labelledby={id+'d'}><option value="">-</option>{Array.from({length:31},(_,i)=><option key={i} value={i+1}>{i+1}</option>)}</select></label>
  <label className={s.well}><span id={id+'m'}>Ay</span><select value={month||''} onChange={e=>onChange({day,month:Number(e.target.value),year})} aria-labelledby={id+'m'}><option value="">-</option>{MONTHS.map((m,i)=><option key={m} value={i+1}>{m}</option>)}</select></label>
  {yearMode!=='hidden'&&<label className={s.well}><span id={id+'y'}>{yearMode==='optional'?'İl (istəyə görə)':'İl'}</span><select value={year||''} onChange={e=>onChange({day,month,year:Number(e.target.value)})} aria-labelledby={id+'y'}>{yearMode==='optional'&&<option value="">Göstərmə</option>}{years.map(y=><option key={y} value={y}>{y}</option>)}</select></label>}
 </div></fieldset>;
}

export function Well({label,children,wide=false}:{label:string;children:React.ReactNode;wide?:boolean}){return <label className={wide?`${s.well} ${s.wide}`:s.well}><span>{label}</span>{children}</label>}

export const ui=s;
