import type {MetadataRoute} from 'next';
import {CONTENT_UPDATED,SITE,indexable,staticPages} from '@/lib/seo';
import {getAllProducts} from '@/lib/catalog-server';
import {allowedGift} from '@/lib/gifts';
import {greetingPages} from '@/messages/greetings';
export const revalidate=3600;
export default async function sitemap():Promise<MetadataRoute.Sitemap> {
 if(!indexable())return [];
 const updated=new Date(CONTENT_UPDATED);
 const url=(path:string)=>path==='/'?SITE:SITE+path;
 const pages:MetadataRoute.Sitemap=[...Object.keys(staticPages),'/tebrikler',...greetingPages.map(p=>'/tebrikler/'+p.slug)].map(path=>({url:url(path),lastModified:updated,changeFrequency:path==='/'||path==='/gifts'?'daily':'monthly',priority:path==='/'?1:path.startsWith('/tebrikler')||path==='/gifts'?0.8:['/privacy','/terms'].includes(path)?0.3:0.6}));
 const products=(await getAllProducts()).filter(allowedGift).map(p=>({url:SITE+'/gifts/'+p.id,lastModified:new Date(p.checked_at||(p as {updated_at?:string}).updated_at||updated),changeFrequency:'weekly' as const,priority:0.5}));
 return [...pages,...products];
}
