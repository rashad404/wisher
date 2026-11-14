import type {Metadata} from 'next';
import type {Product} from './workspace';
import {cleanGiftTitle,giftImageFor,giftTitles} from './gifts';

export const SITE='https://wisher.az';
export const SITE_NAME='Wisher.az';
export const OG_IMAGE={url:'/og.png',width:1200,height:630,alt:'Wisher.az: hədiyyələr, təbriklər və özəl günlər'};
// Date the static public copy last changed; bump when page text changes.
export const CONTENT_UPDATED='2026-11-14';
export const indexable=()=>process.env.SITE_INDEXABLE==='true';
export const absolute=(path:string)=>path==='/'?SITE:SITE+path;

export type PageSeo={title:string;description:string};
export const staticPages:Record<string,PageSeo>={
 '/':{title:'Wisher.az - Hədiyyə fikirləri, təbriklər və xatırlatmalar',description:'Yaxınlarınızın ad gününü unutmayın: xatırlatma qurun, Azərbaycan mağazalarından hədiyyə seçin və sizin sözlərinizlə təbrik hazırlayın.'},
 '/gifts':{title:'Hədiyyə fikirləri: ad günü və bayram hədiyyələri - Wisher',description:'Ad günü, Yeni il, 8 Mart və Novruz üçün hədiyyə fikirləri. Azərbaycan mağazalarından seçimlər, qiymət və büdcəyə görə.'},
 '/wishes':{title:'Təbrik yaz: şəxsi ad günü və bayram təbrikləri - Wisher',description:'Kimə yazdığınızı və bir xatirəni deyin, Wisher üç təbrik variantı hazırlasın. Azərbaycan, rus və ingilis dilində, kart kimi endirin.'},
 '/companies':{title:'Şirkətlər üçün təbrik və hədiyyə planları - Wisher',description:'Əməkdaşların ad günləri, müştərilərə təşəkkür və bayramlar üçün təbrik planı. İnsanlar, büdcə və şirkət kartı bir yerdə.'},
 '/about':{title:'Haqqımızda - Wisher.az',description:'Wisher yaxınlarınızın özəl günlərini xatırlamağa, uyğun hədiyyə tapmağa və səmimi təbrik yazmağa kömək edir.'},
 '/faq':{title:'Suallar və cavablar - Wisher.az',description:'Hədiyyələr, təbriklər, xatırlatmalar və hesab haqqında ən çox verilən suallar və cavablar.'},
 '/privacy':{title:'Məxfilik siyasəti - Wisher.az',description:'Wisher hansı məlumatları saxlayır, necə istifadə edir və məlumatlarınızı necə silə bilərsiniz.'},
 '/terms':{title:'İstifadə şərtləri - Wisher.az',description:'Wisher.az xidmətindən istifadə qaydaları: hədiyyələr, təbriklər, hesab və məsuliyyət.'},
};

export function pageMetadata(path:string,seo:PageSeo,opts:{index?:boolean;image?:{url:string;width?:number;height?:number;alt?:string};type?:'website'|'article'}={}):Metadata{
 const url=absolute(path),index=(opts.index??true)&&indexable(),image=opts.image||OG_IMAGE;
 return {
  title:{absolute:seo.title},description:seo.description,
  robots:{index,follow:index},
  alternates:{canonical:url,languages:{az:url,'x-default':url}},
  openGraph:{type:opts.type||'website',url,title:seo.title,description:seo.description,siteName:SITE_NAME,locale:'az_AZ',images:[image]},
  twitter:{card:'summary_large_image',title:seo.title,description:seo.description,images:[image.url]},
 };
}

export const organizationLd={'@context':'https://schema.org','@type':'Organization','@id':SITE+'/#organization',name:'Wisher',alternateName:'Wisher.az',url:SITE,logo:SITE+'/icon-512.png'};
export const websiteLd={'@context':'https://schema.org','@type':'WebSite','@id':SITE+'/#website',name:SITE_NAME,url:SITE,inLanguage:'az',publisher:{'@id':SITE+'/#organization'},potentialAction:{'@type':'SearchAction',target:{'@type':'EntryPoint',urlTemplate:SITE+'/gifts?q={search_term_string}'},'query-input':'required name=search_term_string'}};
export function breadcrumbLd(items:[string,string][]){return {'@context':'https://schema.org','@type':'BreadcrumbList',itemListElement:[['Ana səhifə','/'],...items].map(([name,path],i)=>({'@type':'ListItem',position:i+1,name,item:absolute(path)}))}}
export function faqLd(items:[string,string][]){return {'@context':'https://schema.org','@type':'FAQPage',mainEntity:items.map(([q,a])=>({'@type':'Question',name:q,acceptedAnswer:{'@type':'Answer',text:a}}))}}
export function productLd(p:Product){
 const image=productImage(p);
 return {'@context':'https://schema.org','@type':'Product',name:cleanGiftTitle(p.title),description:p.description||undefined,image,url:SITE+'/gifts/'+p.id,category:p.category,
  ...(p.price_minor!==null?{offers:{'@type':'Offer',url:p.source_url,price:(p.price_minor/100).toFixed(2),priceCurrency:p.currency||'AZN',availability:p.availability==='out_of_stock'?'https://schema.org/OutOfStock':'https://schema.org/InStock',seller:{'@type':'Organization',name:p.store}}}:{})};
}
export const productPrice=(p:Product)=>p.price_minor===null?null:(p.price_minor/100).toFixed(2).replace('.',',')+' '+(p.currency||'AZN');
export const productImage=(p:Product)=>{const img=giftImageFor(p);return img?(img.startsWith('/')?SITE+img:img):undefined};
export function productSeo(p:Product):PageSeo{
 const name=giftTitles[p.id]||cleanGiftTitle(p.title),price=productPrice(p);
 const suffix=' - hədiyyə | Wisher';
 const title=(name.length+suffix.length<=60?name:name.slice(0,60-suffix.length-3).trimEnd()+'...')+suffix;
 let description=name+(price?', '+price:'')+'. '+p.store+' mağazasından hədiyyə fikri. Wisher-də seçin, mağazanın saytında alın.';
 if(description.length>155)description=description.slice(0,152).replace(/\s+\S*$/,'')+'...';
 return {title,description};
}
