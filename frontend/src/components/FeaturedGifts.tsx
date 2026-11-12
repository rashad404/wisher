'use client';
import {useEffect,useState} from 'react';
import Link from 'next/link';
import {api,Product} from '@/lib/workspace';
import {ProductCard} from './ProductCatalog';
import {Icon} from './HomeOpening';
export default function FeaturedGifts(){const [items,setItems]=useState<Product[]>([]);useEffect(()=>{let active=true;api('catalog').then(d=>{if(active)setItems(d.data.slice(0,3))}).catch(()=>{});return()=>{active=false}},[]);if(!items.length)return null;return <section className="content-section"><div className="section-top"><div><span className="kicker">Mağazalardan seçimlər</span><h2>Bir neçə hədiyyə fikri.</h2></div><Link href="/gifts" className="text-action">Bütün seçimlər <Icon name="arrow"/></Link></div><div className="product-grid">{items.map(p=><ProductCard key={p.id} product={p}/>)}</div></section>}
