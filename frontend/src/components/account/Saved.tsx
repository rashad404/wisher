'use client';
import {useEffect,useState} from 'react';
import Link from 'next/link';
import {api} from '@/lib/workspace';
import {AIcon,Alert,Empty,Loading,PageHead,Toast,ui} from './AccountShell';
import {occ,waLink} from './lib';
import Pager from './Pager';
import s from './Saved.module.css';

export type Wish={id:number;brief:Record<string,string>;variants:string[];selected_text?:string|null;saved:boolean;provider:string;status:string};
const TONES:Record<string,string>={warm:'Səmimi',funny:'Zarafatcıl',formal:'Rəsmi',heartfelt:'Duyğulu'};
const textOf=(w:Wish)=>w.selected_text||w.variants?.[0]||'';

export function GreetingCard({wish,variant='white',compact=false,children}:{wish:Wish;variant?:'red'|'white'|'green';compact?:boolean;children?:React.ReactNode}){
 const o=occ(wish.brief.occasion);
 return <article className={`${s.card} ${s[variant]} ${compact?s.compact:''}`}>
  <div className={s.cardTop}><span className={s.tag}>{o.label}</span>{wish.brief.tone&&TONES[wish.brief.tone]&&<span className={s.tone}>{TONES[wish.brief.tone]}</span>}<img src={`/concepts/occasions/${o.img}.png`} alt="" width="36" height="36"/></div>
  <h3 className={s.to}>{wish.brief.recipient||'Yaxınım'} üçün</h3>
  {children||<p className={s.body}>{textOf(wish)}</p>}
 </article>;
}

export default function Saved(){
 const [items,setItems]=useState<Wish[]|null>(null),[page,setPage]=useState(1),[last,setLast]=useState(1),[error,setError]=useState(false),[notice,setNotice]=useState(''),[editing,setEditing]=useState<number|null>(null),[draft,setDraft]=useState(''),[busy,setBusy]=useState(false);
 async function load(){try{const d=await api('wishes?page='+page);setItems(d.data);setLast(d.last_page);setError(false)}catch{setError(true)}}
 useEffect(()=>{load()},[page]);
 async function save(w:Wish){setBusy(true);try{await api('wishes/'+w.id,'PUT',{text:draft});setItems(items!.map(i=>i.id===w.id?{...i,selected_text:draft}:i));setEditing(null);setNotice('Təbrik yadda saxlanıldı.')}catch{setError(true)}finally{setBusy(false)}}
 async function copy(w:Wish){try{await navigator.clipboard.writeText(textOf(w));setNotice('Mətn köçürüldü. İstədiyiniz yerə yapışdırın.')}catch{setNotice('Mətni seçib köçürə bilərsiniz.')}}
 async function remove(w:Wish){if(!confirm('Bu təbriki silmək istəyirsiniz?'))return;try{await api('wishes/'+w.id,'DELETE');setNotice('Təbrik silindi.');await load()}catch{setError(true)}}
 return <>
  <PageHead title="Təbriklərim" lead="Saxladığınız təbriklər kart kimi burada qalır. Köçürün, WhatsApp-da göndərin və ya düzəliş edin." action={<Link className={ui.primary} href="/user/wishes"><AIcon name="plus"/>Yeni təbrik</Link>}/>
  {error&&<Alert onRetry={load}>Təbriklər yüklənmədi.</Alert>}
  {notice&&<Toast>{notice}</Toast>}
  {!items&&!error?<Loading/>:items&&items.length?<div className={s.grid}>{items.map((w,i)=><GreetingCard key={w.id} wish={w} variant="white">
   {editing===w.id?<div className={s.editor}><label className={ui.well}><span>Təbrik mətni</span><textarea value={draft} maxLength={2000} rows={7} onChange={e=>setDraft(e.target.value)} autoFocus/></label><div className={s.actions}><button className={ui.primary} disabled={busy||!draft.trim()} onClick={()=>save(w)}>{busy?'Saxlanılır...':'Yadda saxla'}</button><button className={ui.quiet} onClick={()=>setEditing(null)}>Ləğv et</button></div></div>
   :<><p className={s.body}>{textOf(w)}</p><div className={s.actions}>
    <a className={s.wa} href={waLink(textOf(w))} target="_blank" rel="noopener noreferrer"><AIcon name="whatsapp" size={18}/>WhatsApp-da göndər</a>
    <button className={s.act} onClick={()=>copy(w)}><AIcon name="copy" size={18}/>Köçür</button>
    <button className={s.act} onClick={()=>{setEditing(w.id);setDraft(textOf(w));setNotice('')}}><AIcon name="edit" size={18}/>Düzəlt</button>
    <button className={`${ui.iconBtn} ${ui.danger} ${s.del}`} aria-label={(w.brief.recipient||'')+' üçün təbriki sil'} onClick={()=>remove(w)}><AIcon name="trash" size={18}/></button>
   </div></>}
  </GreetingCard>)}</div>
  :items&&<Empty img="heart" title="Hələ təbrik saxlamamısınız" text="Təbrik hazırlayın, bəyəndiyiniz variantı saxlayın. O, burada kart kimi görünəcək." action={<Link className={ui.primary} href="/user/wishes">Təbrik yaz</Link>}/>}
  <Pager page={page} last={last} onPage={setPage}/>
 </>;
}
