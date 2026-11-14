'use client';
import {useEffect,useState} from 'react';
import {api,ApiError,Product} from '@/lib/workspace';
import {openKimlik} from '@/lib/kimlik';
import {track} from '@/lib/analytics';
import {site} from '@/messages/site';
import {cleanGiftTitle} from '@/lib/gifts';
import {GiftCard,GiftPhoto,allowedGift} from './HomeInteractions';
import home from './HomePage.module.css';
import s from './ProductDetail.module.css';

const wishOccasions=['birthday','anniversary','wedding','novruz','newyear','graduation','thanks','support'];
const cleanTitle=cleanGiftTitle;
const price=(p:Product)=>p.price_minor===null?null:(p.price_minor/100).toFixed(2).replace('.',',')+' '+(p.currency||'AZN');
const months=['yanvar','fevral','mart','aprel','may','iyun','iyul','avqust','sentyabr','oktyabr','noyabr','dekabr'];
// Fixed timezone so server and browser render the same date.
const bakuDate=new Intl.DateTimeFormat('en-US',{timeZone:'Asia/Baku',day:'numeric',month:'numeric'});
const day=(iso:string)=>{const parts=Object.fromEntries(bakuDate.formatToParts(new Date(iso)).map(x=>[x.type,x.value]));return parts.day+' '+months[Number(parts.month)-1]};

function Heart({on}:{on:boolean}){return <svg viewBox="0 0 24 24" aria-hidden="true" className={s.heart} style={on?{fill:'#a3122f'}:undefined}><path d="M12 21s-7.5-4.6-9.5-9.3C1 8 3.4 4.5 7 4.5c2 0 3.6 1.1 5 3 1.4-1.9 3-3 5-3 3.6 0 6 3.5 4.5 7.2C19.5 16.4 12 21 12 21z"/></svg>}

