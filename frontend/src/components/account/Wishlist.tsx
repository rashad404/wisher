'use client';
import {useEffect,useState} from 'react';
import Link from 'next/link';
import {api,Page,Product} from '@/lib/workspace';
import {GiftPhoto} from '../HomeInteractions';
import {Alert,Empty,Loading,PageHead,Toast,ui} from './AccountShell';
import Pager from './Pager';
import home from '../HomePage.module.css';
import s from './Wishlist.module.css';

const priceFor=(p:Product)=>p.price_minor===null?'Qiymət mağazada':(p.price_minor/100).toFixed(2).replace('.',',')+' '+p.currency;

// The approved product card from home and /gifts, with the heart filled: tapping it removes the gift.
function SavedGift({product:p,onRemove}:{product:Product;onRemove:()=>void}){
 return <article className={home.gift}>
  <a href={'/gifts/'+p.id} className={home.giftPhoto}><GiftPhoto product={p}/></a>
  <button type="button" className={home.save} aria-label={p.title+': siyahıdan sil'} aria-pressed="true" onClick={onRemove}><svg viewBox="0 0 24 24" aria-hidden="true" style={{fill:'#a3122f'}}><path d="M12 21s-7.5-4.6-9.5-9.3C1 8 3.4 4.5 7 4.5c2 0 3.6 1.1 5 3 1.4-1.9 3-3 5-3 3.6 0 6 3.5 4.5 7.2C19.5 16.4 12 21 12 21z"/></svg></button>
  <a href={'/gifts/'+p.id} className={home.giftInfo}><strong>{priceFor(p)}</strong><span>{p.title}</span><small>{p.store}</small></a>
  {p.availability==='out_of_stock'&&<small className={s.warn}>Hazırda mövcud deyil</small>}
  {p.stale&&p.availability!=='out_of_stock'&&<small className={s.warn}>Qiyməti mağazada yoxlayın</small>}
  <a className={s.shop} href={p.source_url} target="_blank" rel="noopener noreferrer">Mağazada bax</a>
 </article>;
}

export default function Wishlist(){
 const [page,setPage]=useState(1),[data,setData]=useState<Page<Product>|null>(null),[error,setError]=useState(''),[removed,setRemoved]=useState<Product|null>(null);
 async function load(p=page){try{const d=await api('wishlist?page='+p);if(!d.data.length&&p>1){setPage(p-1);return}setData(d);setError('')}catch(e){setError((e as Error).message)}}
 useEffect(()=>{load(page)},[page]);
 async function remove(p:Product){try{await api('wishlist/'+p.id,'DELETE');setRemoved(p);await load()}catch(e){setError((e as Error).message)}}
 async function undo(){if(!removed)return;try{await api('wishlist/'+removed.id,'PUT',{});setRemoved(null);await load()}catch(e){setError((e as Error).message)}}
 return <>
  <PageHead title="Hədiyyə siyahım" lead="Bəyəndiyiniz hədiyyələr bir yerdə. Alış-veriş mağazanın öz saytında olur, son qiyməti orada yoxlayın." action={<Link className={ui.outline} href="/gifts">Hədiyyələrə bax</Link>}/>
  {removed&&<Toast action={<button onClick={undo}>Geri qaytar</button>}>{removed.title} siyahıdan silindi.</Toast>}
  {error&&<Alert onRetry={()=>load()}>{error}</Alert>}
  {!data&&!error?<Loading rows={2}/>:data?.data.length?<>
   <p className={s.count}>{data.total} hədiyyə</p>
   <div className={`${home.root} ${s.wrap}`}><div className={`${home.giftGrid} ${s.grid}`}>{data.data.map(p=><SavedGift key={p.id} product={p} onRemove={()=>remove(p)}/>)}</div></div>
   <Pager page={data.current_page} last={data.last_page} onPage={setPage}/>
  </>:data&&<Empty img="wrapped_gift" title="Hələ hədiyyə saxlamamısınız" text="Hədiyyələrdə ürək işarəsinə toxunun, bəyəndiyiniz məhsul burada qalsın." action={<Link className={ui.primary} href="/gifts">Hədiyyə tap</Link>}/>}
 </>;
}
