'use client';
import {useEffect,useState} from 'react';
import Link from 'next/link';
import {api,Page} from '@/lib/workspace';
import {Alert,Empty,Loading,PageHead,ui} from './account/AccountShell';
import {occ,objectSrc,dayMonth,weekday,countdown} from './account/lib';
import Pager from './account/Pager';
import s from './Reminders.module.css';
type Reminder={id:number;title:string;occasion:string;occurrence_date:string;read_at:string|null};
export default function Reminders(){
 const [data,setData]=useState<Page<Reminder>|null>(null),[page,setPage]=useState(1),[error,setError]=useState(''),[busy,setBusy]=useState<number|null>(null);
 async function load(){try{setData(await api('reminders?page='+page));setError('')}catch(e){setError((e as Error).message)}}
 useEffect(()=>{load()},[page]);
 async function done(r:Reminder){setBusy(r.id);try{await api('reminders/'+r.id,'PUT',{});await load()}catch(e){setError((e as Error).message)}finally{setBusy(null)}}
 const unread=data?.data.filter(r=>!r.read_at).length||0;
 return <>
  <PageHead title="Xatırlatmalar" lead={<>Növbəti 7 gündə olan özəl günlər. {unread>0?<b className={s.unread}>{unread} yeni</b>:null}</>} action={<Link className={ui.outline} href="/user/occasions">Təqvimə bax</Link>}/>
  {error&&<Alert onRetry={load}>{error}</Alert>}
  {!data&&!error?<Loading rows={3}/>:data?.data.length?<ul className={s.list}>{data.data.map(r=>{const o=occ(r.occasion);return <li key={r.id} className={r.read_at?s.read:s.item}>
   <span className={s.obj} style={{background:o.tint}}><img src={objectSrc(o.img)} alt="" width="48" height="48"/></span>
   <div className={s.text}>
    <p className={s.when}><b>{countdown(r.occurrence_date).replace(/^./,c=>c.toLocaleUpperCase('az'))}</b> {dayMonth(r.occurrence_date)}, {weekday(r.occurrence_date)}</p>
    <h2>{r.title}</h2>
    <div className={s.acts}>
     <Link className={ui.primary} href={'/user/wishes?occasion='+r.occasion}>Təbrik hazırla</Link>
     <Link className={ui.outline} href={'/gifts?occasion='+r.occasion}>Hədiyyə tap</Link>
     {!r.read_at?<button className={ui.quiet} disabled={busy===r.id} onClick={()=>done(r)}>Oxundu kimi işarələ</button>:<span className={s.doneMark}>Oxunub</span>}
    </div>
   </div>
  </li>})}</ul>
  :data&&<Empty img="seedling" title="Bu həftə özəl gün yoxdur" text="Yeni tarix əlavə edin. Gününə 7 gün qalanda burada görünəcək." action={<Link className={ui.primary} href="/user/occasions?new=1">Özəl gün əlavə et</Link>}/>}
  {data&&<Pager page={data.current_page} last={data.last_page} onPage={setPage}/>}
  <p className={s.note}>Hələlik SMS və e-poçt göndərilmir. Xatırlatmaları burada və ümumi baxışda görürsünüz.</p>
 </>;
}
