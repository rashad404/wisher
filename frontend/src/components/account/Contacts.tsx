'use client';
import {FormEvent,useEffect,useRef,useState} from 'react';
import Link from 'next/link';
import {api} from '@/lib/workspace';
import {AIcon,Alert,DateFields,Empty,Loading,PageHead,Toast,Well,ui} from './AccountShell';
import {buildDate,splitDate,dayMonth,nextYearly,countdown,daysUntil,tintFor,objectSrc,occ} from './lib';
import Pager from './Pager';
import s from './Contacts.module.css';

type Contact={id:number;name:string;relationship:string;group:string|null;email?:string|null;birthday?:string|null;notes?:string|null};
type Occ={id:number;title:string;occasion:string;next_date:string;contact_id?:number|null};
type Draft={id?:number;name:string;relationship:string;group:string;email:string;notes:string;day:number;month:number;year:number};
const RELATIONS=['Anam','Atam','Həyat yoldaşım','Bacım','Qardaşım','Dostum','Həmkarım','Müəllimim'];
const GROUPS=['Ailə','Dostlar','İş'];
const blank:Draft={name:'',relationship:'',group:'',email:'',notes:'',day:0,month:0,year:0};

export default function Contacts(){
 const [items,setItems]=useState<Contact[]|null>(null),[page,setPage]=useState(1),[last,setLast]=useState(1),[total,setTotal]=useState(0),[query,setQuery]=useState(''),[group,setGroup]=useState(''),[edit,setEdit]=useState<Draft|null>(null),[error,setError]=useState(''),[formError,setFormError]=useState(''),[notice,setNotice]=useState(''),[busy,setBusy]=useState(false),[occs,setOccs]=useState<Occ[]>([]);
 const formRef=useRef<HTMLFormElement>(null);
 async function load(){try{const d=await api('contacts?page='+page+'&q='+encodeURIComponent(query));setItems(d.data);setLast(d.last_page);setTotal(d.total??d.data.length);setError('')}catch{setError('Yaxınlarınızın siyahısı yüklənmədi.')}}
 useEffect(()=>{const id=setTimeout(load,200);return()=>clearTimeout(id)},[page,query]);
 useEffect(()=>{api('occasions?page=1').then(d=>setOccs(d.data)).catch(()=>{})},[]);
 useEffect(()=>{if(new URLSearchParams(location.search).get('new'))open(blank)},[]);
 useEffect(()=>{if(edit)formRef.current?.scrollIntoView({behavior:'smooth',block:'start'})},[edit?.id,!!edit]);
 function open(d:Draft){setFormError('');setNotice('');setEdit(d)}
 function fromContact(c:Contact):Draft{const b=splitDate(c.birthday);return {id:c.id,name:c.name,relationship:c.relationship,group:c.group||'',email:c.email||'',notes:c.notes||'',day:b.day,month:b.month,year:b.year&&b.year!==new Date().getFullYear()?b.year:0}}
 async function save(e:FormEvent){e.preventDefault();if(!edit)return;
  let birthday:string|null=null;
  if(edit.day||edit.month){birthday=buildDate(edit.day,edit.month,edit.year||undefined);if(!birthday){setFormError('Ad günü üçün həm günü, həm ayı düzgün seçin.');return}}
  setBusy(true);setFormError('');
  try{await api('contacts'+(edit.id?'/'+edit.id:''),edit.id?'PUT':'POST',{name:edit.name.trim(),relationship:edit.relationship.trim(),group:edit.group.trim()||null,email:edit.email.trim()||null,notes:edit.notes.trim()||null,birthday});setNotice(edit.id?edit.name+' yeniləndi.':edit.name+' əlavə edildi.');setEdit(null);await load()}
  catch{setFormError('Yadda saxlanmadı. Adı və e-poçtu yoxlayın.')}finally{setBusy(false)}}
 async function remove(c:Contact){if(!confirm(c.name+' siyahıdan silinsin?'))return;try{await api('contacts/'+c.id,'DELETE');setNotice(c.name+' silindi.');await load()}catch{setError('Silmək alınmadı.')}}
 const groups=[...new Set((items||[]).map(c=>c.group||'').filter(Boolean))];
 const shown=(items||[]).filter(c=>!group||c.group===group);
 const set=(k:keyof Draft,v:string|number)=>setEdit(d=>d&&{...d,[k]:v});
 return <>
  <PageHead title="Yaxınlarım" lead="Sevdiyiniz insanlar, ad günləri və yadda saxlamaq istədiyiniz kiçik detallar." action={!edit&&<button className={ui.primary} onClick={()=>open(blank)}><AIcon name="plus"/>Yaxınını əlavə et</button>}/>
  {notice&&<Toast>{notice}</Toast>}
  {edit&&<form ref={formRef} className={ui.formCard} onSubmit={save}>
   <h2>{edit.id?edit.name+': düzəliş':'Yeni yaxın'}</h2>
   <div className={ui.grid2}>
    <Well label="Adı *"><input required maxLength={100} value={edit.name} onChange={e=>set('name',e.target.value)} placeholder="Məsələn, Aysel" autoFocus={!edit.id}/></Well>
    <Well label="Sizə kimdir? *"><input required maxLength={60} value={edit.relationship} onChange={e=>set('relationship',e.target.value)} placeholder="Məsələn, Dostum" list="relations"/></Well>
   </div>
   <datalist id="relations">{RELATIONS.map(r=><option key={r} value={r}/>)}</datalist>
   <div className={s.quickPick} role="group" aria-label="Tez seçim">{RELATIONS.slice(0,6).map(r=><button type="button" key={r} className={edit.relationship===r?ui.chipOn:ui.chip} onClick={()=>set('relationship',r)}>{r}</button>)}</div>
   <div className={s.formRow}>
    <DateFields label="Ad günü" yearMode="optional" day={edit.day} month={edit.month} year={edit.year} onChange={v=>setEdit(d=>d&&{...d,...v})}/>
    <div><span className={ui.formLabel}>Qrup</span><div className={ui.chips}>{[...new Set([...GROUPS,...groups])].map(g=><button type="button" key={g} className={edit.group===g?ui.chipOn:ui.chip} onClick={()=>set('group',edit.group===g?'':g)} aria-pressed={edit.group===g}>{g}</button>)}</div></div>
   </div>
   <div className={ui.grid2}>
    <Well label="E-poçt (istəyə görə)"><input type="email" maxLength={255} value={edit.email} onChange={e=>set('email',e.target.value)} placeholder="ad@example.com"/></Well>
    <Well label="Qeyd (istəyə görə)"><input maxLength={500} value={edit.notes} onChange={e=>set('notes',e.target.value)} placeholder="Məsələn, kitab və səyahət sevir"/></Well>
   </div>
   {formError&&<p className={s.formError} role="alert">{formError}</p>}
   <div className={ui.formActions}><button type="submit" className={ui.primary} disabled={busy}>{busy?'Saxlanılır...':'Yadda saxla'}</button><button type="button" className={ui.quiet} onClick={()=>setEdit(null)}>Ləğv et</button></div>
  </form>}

  <div className={s.tools}>
   <label className={s.search}><AIcon name="search"/><input aria-label="Adla axtar" placeholder="Adla axtarın" value={query} maxLength={100} onChange={e=>{setQuery(e.target.value);setPage(1)}}/></label>
   {groups.length>1&&<div className={ui.chips} role="group" aria-label="Qrup"><button className={!group?ui.chipOn:ui.chip} onClick={()=>setGroup('')}>Hamısı</button>{groups.map(g=><button key={g} className={group===g?ui.chipOn:ui.chip} onClick={()=>setGroup(group===g?'':g)}>{g}</button>)}</div>}
  </div>
  {error&&<Alert onRetry={load}>{error}</Alert>}
  {!items&&!error?<Loading rows={3}/>:items&&shown.length?<>
   <p className={s.total}>{query?`"${query}" üzrə ${total} nəfər`:`${total} nəfər`}</p>
   <ul className={s.grid}>{shown.map(c=>{const linked=occs.filter(o=>o.contact_id===c.id).sort((a,b)=>a.next_date.localeCompare(b.next_date))[0];const next=c.birthday?nextYearly(c.birthday):linked?.next_date||null;const label=c.birthday||!linked?'Ad günü':occ(linked.occasion).label;const soon=next!==null&&daysUntil(next)<=30;return <li key={c.id} className={s.person}>
    <div className={s.top}>
     <span className={s.avatar} style={{background:tintFor(c.name)}} aria-hidden="true">{c.name.charAt(0)}</span>
     <div className={s.who}><h2>{c.name}</h2><p>{c.relationship}{c.group&&c.group!==c.relationship&&<span className={s.group}>{c.group}</span>}</p></div>
     <div className={s.tools2}><button className={ui.iconBtn} aria-label={c.name+': düzəliş et'} onClick={()=>open(fromContact(c))}><AIcon name="edit" size={18}/></button><button className={`${ui.iconBtn} ${ui.danger}`} aria-label={c.name+': sil'} onClick={()=>remove(c)}><AIcon name="trash" size={18}/></button></div>
    </div>
    {next?<p className={soon?s.bdaySoon:s.bday}><img src={objectSrc(linked&&!c.birthday?occ(linked.occasion).img:'birthday_cake')} alt="" width="28" height="28"/><span>{label} <b>{dayMonth(next)}</b>{soon&&<em>{countdown(next)}</em>}</span></p>
    :<Link className={s.bdayAdd} href={'/user/occasions?contact_id='+c.id+'&recipient='+encodeURIComponent(c.name)}><img src={objectSrc('birthday_cake')} alt="" width="28" height="28"/>Ad gününü əlavə edin</Link>}
    {c.notes&&<p className={s.notes}>{c.notes}</p>}
    <div className={s.actions}>
     <Link className={ui.link} href={'/user/wishes?recipient='+encodeURIComponent(c.name)+'&relationship='+encodeURIComponent(c.relationship)}>Təbrik yaz</Link>
     <Link className={ui.link} href="/gifts">Hədiyyə tap</Link>
    </div>
   </li>})}</ul></>
  :items&&(query||group?<Empty img="bouquet" title="Bu adla heç kim tapılmadı" text="Adın ilk hərflərini yazın və ya axtarışı təmizləyin." action={<button className={ui.outline} onClick={()=>{setQuery('');setGroup('')}}>Axtarışı təmizlə</button>}/>
   :<Empty img="bouquet" title="Hələ heç kimi əlavə etməmisiniz" text="Anan, dostun, həmkarın. Adını və ad gününü yazın, vaxtı çatanda xatırladaq." action={!edit&&<button className={ui.primary} onClick={()=>open(blank)}>Yaxınını əlavə et</button>}/>)}
  <Pager page={page} last={last} onPage={setPage}/>
 </>;
}
