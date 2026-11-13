import HomePage from '@/components/HomePage';
import GiftsOpening from '@/components/GiftsOpening';
import Workspace from '@/components/Workspace';
import ProductCatalog from '@/components/ProductCatalog';
import {InfoPage} from '@/components/InfoPages';
import AccountGate from '@/components/AccountGate';
import CompanyWorkspace from '@/components/CompanyWorkspace';
import Reminders from '@/components/Reminders';
import Wishlist from '@/components/account/Wishlist';
import KimlikCallback from '@/components/KimlikCallback';
import WishesStudio from '@/components/WishesStudio';
import CompaniesPage from '@/components/CompaniesLanding';
import ProductDetail from '@/components/ProductDetail';
import {notFound} from 'next/navigation';
export async function generateMetadata({params}:{params:Promise<{slug?:string[]}>}) {
 const path='/'+((await params).slug||[]).join('/');
 const titles:Record<string,string>={'/':'Wisher.az - Hədiyyələr və şəxsi təbriklər','/az':'Wisher.az - Hədiyyələr və şəxsi təbriklər','/gifts':'Hədiyyələr - Wisher.az','/wishes':'Şəxsi təbriklər - Wisher.az','/companies':'Şirkətlər üçün - Wisher.az','/about':'Haqqımızda - Wisher.az','/faq':'Tez-tez verilən suallar - Wisher.az','/privacy':'Məxfilik - Wisher.az','/terms':'İstifadə şərtləri - Wisher.az'};
 const publicPage=Boolean(titles[path])||/^\/gifts\/\d+$/.test(path);
 return {title:titles[path]||'Wisher.az',robots:{index:publicPage&&process.env.SITE_INDEXABLE==='true',follow:publicPage&&process.env.SITE_INDEXABLE==='true'},alternates:publicPage?{canonical:path==='/az'?'/':path}:undefined};
}
export default async function Page({params}:{params:Promise<{slug?:string[]}>}){
 const path='/'+((await params).slug||[]).join('/');
 if(path==='/'||path==='/az')return <HomePage/>;
 if(path==='/gifts')return <GiftsOpening/>;
 if(/^\/gifts\/\d+$/.test(path))return <ProductDetail id={path.split('/')[2]}/>;
 if(path==='/wishes')return <WishesStudio/>;
 if(path==='/user/wishes')return <AccountGate><WishesStudio account/></AccountGate>;
 if(path==='/companies')return <CompaniesPage/>;
 if(['/about','/faq','/privacy','/terms'].includes(path))return <InfoPage page={path.slice(1)}/>;
 if(path==='/user/wishlist')return <AccountGate><Wishlist/></AccountGate>;
 if(path==='/user/company')return <AccountGate><CompanyWorkspace/></AccountGate>;
 if(path==='/user/reminders')return <AccountGate><Reminders/></AccountGate>;
 if(['/user','/user/wishes','/user/contacts','/user/occasions','/user/saved','/user/settings'].includes(path))return <Workspace path={path}/>;
 if(path==='/az/auth/kimlik/callback')return <KimlikCallback/>;
 notFound();
}
