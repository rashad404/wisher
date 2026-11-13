'use client';
import {useEffect,useState} from 'react';
import Link from 'next/link';
import {api} from '@/lib/workspace';
import {Alert,Loading,ui} from './AccountShell';
import {occ,objectSrc,dayMonth,weekday,countdown,shortCountdown,daysUntil} from './lib';
import {GreetingCard,type Wish} from './Saved';
import s from './Overview.module.css';

export type Occasion={id:number;title:string;occasion:string;date:string;next_date:string;recurrence:string;contact_id?:number|null};
type Data={counts:Record<string,number>;upcoming:Occasion[];recent:Wish[]};

function Flame(){return <svg viewBox="0 0 20 28" aria-hidden="true" className={s.flame}><path d="M10 1C10 1 3 10 3 17a7 7 0 0014 0C17 10 10 1 10 1z" fill="#ffb627"/><path d="M10 11s-3 4-3 7a3 3 0 006 0c0-3-3-7-3-7z" fill="#fff3c4"/></svg>}

const quick:[string,string,string,string][]=[
 ['/user/contacts?new=1','Yaxınını əlavə et','bouquet','#fbe9f3'],
 ['/user/occasions?new=1','Özəl gün əlavə et','balloon','#e8f0fb'],
 ['/user/wishes','Təbrik yaz','heart','#fde8ec'],
 ['/gifts','Hədiyyə tap','wrapped_gift','#e6f4ea'],
];

export default function Overview({name}:{name:string}){
 const [data,setData]=useState<Data|null>(null),[error,setError]=useState(false),[retry,setRetry]=useState(0);
 useEffect(()=>{setError(false);api('dashboard').then(setData).catch(()=>setError(true))},[retry]);
 const first=name.split(' ')[0];
 const upcoming=data?.upcoming||[],next=upcoming[0],rest=upcoming.slice(1);
 const soon=upcoming.filter(e=>daysUntil(e.next_date)<=30).length;
 return <>
  <header className={s.hello}>
   <h1>Salam, {first}</h1>
   <p>{!data?'Özəl günləriniz yüklənir.':soon?`Yaxın 30 gündə ${soon} özəl gün var. Hədiyyəni və təbriki vaxtında hazırlayın.`:'Yaxın 30 gündə özəl gün yoxdur. Yaxınlarınızın tarixlərini əlavə edin, vaxtında xatırladaq.'}</p>
  </header>
  {error&&<Alert onRetry={()=>setRetry(r=>r+1)}>Məlumatlar yüklənmədi.</Alert>}
  {!data&&!error?<Loading rows={2}/>:next?<section className={s.next} aria-labelledby="next-title">
   <div className={s.nextText}>
    <p className={s.count}><Flame/>{countdown(next.next_date).replace(/^./,c=>c.toLocaleUpperCase('az'))}</p>
    <h2 id="next-title">{next.title}</h2>
    <p className={s.when}>{dayMonth(next.next_date)}, {weekday(next.next_date)}{!next.title.toLocaleLowerCase('az').includes(occ(next.occasion).label.toLocaleLowerCase('az'))&&<span>{occ(next.occasion).label}</span>}</p>
    <div className={s.nextActions}>
     <Link className={ui.primary} href={'/user/wishes?occasion='+next.occasion}>Təbrik hazırla</Link>
     <Link className={s.ghost} href={'/gifts?occasion='+next.occasion}>Hədiyyə tap</Link>
    </div>
   </div>
   <img className={s.nextObject} src={objectSrc(occ(next.occasion).img)} alt="" width="200" height="200"/>
  </section>:data&&<section className={`${s.next} ${s.nextEmpty}`}>
   <div className={s.nextText}>
    <h2>Birinci özəl günü əlavə edin</h2>
    <p className={s.when}>Ad günü, ildönümü, Novruz. Tarixi yazın, vaxtı çatanda burada görün.</p>
    <div className={s.nextActions}><Link className={ui.primary} href="/user/occasions?new=1">Özəl gün əlavə et</Link></div>
   </div>
   <img className={s.nextObject} src={objectSrc('birthday_cake')} alt="" width="200" height="200"/>
  </section>}

  {rest.length>0&&<section aria-labelledby="later">
   <div className={ui.sectionHead}><h2 id="later">Sonra gələnlər</h2><Link className={ui.link} href="/user/occasions">Təqvimə bax</Link></div>
   <ul className={s.rows}>{rest.map(e=><li key={e.id}><Link href={'/user/wishes?occasion='+e.occasion} className={s.row}>
    <span className={s.rowObj} style={{background:occ(e.occasion).tint}}><img src={objectSrc(occ(e.occasion).img)} alt="" width="40" height="40"/></span>
    <span className={s.rowText}><b>{e.title}</b><small>{dayMonth(e.next_date)}, {weekday(e.next_date)}</small></span>
    <em>{shortCountdown(e.next_date)}</em>
   </Link></li>)}</ul>
  </section>}

  <section aria-labelledby="quick">
   <div className={ui.sectionHead}><h2 id="quick">Nə etmək istəyirsiniz?</h2></div>
   <ul className={s.quick}>{quick.map(([href,label,img,bg])=><li key={href}><Link href={href} style={{background:bg}}><b>{label}</b><img src={objectSrc(img)} alt="" width="72" height="72"/></Link></li>)}</ul>
   {data&&<p className={s.counts}><Link href="/user/contacts">{data.counts.contacts??0} yaxın</Link><Link href="/user/occasions">{data.counts.occasions??0} özəl gün</Link><Link href="/user/saved">{data.counts.saved??0} saxlanmış təbrik</Link></p>}
  </section>

  {data&&<section aria-labelledby="recent">
   <div className={ui.sectionHead}><h2 id="recent">Son təbrikləriniz</h2>{data.recent.length>0&&<Link className={ui.link} href="/user/saved">Hamısına bax</Link>}</div>
   {data.recent.length?<div className={s.cards}>{data.recent.map((w,i)=><GreetingCard key={w.id} wish={w} variant={(['white','green','white'] as const)[i%3]} compact/>)}</div>
   :<div className={s.noCards}><img src={objectSrc('heart')} alt="" width="56" height="56"/><p>Hazırladığınız təbriklər burada kart kimi görünəcək.</p><Link className={ui.outline} href="/user/wishes">Təbrik yaz</Link></div>}
  </section>}
 </>;
}
