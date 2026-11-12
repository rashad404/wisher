'use client';

import {useEffect,useState} from 'react';
import {api,Product,money} from '@/lib/workspace';
import {ProductImage} from './ProductCatalog';
import {downloadCard} from '@/lib/card';
import {opening as t} from '@/messages/opening';
import Link from 'next/link';

import HomeSections from './HomeSections';
import s from './HomeOpening.module.css';

export function Icon({name}:{name:string}) {
 const paths:Record<string,string>={menu:'M4 7h16M4 12h16M4 17h16',close:'m6 6 12 12M18 6 6 18',arrow:'M4 12h16m-6-6 6 6-6 6',gift:'M3 8h18v4H3zM5 12v9h14v-9M12 8v13M12 8H8a3 3 0 1 1 3-3l1 3Zm0 0h4a3 3 0 1 0-3-3l-1 3Z',home:'m3 10 9-7 9 7M5 9v12h14V9M9 21v-8h6v8',heart:'M20 5a5 5 0 0 0-8 1 5 5 0 0 0-8-1c-5 5 8 15 8 15S25 10 20 5Z',user:'M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8M4 21v-2a7 7 0 0 1 7-5h2a7 7 0 0 1 7 5v2',calendar:'M4 5h16v16H4zM8 2v6M16 2v6M4 11h16',business:'M4 7h16v14H4zM9 7V3h6v4M4 12h16M10 12v3h4v-3'};
 return <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true"><path d={paths[name]}/></svg>;
}
export function Brand(){return <Link href="/" className={s.brand} aria-label="Wisher ana səhifə">wisher<span>.az</span></Link>}
export default function HomeOpening(){
 const [products,setProducts]=useState<Product[]>([]),[selected,setSelected]=useState(0),[status,setStatus]=useState('loading'),[panel,setPanel]=useState('gift');
 async function load(){setStatus('loading');try{const d=await api('catalog?occasion=birthday');const list=(d.data as Product[]).filter(p=>p.availability!=='out_of_stock');const flowers=list.find(p=>p.source_url.includes('flowers-in-watering-can'));const coffee=list.find(p=>p.category==='home');const speaker=list.find(p=>p.source_url.includes('jbl-go-5'));const picks=[flowers,coffee,speaker].filter((p):p is Product=>Boolean(p));setProducts(picks.length?picks:list.slice(0,3));setSelected(0);setStatus('ready')}catch{setStatus('error')}}
 useEffect(()=>{load()},[]);const product=products[selected];
 return <><main className={s.main}>
  <section className={s.opening} aria-labelledby="opening-title">
   <div className={s.copy}>
    <div className={s.eyebrow}>{t.eyebrow}</div>
    <h1 id="opening-title"><span>{t.titleA}</span><span>{t.titleB}</span></h1>
    <p>{t.intro}</p>
    <div className={s.actions}><Link className={s.primary} href="/gifts">{t.primary}<Icon name="arrow"/></Link><Link className={s.secondary} href="/wishes">{t.secondary}</Link></div>
   </div>
   <div className={s.stage}>
    <div className={s.stageTop}><div><Icon name="calendar"/><strong>{t.occasion}</strong><span>{t.date}<span className={s.sampleInline}>{t.shortExample}</span></span></div><span>{t.example}</span></div>
    <div className={s.mobileSwitch} aria-label={t.example}><button aria-pressed={panel==='gift'} onClick={()=>setPanel('gift')}>{t.gift}</button><button aria-pressed={panel==='card'} onClick={()=>setPanel('card')}>{t.card}</button></div>
    <div className={s.productMoment}>
     <section className={`${s.giftPanel} ${panel!=='gift'?s.mobileHidden:''}`} aria-label={t.gift}>
      {product?<><Link className={s.bigProduct} href={'/gifts/'+product.id}><ProductImage key={product.id} product={product}/></Link><div className={s.giftInfo}><span className={s.store}>{product.store}</span><Link href={'/gifts/'+product.id}><h2>{product.title}</h2></Link><div className={s.priceRow}><strong>{product.price_minor===null?t.priceUnknown:money(product.price_minor)}</strong><Link href={'/gifts/'+product.id}>{t.viewGift}<Icon name="arrow"/></Link></div><span className={s.priceNote}>{product.stale?t.stale:t.priceNote}</span></div></>:<div className={s.giftState} role="status"><p>{status==='loading'?t.loading:status==='error'?t.failed:t.empty}</p>{status==='error'&&<button onClick={load}>{t.retry}</button>}</div>}
      {products.length>1&&<div className={s.giftChoices} aria-label={t.chooseGift}>{products.map((p,i)=><button key={p.id} aria-pressed={selected===i} onClick={()=>setSelected(i)} aria-label={p.title}><ProductImage product={p}/><span>{p.price_minor===null?t.priceUnknown:money(p.price_minor)}</span></button>)}</div>}
     </section>
     <section className={`${s.cardPanel} ${panel!=='card'?s.mobileHidden:''}`} aria-label={t.card}>
      <div className={s.cardLabel}><span>{t.card}</span><span>{t.recipient}</span></div>
      <article className={s.realCard}><h2>{t.recipient}</h2><p>{t.greeting}</p><span>wisher.az</span></article>
      <div className={s.stageBottom}><button onClick={()=>downloadCard(t.greeting,t.recipient,'','#fffdf7','#242620')}>{t.download}<Icon name="arrow"/></button><span>{t.exampleNote}</span></div>
     </section>
    </div>
    <div className={s.personalDetail}><span>{t.detail}</span><Link href="/user/occasions"><Icon name="calendar"/>{t.date}<Icon name="arrow"/></Link></div>
   </div>
  </section>
 </main><HomeSections/></>;
}
