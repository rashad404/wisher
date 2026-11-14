'use client';
import {FormEvent,useEffect,useRef,useState} from 'react';
import {api,Product} from '@/lib/workspace';
import {GiftCard,allowedGift} from './HomeInteractions';
import {site} from '@/messages/site';
import home from './HomePage.module.css';
import s from './GiftsOpening.module.css';

const occasions:[string,string,string,string][]=[
 ['birthday','Ad günü','birthday_cake','#fde8ec'],
 ['novruz','Novruz','seedling','#e6f4ea'],
 ['womens_day','8 Mart','tulip','#fff0e6'],
 ['newyear','Yeni il','christmas_tree','#e8f0fb'],
 ['wedding','Toy və nişan','ring','#f3ecfb'],
 ['birth','Uşaq doğuldu','baby_bottle','#e6f6f8'],
 ['teachers_day','Müəllimlər günü','graduation_cap','#fdf6dd'],
 ['thanks','Təşəkkür','bouquet','#fbe9f3'],
];
const budgets:[string,string,string][]=[['','','Hər büdcə'],['','50','50 AZN-ə qədər'],['50','150','50-150 AZN'],['150','','150 AZN-dən çox']];

export default function GiftsOpening({initial}:{initial?:Product[]}){
 const [query,setQuery]=useState<string|null>(null),[products,setProducts]=useState<Product[]|null>(initial?initial.filter(allowedGift).slice(0,10):null),[error,setError]=useState(''),[retry,setRetry]=useState(0);
 const first=useRef(true);
 useEffect(()=>setQuery(location.search.slice(1)),[]);
 useEffect(()=>{if(query===null)return;if(first.current){first.current=false;if(query===''&&initial)return}let active=true;setProducts(null);setError('');api('catalog?'+query).then(d=>{if(active)setProducts(d.data.filter(allowedGift).slice(0,10))}).catch(e=>{if(active)setError(e.message)});return()=>{active=false}},[query,retry]);
 const params=new URLSearchParams(query||'');
 function apply(next:URLSearchParams){const q=next.toString();history.replaceState(null,'','/gifts'+(q?'?'+q:''));setQuery(q)}
 function set(changes:Record<string,string>){const next=new URLSearchParams(params);Object.entries(changes).forEach(([k,v])=>v?next.set(k,v):next.delete(k));apply(next)}
 function toggle(key:string,value:string){set({[key]:params.get(key)===value?'':value})}
 function search(e:FormEvent<HTMLFormElement>){e.preventDefault();set({q:String(new FormData(e.currentTarget).get('q')||'').trim()})}
 const budgetOn=(min:string,max:string)=>(params.get('min')||'')===min&&(params.get('max')||'')===max;
 const filtered=['q','occasion','recipient','min','max'].some(k=>params.get(k));
 return <main className={`${home.root} ${s.page}`}>
  <section className={s.intro}>
   <div><h1>Onu sevindirəcək<br/>hədiyyəni tapın.</h1><p>Azərbaycan mağazalarından seçimlər. Bəyəndiyinizi mağazanın öz saytından alırsınız.</p></div>
   {query!==null&&<form key={'q'+(params.get('q')||'')} className={s.search} onSubmit={search} role="search">
    <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M20 20l-4-4"/></svg>
    <input name="q" placeholder="Hədiyyə axtarın: dinamik, kitab, çiçək..." maxLength={100} defaultValue={params.get('q')||''} aria-label="Hədiyyə axtarın"/>
    <button type="submit">Axtar</button>
   </form>}
  </section>

  <section className={s.occasions} aria-label="Münasibət">
   {occasions.map(([v,label,img,bg])=><button key={v} type="button" className={params.get('occasion')===v?s.occOn:s.occ} style={{background:bg}} onClick={()=>toggle('occasion',v)} aria-pressed={params.get('occasion')===v}>
    <b>{label}</b><img src={`/concepts/occasions/${img}.png`} alt="" width="64" height="64"/>
   </button>)}
  </section>

  <section className={s.chipsRow}>
   <div className={s.group} role="group" aria-label="Kimə"><span>Kimə</span>
    <button type="button" className={!params.get('recipient')?s.chipOn:s.chip} onClick={()=>set({recipient:''})}>Hamısı</button>
    {Object.entries(site.recipients).map(([v,l])=><button key={v} type="button" className={params.get('recipient')===v?s.chipOn:s.chip} onClick={()=>toggle('recipient',v)}>{l}</button>)}
   </div>
   <div className={s.group} role="group" aria-label="Büdcə"><span>Büdcə</span>
    {budgets.map(([min,max,l])=><button key={l} type="button" className={budgetOn(min,max)?s.chipOn:s.chip} onClick={()=>set({min,max})}>{l}</button>)}
   </div>
  </section>

  <div className={s.resultsHead}><h2>{filtered?'Seçiminizə uyğun hədiyyələr':'Bu həftə seçdiklərimiz'}</h2>{filtered&&<button type="button" className={s.reset} onClick={()=>apply(new URLSearchParams())}>Filtrləri sıfırla</button>}<a href="/user/wishlist" className={s.wishlist}>Hədiyyə siyahım</a></div>
  {error?<p role="alert">{error} <button onClick={()=>setRetry(retry+1)}>Yenidən yoxla</button></p>:products?<div className={home.giftGrid}>{products.length?products.map(p=><GiftCard key={p.id} product={p}/>):<p className={s.empty}>Uyğun hədiyyə tapılmadı. Başqa münasibət və ya büdcə seçin.</p>}</div>:<p role="status">Hədiyyələr yüklənir...</p>}
  <p className={s.note}>Qiymətlər mağazaların saytından götürülür. Alış-veriş mağazanın öz saytında olur.</p>
 </main>;
}
