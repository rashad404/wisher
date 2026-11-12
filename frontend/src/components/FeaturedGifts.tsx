'use client';
import {useEffect,useState} from 'react';
import Link from 'next/link';
import {api,Product} from '@/lib/workspace';
import {ProductCard} from './ProductCatalog';
import {homeContent as t} from '@/messages/opening';
import {Icon} from './HomeOpening';
export default function FeaturedGifts(){const [items,setItems]=useState<Product[]>([]);useEffect(()=>{let active=true;api('catalog').then(d=>{if(active)setItems(d.data.slice(0,6))}).catch(()=>{});return()=>{active=false}},[]);if(!items.length)return null;return <section className="content-section"><div className="section-top"><div><h2>{t.giftsTitle}</h2><p>{t.giftsIntro}</p></div><Link href="/gifts" className="text-action">{t.allGifts} <Icon name="arrow"/></Link></div><div className="product-grid">{items.map(p=><ProductCard key={p.id} product={p}/>)}</div></section>}