export default function ProductDetail({id,initial}:{id:string;initial?:Product}){
 const [p,setP]=useState<Product|null>(initial||null),[error,setError]=useState(''),[missing,setMissing]=useState(false),[saved,setSaved]=useState(false),[busy,setBusy]=useState(false),[saveError,setSaveError]=useState('');
 useEffect(()=>{if(initial&&String(initial.id)===id)return;api('catalog/'+id).then(setP).catch(e=>{if(e instanceof ApiError&&e.status===404)setMissing(true);else setError(e.message)})},[id,initial]);
 async function save(){setBusy(true);setSaveError('');try{await api('wishlist/'+id,'PUT',{});setSaved(true);track('gift_saved',{from:'detail'})}catch(e){if(e instanceof ApiError&&e.status===401){try{await openKimlik('/gifts/'+id)}catch(err){setSaveError((err as Error).message)}}else setSaveError((e as Error).message)}finally{setBusy(false)}}

 if(missing||error)return <main className={`${home.root} ${s.page}`}><div className={s.empty}><img src="/concepts/occasions/wrapped_gift.png" alt="" width="96" height="96"/><h1>{missing?'Bu hədiyyə artıq kataloqda yoxdur.':'Hədiyyə yüklənmədi.'}</h1><p>{missing?'Mağaza məhsulu çıxarmış ola bilər. Oxşar seçimlərə baxın.':error}</p><a href="/gifts" className={s.buy}>Hədiyyələrə baxın</a></div></main>;
 if(!p)return <main className={`${home.root} ${s.page}`} aria-busy="true"><div className={s.layout}><div className={`${s.well} ${s.skel}`}/><div className={s.info}><p role="status" className={s.loadingText}>Hədiyyə yüklənir...</p></div></div></main>;

 const cat=site.categories[p.category as keyof typeof site.categories];
 const occ=p.occasions.filter(o=>o in site.occasions);
 const rec=p.recipients.filter(r=>r in site.recipients);
 const wishOcc=occ.find(o=>wishOccasions.includes(o))||'birthday';
 const pr=price(p),out=p.availability==='out_of_stock';
 return <main className={`${home.root} ${s.page}`}>
  <nav className={s.crumbs} aria-label="Yol"><a href="/gifts">Hədiyyələr</a>{cat&&<><span aria-hidden="true">/</span><a href={'/gifts?category='+p.category}>{cat}</a></>}</nav>
  <div className={s.layout}>
   <div className={s.well}>
    <GiftPhoto product={p} eager/>
    {rec[0]&&<span className={s.forTag}>{site.recipients[rec[0] as keyof typeof site.recipients]}</span>}
   </div>
   <div className={s.info}>
    <p className={s.store}>{p.store}</p>
    <h1>{cleanTitle(p.title)}</h1>
    {(occ.length>0||rec.length>0)&&<ul className={s.tags} aria-label="Uyğundur">
     {occ.map(o=><li key={o}><a href={'/gifts?occasion='+o}>{site.occasions[o as keyof typeof site.occasions]}</a></li>)}
     {rec.map(r=><li key={r}><a className={s.tagSoft} href={'/gifts?recipient='+r}>{site.recipients[r as keyof typeof site.recipients]}</a></li>)}
    </ul>}
    <div className={s.priceBox}>
     <div className={s.priceRow}><strong>{pr||'Qiymət mağazada'}</strong><span className={out?s.stockOut:s.stockIn}>{out?'Hazırda yoxdur':'Mağazada var'}</span></div>
     <p className={s.checked}>{p.stale?'Qiymət köhnələ bilər, mağazada yoxlayın.':p.checked_at?day(p.checked_at)+' tarixində mağazada yoxlanılıb.':'Mağazanın göstərdiyi qiymət.'}</p>
     <div className={s.actions}>
      <a href={p.source_url} target="_blank" rel="noopener noreferrer" className={s.buy} onClick={()=>track('store_click',{store:p.store,id:String(p.id)})}>{p.store}-də al<svg viewBox="0 0 24 24" aria-hidden="true" className={s.ext}><path d="M14 4h6v6M20 4l-9 9M18 14v6H4V6h6"/></svg></a>
      <button type="button" className={s.save} onClick={save} disabled={busy||saved} aria-pressed={saved}><Heart on={saved}/>{saved?'Siyahınızdadır':'Siyahıma əlavə et'}</button>
     </div>
     {saveError&&<p role="alert" className={s.error}>{saveError}</p>}
     {saved&&<p role="status" className={s.ok}>Əlavə edildi. <a href="/user/wishlist">Hədiyyə siyahım</a></p>}
     <p className={s.storeNote}>Wisher bu məhsulu satmır. Ödəniş, çatdırılma və qaytarma {p.store} saytında olur.</p>
    </div>
    <a href={'/wishes?occasion='+wishOcc} className={s.greet}>
     <span className={s.greetCard} aria-hidden="true"><b>Əziz Aysel,</b><i/><i/><i/></span>
     <span className={s.greetText}><b>Hədiyyənin yanına təbrik yazın</b><span>Kimə və nə münasibətilə olduğunu deyin, Wisher üç variant hazırlasın.</span><em>Təbrik hazırla</em></span>
    </a>
   </div>
  </div>
  <Related product={p}/>
 </main>;
}

function Related({product}:{product:Product}){
 const [items,setItems]=useState<Product[]|null>(null);
 useEffect(()=>{let alive=true;api('catalog?category='+product.category).then(d=>{const same=d.data.filter((x:Product)=>x.id!==product.id&&allowedGift(x));return same.length>=4?same:api('catalog').then(all=>[...same,...all.data.filter((x:Product)=>x.id!==product.id&&allowedGift(x)&&!same.some((y:Product)=>y.id===x.id))])}).then(list=>{if(alive)setItems(list.slice(0,4))}).catch(()=>{if(alive)setItems([])});return()=>{alive=false}},[product.id,product.category]);
 if(items&&!items.length)return null;
 return <section className={s.related} aria-labelledby="related">
  <div className={s.relatedHead}><h2 id="related">Bunlara da baxın</h2><a href="/gifts" className={s.allLink}>Bütün hədiyyələr</a></div>
  {items?<div className={s.grid}>{items.map(x=><GiftCard key={x.id} product={x}/>)}</div>:<p role="status" className={s.loadingText}>Yüklənir...</p>}
 </section>;
}
