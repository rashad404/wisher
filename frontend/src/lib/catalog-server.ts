import {cache} from 'react';
import type {Page,Product} from './workspace';
const base=()=>process.env.API_URL||'http://127.0.0.1:8022';
// Public catalog reads for server rendering, metadata and the sitemap.
export const getProduct=cache(async(id:string):Promise<Product|null|'error'>=>{
 try{const r=await fetch(`${base()}/api/catalog/${id}`,{headers:{Accept:'application/json'},next:{revalidate:600},signal:AbortSignal.timeout(8000)});if(r.status===404)return null;if(!r.ok)return 'error';return await r.json()}catch{return 'error'}
});
export async function getCatalogPage(query='',page=1):Promise<Page<Product>|null>{
 try{const q=new URLSearchParams(query);if(page>1)q.set('page',String(page));const r=await fetch(`${base()}/api/catalog${q.size?'?'+q:''}`,{headers:{Accept:'application/json'},next:{revalidate:600},signal:AbortSignal.timeout(8000)});return r.ok?await r.json():null}catch{return null}
}
export async function getAllProducts(max=50):Promise<Product[]>{
 const first=await getCatalogPage();if(!first)return [];const all=[...first.data];
 for(let p=2;p<=Math.min(first.last_page,max);p++){const next=await getCatalogPage('',p);if(!next)break;all.push(...next.data)}
 return all;
}
