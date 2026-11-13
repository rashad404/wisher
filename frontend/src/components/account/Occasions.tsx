'use client';
import {FormEvent,useEffect,useRef,useState} from 'react';
import Link from 'next/link';
import {api} from '@/lib/workspace';
import OccasionCalendar from '../OccasionCalendar';
import {AIcon,Alert,DateFields,Empty,Loading,PageHead,Toast,Well,ui} from './AccountShell';
import {OCC,occ,objectSrc,buildDate,splitDate,dayMonth,shortCountdown} from './lib';
import type {Occasion} from './Overview';
import Pager from './Pager';
import s from './Occasions.module.css';

type Contact={id:number;name:string};
type Draft={id?:number;title:string;occasion:string;recurrence:string;contact_id?:number;day:number;month:number;year:number};
const REPEAT:[string,string][]=[['yearly','Hər il'],['monthly','Hər ay'],['none','Bir dəfə']];
const repeatLabel=(r:string)=>REPEAT.find(x=>x[0]===r)?.[1]||r;

export default function Occasions(){
 const [revision,setRevision]=useState(0),[items,setItems]=useState<Occasion[]|null>(null),[page,setPage]=useState(1),[last,setLast]=useState(1),[contacts,setContacts]=useState<Contact[]>([]),[contactSearch,setContactSearch]=useState(''),[edit,setEdit]=useState<Draft|null>(null),[error,setError]=useState(''),[formError,setFormError]=useState(''),[notice,setNotice]=useState(''),[busy,setBusy]=useState(false);
 const formRef=useRef<HTMLFormElement>(null);
 const blank=():Draft=>({title:'',occasion:'birthday',recurrence:'yearly',day:0,month:0,year:new Date().getFullYear()});
 useEffect(()=>{const q=new URLSearchParams(location.search);const id=Number(q.get('contact_id'));const d=splitDate(q.get('date'));
  if(id>0||q.get('recipient'))open({...blank(),...(id>0?{contact_id:id}:{}),title:q.get('recipient')?(q.get('recipient')||'')+' - ad günü':'',day:d.day,month:d.month,year:d.year||new Date().getFullYear()});
  else if(q.get('new'))open(blank())},[]);
 async function load(){try{const d=await api('occasions?page='+page);setItems(d.data);setLast(d.last_page);setError('')}catch{setError('Özəl günlər yüklənmədi.')}}
 useEffect(()=>{load()},[page]);
 useEffect(()=>{const id=setTimeout(()=>api('contacts?q='+encodeURIComponent(contactSearch)).then(d=>setContacts(d.data)).catch(()=>{}),200);return()=>clearTimeout(id)},[contactSearch]);
 useEffect(()=>{if(edit)formRef.current?.scrollIntoView({behavior:'smooth',block:'start'})},[edit?.id,!!edit]);
 function open(d:Draft){setFormError('');setNotice('');setEdit(d)}
 function fromOccasion(o:Occasion):Draft{const d=splitDate(o.date);return {id:o.id,title:o.title,occasion:o.occasion,recurrence:o.recurrence,contact_id:o.contact_id||undefined,...d}}
 async function save(e:FormEvent){e.preventDefault();if(!edit)return;
  const date=buildDate(edit.day,edit.month,edit.year||new Date().getFullYear())||(edit.recurrence!=='none'?buildDate(edit.day,edit.month):null);
  if(!date){setFormError('Günü və ayı düzgün seçin. Məsələn, 31 aprel yoxdur.');return}
  setBusy(true);setFormError('');
  try{await api('occasions'+(edit.id?'/'+edit.id:''),edit.id?'PUT':'POST',{title:edit.title.trim(),occasion:edit.occasion,date,recurrence:edit.recurrence,contact_id:edit.contact_id||null});setNotice(edit.id?'Özəl gün yeniləndi.':'Özəl gün əlavə edildi. Vaxtı yaxınlaşanda xatırlatmalarda görünəcək.');setEdit(null);setRevision(r=>r+1);await load()}
  catch{setFormError('Yadda saxlanmadı. Məlumatları yoxlayıb yenidən cəhd edin.')}finally{setBusy(false)}}
 async function remove(o:Occasion){if(!confirm(o.title+' silinsin?'))return;try{await api('occasions/'+o.id,'DELETE');setNotice(o.title+' silindi.');setRevision(r=>r+1);await load()}catch{setError('Silmək alınmadı.')}}
 const set=(patch:Partial<Draft>)=>setEdit(d=>d&&{...d,...patch});
 return <>
  <PageHead title="Təqvim" lead="Ad günləri, ildönümləri və bayramlar. Hər il təkrarlananları bir dəfə yazırsınız, Wisher hər il xatırladır." action={!edit&&<button className={ui.primary} onClick={()=>open(blank())}><AIcon name="plus"/>Özəl gün əlavə et</button>}/>
  {notice&&<Toast>{notice}</Toast>}
  {edit&&<form ref={formRef} className={ui.formCard} onSubmit={save}>
   <h2>{edit.id?'Özəl günə düzəliş':'Yeni özəl gün'}</h2>
   <span className={ui.formLabel}>Nə günüdür?</span>
   <div className={`${ui.chips} ${s.kinds}`} role="radiogroup" aria-label="Münasibət">{Object.entries(OCC).map(([k,o])=><button type="button" role="radio" aria-checked={edit.occasion===k} key={k} className={edit.occasion===k?ui.chipOn:ui.chip} onClick={()=>set({occasion:k})}><img src={objectSrc(o.img)} alt="" width="24" height="24"/>{o.label}</button>)}</div>
   <div className={s.formGrid}>
    <Well label="Başlıq *"><input required maxLength={120} value={edit.title} onChange={e=>set({title:e.target.value})} placeholder="Məsələn, Aysel - ad günü"/></Well>
    <div><span className={ui.formLabel}>Təkrar</span><div className={ui.chips} role="radiogroup" aria-label="Təkrar">{REPEAT.map(([k,l])=><button type="button" role="radio" aria-checked={edit.recurrence===k} key={k} className={edit.recurrence===k?ui.chipOn:ui.chip} onClick={()=>set({recurrence:k})}>{l}</button>)}</div></div>
    <DateFields label="Tarix" yearMode={edit.recurrence==='none'?'required':'hidden'} day={edit.day} month={edit.month} year={edit.year} onChange={v=>set(v)}/>
    <div><span className={ui.formLabel}>Kimə aiddir? (istəyə görə)</span><div className={s.contactPick}>
     <Well label="Adla axtar"><input value={contactSearch} maxLength={100} onChange={e=>setContactSearch(e.target.value)} placeholder="Məsələn, Ana"/></Well>
     <Well label="Yaxınınız"><select value={edit.contact_id||''} onChange={e=>{const id=Number(e.target.value)||undefined;const c=contacts.find(x=>x.id===id);set({contact_id:id,...(c&&!edit.title.trim()?{title:c.name+' - '+occ(edit.occasion).label.toLocaleLowerCase('az')}:{})})}}><option value="">Seçilməyib</option>{edit.contact_id&&!contacts.some(c=>c.id===edit.contact_id)&&<option value={edit.contact_id}>Seçilmiş şəxs</option>}{contacts.map(c=><option key={c.id} value={c.id}>{c.name}</option>)}</select></Well>
    </div></div>
   </div>
   {edit.recurrence==='monthly'&&<p className={ui.hint}>Hər ay seçilmiş gündə xatırladılır.</p>}
   {formError&&<p className={s.formError} role="alert">{formError}</p>}
   <div className={ui.formActions}><button type="submit" className={ui.primary} disabled={busy}>{busy?'Saxlanılır...':'Yadda saxla'}</button><button type="button" className={ui.quiet} onClick={()=>setEdit(null)}>Ləğv et</button></div>
  </form>}

  <OccasionCalendar revision={revision} onAdd={(day,month,year)=>open({...blank(),day,month,year})}/>

  <div className={ui.sectionHead}><h2>Bütün özəl günlər</h2></div>
  {error&&<Alert onRetry={load}>{error}</Alert>}
  {!items&&!error?<Loading rows={3}/>:items&&items.length?<ul className={s.list}>{items.map(o=>{const k=occ(o.occasion);return <li key={o.id} className={s.item}>
   <span className={s.obj} style={{background:k.tint}}><img src={objectSrc(k.img)} alt="" width="40" height="40"/></span>
   <span className={s.text}><b>{o.title}</b><small>{dayMonth(o.next_date)} <span className={s.rep}>{repeatLabel(o.recurrence)}</span></small></span>
   <em className={s.when}>{shortCountdown(o.next_date)}</em>
   <span className={s.acts}>
    <Link className={s.wish} href={'/user/wishes?occasion='+o.occasion}>Təbrik hazırla</Link>
    <button className={ui.iconBtn} aria-label={o.title+': düzəliş et'} onClick={()=>open(fromOccasion(o))}><AIcon name="edit" size={18}/></button>
    <button className={`${ui.iconBtn} ${ui.danger}`} aria-label={o.title+': sil'} onClick={()=>remove(o)}><AIcon name="trash" size={18}/></button>
   </span>
  </li>})}</ul>
  :items&&<Empty img="balloon" title="Hələ özəl gün yoxdur" text="Ad günü, ildönümü və ya Novruz. Tarixi bir dəfə yazın, hər il xatırladaq." action={!edit&&<button className={ui.primary} onClick={()=>open(blank())}>Özəl gün əlavə et</button>}/>}
  <Pager page={page} last={last} onPage={setPage}/>
 </>;
}
