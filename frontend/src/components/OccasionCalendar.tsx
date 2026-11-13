'use client';
import {useEffect,useState} from 'react';
import Link from 'next/link';
import {api} from '@/lib/workspace';
import {MONTHS,MONTHS_LOWER,occ,objectSrc,countdown} from './account/lib';
import s from './OccasionCalendar.module.css';

type Event={id:number;title:string;date:string;occasion:string};
const LABELS=['B.e.','Ç.a.','Ç.','C.a.','C.','Ş.','B.'];

export default function OccasionCalendar({revision=0,onAdd}:{revision?:number;onAdd?:(day:number,month:number,year:number)=>void}){
 const [month,setMonth]=useState(()=>{const d=new Date();return new Date(d.getFullYear(),d.getMonth(),1)}),[events,setEvents]=useState<Event[]|null>(null),[error,setError]=useState(''),[day,setDay]=useState<number|null>(null),[retry,setRetry]=useState(0);
 const key=month.getFullYear()+'-'+String(month.getMonth()+1).padStart(2,'0');
 useEffect(()=>{let active=true;setError('');setEvents(null);api('calendar?month='+key).then(d=>{if(active)setEvents(d.events)}).catch(e=>{if(active){setError(e.message);setEvents([])}});return()=>{active=false}},[key,revision,retry]);
 const days=new Date(month.getFullYear(),month.getMonth()+1,0).getDate(),offset=(month.getDay()+6)%7;
 const now=new Date(),isThisMonth=now.getFullYear()===month.getFullYear()&&now.getMonth()===month.getMonth();
 const list=events||[];
 const on=(n:number)=>list.filter(e=>Number(e.date.slice(-2))===n);
 const visible=list.filter(e=>day===null||Number(e.date.slice(-2))===day);
 const go=(delta:number)=>{setMonth(new Date(month.getFullYear(),month.getMonth()+delta,1));setDay(null)};
 const trailing=(7-((offset+days)%7))%7;
 return <section className={s.wrap} aria-label="Təqvim">
  <div className={s.calendar}>
   <div className={s.toolbar}>
    <h2>{MONTHS[month.getMonth()]} <span>{month.getFullYear()}</span></h2>
    {!isThisMonth&&<button className={s.today} onClick={()=>{setMonth(new Date(now.getFullYear(),now.getMonth(),1));setDay(null)}}>Bu ay</button>}
    <div className={s.arrows}>
     <button aria-label="Əvvəlki ay" onClick={()=>go(-1)}><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M15 5l-7 7 7 7"/></svg></button>
     <button aria-label="Növbəti ay" onClick={()=>go(1)}><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 5l7 7-7 7"/></svg></button>
    </div>
   </div>
   {error&&<p role="alert" className={s.error}>{error} <button onClick={()=>setRetry(r=>r+1)}>Yenidən yoxla</button></p>}
   <div className={s.labels} aria-hidden="true">{LABELS.map(d=><span key={d}>{d}</span>)}</div>
   <div className={s.grid}>
    {Array.from({length:offset},(_,i)=><span className={s.blank} key={'b'+i}/>)}
    {Array.from({length:days},(_,i)=>{const n=i+1,ev=on(n),first=ev[0],today=isThisMonth&&now.getDate()===n;
     return <button key={n} className={`${s.day} ${ev.length?s.has:''} ${day===n?s.selected:''}`} style={first?{background:occ(first.occasion).tint}:undefined} aria-pressed={day===n} aria-label={`${n} ${MONTHS_LOWER[month.getMonth()]}${ev.length?': '+ev.map(e=>e.title).join(', '):''}`} onClick={()=>setDay(day===n?null:n)}>
      <span className={today?s.todayNum:s.num}>{n}</span>
      {first&&<><small>{first.title.split(' - ')[0]}</small><img src={objectSrc(occ(first.occasion).img)} alt="" width="34" height="34"/>{ev.length>1&&<em>+{ev.length-1}</em>}</>}
     </button>})}
    {Array.from({length:trailing},(_,i)=><span className={s.blank} key={'t'+i}/>)}
   </div>
  </div>
  <div className={s.agenda}>
   <div className={s.agendaHead}><h3>{day?day+' '+MONTHS_LOWER[month.getMonth()]:MONTHS[month.getMonth()]+' ayında'}</h3>{day&&<button className={s.clear} onClick={()=>setDay(null)}>Bütün ay</button>}</div>
   {events===null?<p className={s.muted} role="status">Yüklənir...</p>:visible.length?<ul>{visible.map(e=>{const o=occ(e.occasion);return <li key={e.id+e.date}>
    <span className={s.obj} style={{background:o.tint}}><img src={objectSrc(o.img)} alt="" width="36" height="36"/></span>
    <span className={s.text}><b>{e.title}</b><small>{Number(e.date.slice(-2))} {MONTHS_LOWER[month.getMonth()]}, {countdown(e.date)}</small>
     <span className={s.links}><Link href={'/user/wishes?occasion='+e.occasion}>Təbrik hazırla</Link><Link href={'/gifts?occasion='+e.occasion}>Hədiyyə tap</Link></span></span>
   </li>})}</ul>:<div className={s.none}><p className={s.muted}>{day?'Bu gün üçün qeyd yoxdur.':'Bu ay üçün qeyd yoxdur.'}</p>{onAdd&&<button className={s.add} onClick={()=>onAdd(day||1,month.getMonth()+1,month.getFullYear())}>{day?'Bu günə özəl gün əlavə et':'Özəl gün əlavə et'}</button>}</div>}
  </div>
 </section>;
}
