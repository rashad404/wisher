import HomePage from '@/components/HomePage';
import GiftsOpening from '@/components/GiftsOpening';
import Workspace from '@/components/Workspace';
import {InfoPage,faqPlain} from '@/components/InfoPages';
import AccountGate from '@/components/AccountGate';
import CompanyWorkspace from '@/components/CompanyWorkspace';
import Reminders from '@/components/Reminders';
import Wishlist from '@/components/account/Wishlist';
import KimlikCallback from '@/components/KimlikCallback';
import WishesStudio from '@/components/WishesStudio';
import CompaniesPage from '@/components/CompaniesLanding';
import ProductDetail from '@/components/ProductDetail';
import {GreetingLanding,GreetingsHub} from '@/components/GreetingLanding';
import JsonLd from '@/components/JsonLd';
import {notFound} from 'next/navigation';
import type {Metadata} from 'next';
import {breadcrumbLd,faqLd,pageMetadata,productImage,productLd,productSeo,staticPages} from '@/lib/seo';
import {getCatalogPage,getProduct} from '@/lib/catalog-server';
import {cleanGiftTitle} from '@/lib/gifts';
import {greetingBySlug,greetingsHub} from '@/messages/greetings';

type Props={params:Promise<{slug?:string[]}>};
const pathOf=async(params:Props['params'])=>'/'+((await params).slug||[]).join('/');
const crumbs:Record<string,string>={'/gifts':'Hədiyyələr','/wishes':'Təbrik yaz','/companies':'Şirkətlər üçün','/about':'Haqqımızda','/faq':'Suallar və cavablar','/privacy':'Məxfilik','/terms':'İstifadə şərtləri'};

export async function generateMetadata({params}:Props):Promise<Metadata>{
 const path=await pathOf(params);
 if(staticPages[path])return pageMetadata(path,staticPages[path]);
 if(path==='/tebrikler')return pageMetadata(path,greetingsHub);
 const greet=path.startsWith('/tebrikler/')&&greetingBySlug(path.slice(11));
 if(greet)return pageMetadata(path,greet,{type:'article'});
 if(/^\/gifts\/\d+$/.test(path)){
  const p=await getProduct(path.split('/')[2]);
  if(p&&p!=='error'){const img=productImage(p);return pageMetadata(path,productSeo(p),img?{image:{url:img,alt:cleanGiftTitle(p.title)}}:{})}
  return {title:'Hədiyyə - Wisher.az',robots:{index:false,follow:true}};
 }
 return {title:'Wisher.az',robots:{index:false,follow:false}};
}

export default async function Page({params}:Props){
 const path=await pathOf(params);
 const trail=crumbs[path]?<JsonLd data={breadcrumbLd([[crumbs[path],path]])}/>:null;
 if(path==='/')return <HomePage/>;
 if(path==='/gifts'){const first=await getCatalogPage();return <>{trail}<GiftsOpening initial={first?.data}/></>}
 if(/^\/gifts\/\d+$/.test(path)){
  const id=path.split('/')[2],p=await getProduct(id);
  if(p===null)notFound();
  if(p==='error')return <ProductDetail id={id}/>;
  return <><JsonLd data={breadcrumbLd([['Hədiyyələr','/gifts'],[cleanGiftTitle(p.title),path]])}/><JsonLd data={productLd(p)}/><ProductDetail id={id} initial={p}/></>;
 }
 if(path==='/tebrikler')return <GreetingsHub/>;
 if(path.startsWith('/tebrikler/')){const g=greetingBySlug(path.slice(11));if(!g)notFound();return <GreetingLanding page={g}/>}
 if(path==='/wishes')return <>{trail}<WishesStudio/></>;
 if(path==='/user/wishes')return <AccountGate><WishesStudio account/></AccountGate>;
 if(path==='/companies')return <>{trail}<CompaniesPage/></>;
 if(path==='/faq')return <>{trail}<JsonLd data={faqLd(faqPlain())}/><InfoPage page="faq"/></>;
 if(['/about','/privacy','/terms'].includes(path))return <>{trail}<InfoPage page={path.slice(1)}/></>;
 if(path==='/user/wishlist')return <AccountGate><Wishlist/></AccountGate>;
 if(path==='/user/company')return <AccountGate><CompanyWorkspace/></AccountGate>;
 if(path==='/user/reminders')return <AccountGate><Reminders/></AccountGate>;
 if(['/user','/user/wishes','/user/contacts','/user/occasions','/user/saved','/user/settings'].includes(path))return <Workspace path={path}/>;
 if(path==='/az/auth/kimlik/callback')return <KimlikCallback/>;
 notFound();
}
