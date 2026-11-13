import HomePage from '@/components/HomePage';
import GiftsOpening from '@/components/GiftsOpening';
import Workspace from '@/components/Workspace';
import ProductCatalog,{ProductDetail} from '@/components/ProductCatalog';
import {CompaniesLanding,GreetingsLanding,InfoPage} from '@/components/InfoPages';
import AccountGate from '@/components/AccountGate';
import CompanyWorkspace from '@/components/CompanyWorkspace';
import Reminders from '@/components/Reminders';
import {notFound} from 'next/navigation';
export default async function Page({params}:{params:Promise<{slug?:string[]}>}){
 const path='/'+((await params).slug||[]).join('/');
 if(path==='/'||path==='/az')return <HomePage/>;
 if(path==='/gifts')return <GiftsOpening/>;
 if(/^\/gifts\/\d+$/.test(path))return <ProductDetail id={path.split('/')[2]}/>;
 if(path==='/wishes')return <GreetingsLanding/>;
 if(path==='/companies')return <CompaniesLanding/>;
 if(['/about','/faq','/privacy','/terms'].includes(path))return <InfoPage page={path.slice(1)}/>;
 if(path==='/user/wishlist')return <AccountGate><ProductCatalog wishlist/></AccountGate>;
 if(path==='/user/company')return <AccountGate><CompanyWorkspace/></AccountGate>;
 if(path==='/user/reminders')return <AccountGate><Reminders/></AccountGate>;
 if(['/user','/user/wishes','/user/contacts','/user/occasions','/user/saved','/user/settings','/az/auth/kimlik/callback'].includes(path))return <Workspace path={path}/>;
 notFound();
}
