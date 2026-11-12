'use client';
import {useEffect,useState} from 'react';
import Link from 'next/link';
import {api} from '@/lib/workspace';
import t from '@/messages/az';
export default function OccasionCalendar({revision=0}:{revision?:number}){
 const [month,setMonth]=useState(()=>{const d=new Date();return new Date(d.getFullYear(),d.getMonth(),1)}),[events,setEvents]=useState<{id:number;title:string;date:string;occasion:string}[]>([]),[error,setError]=useState(''),[day,setDay]=useState<number|null>(null);
 const key=month.getFullYear()+'-'+String(month.getMonth()+1).padStart(2,'0');
 useEffect(()=>{let active=true;setError('');api('calendar?month='+key).then(d=>{if(active)setEvents(d.events)}).catch(e=>{if(active)setError(e.message)});return()=>{active=false}},[key,revision]);
 const days=new Date(month.getFullYear(),month.getMonth()+1,0).getDate(),offset=(month.getDay()+6)%7;
 const visible=events.filter(e=>day===null||Number(e.date.slice(-2))===day);
 return <section className="panel calendar-panel"><div className="calendar-toolbar"><button aria-label="Əvvəlki ay" onClick={()=>{setMonth(new Date(month.getFullYear(),month.getMonth()-1,1));setDay(null)}}>&lt;</button><h2>{t.monthsFull[month.getMonth()]} {month.getFullYear()}</h2><button aria-label="Növbəti ay" onClick={()=>{setMonth(new Date(month.getFullYear(),month.getMonth()+1,1));setDay(null)}}>&gt;</button></div>{error&&<p role="alert" className="error">{error}</p>}<div className="calendar-labels">{['B.e.','Ç.a.','Ç.','C.a.','C.','Ş.','B.'].map(d=><span key={d}>{d}</span>)}</div><div className="calendar-grid">{Array.from({length:offset},(_,i)=><span key={'blank'+i}/>)}{Array.from({length:days},(_,i)=>{const n=i+1,count=events.filter(e=>Number(e.date.slice(-2))===n).length;return <button className={count?'has-event':''} aria-pressed={day===n} aria-label={`${n} ${t.monthsFull[month.getMonth()]}, ${count} qeyd`} key={n} onClick={()=>setDay(day===n?null:n)}>{n}{count>0&&<small>{count} qeyd</small>}</button>})}</div>{day&&<button className="quiet-button" onClick={()=>setDay(null)}>Bütün ayı göstər</button>}<div className="calendar-agenda">{visible.map(e=><Link key={e.id} href={'/user/wishes?occasion='+e.occasion}><span>{e.date.slice(8)}</span><strong>{e.title}</strong><span>Təbrik hazırla</span></Link>)}{!visible.length&&<p>Bu tarix üçün qeyd yoxdur.</p>}</div></section>
}
