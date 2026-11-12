'use client';
import {useEffect,useState} from 'react';
import Link from 'next/link';
import {api,Product,money} from '@/lib/workspace';
import {ProductImage} from './ProductCatalog';
import {homeContent as t} from '@/messages/opening';
import {site} from '@/messages/site';
import {Icon} from './HomeOpening';
export default function FeaturedGifts(){
 const [items,setItems]=useState<Product[]>([]),[category,setCategory]=useState(''),[state,setState]=useState('loading');
 async function load(){setState('loading');try{const d=await api('catalog');setItems(d.data.slice(0,6));setState('ready')}catch{setState('error')}}
 useEffect(()=>{load()},[]);
 const categories=[...new Set(items.map(p=>p.category))],shown=items.filter(p=>!category||p.category===category);
 return <section className="gift-collection"><div className="section-top"><div><h2>{t.giftsTitle}</h2><p>{t.giftsIntro}</p></div><Link href="/gifts" className="text-action">{t.allGifts}<Icon name="arrow"/></Link></div><div className="collection-filters" aria-label={t.filterLabel}>{['',...categories].map(c=><button key={c} aria-pressed={category===c} onClick={()=>setCategory(c)}>{c?site.categories[c as keyof typeof site.categories]:t.all}</button>)}</div>{state==='loading'?<p className="collection-status" role="status">{t.catalogLoading}</p>:state==='error'?<div className="collection-status" role="alert"><p>{t.catalogError}</p><button className="quiet-button" onClick={load}>{t.retry}</button></div>:!shown.length?<p className="collection-status">{t.catalogEmpty}</p>:<div className="gift-collection-grid">{shown.map(p=><article className="gift-item" key={p.id}><Link className="gift-item-image" href={'/gifts/'+p.id}><ProductImage product={p}/></Link><div className="gift-item-meta"><span>{p.store}</span><span>{site.categories[p.category as keyof typeof site.categories]}</span></div><Link href={'/gifts/'+p.id} className="gift-item-name"><h3>{p.title.replace(/\s+\d{10,14}/g,'').replace(/\s*\([^)]*\)\s*$/,'')}</h3></Link><div className="gift-item-price"><strong>{p.price_minor===null?t.priceUnknown:money(p.price_minor)}</strong><Link href={'/gifts/'+p.id} aria-label={t.viewGift+': '+p.title}><Icon name="arrow"/></Link></div><p className="price-note">{p.stale?t.stale:t.priceNote}</p></article>)}</div>}</section>
}
