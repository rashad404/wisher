import './fonts.css';
import './globals.css';
import './product.css';
import './lower-page.css';
import './brand.css';
import {Fraunces, Manrope} from 'next/font/google';
const display = Fraunces({subsets:['latin','latin-ext'],weight:['600','700'],variable:'--d-display'});
const text = Manrope({subsets:['latin','latin-ext'],weight:['400','500','600','700','800'],variable:'--d-text'});
import SiteShell from '@/components/SiteShell';
import type {Metadata,Viewport} from 'next';
import JsonLd from '@/components/JsonLd';
import {OG_IMAGE,organizationLd,websiteLd} from '@/lib/seo';
export const metadata:Metadata={title:'Wisher.az - Hədiyyə fikirləri, təbriklər və xatırlatmalar',description:'Yaxınlarınız üçün hədiyyə seçin, şəxsi təbriklər hazırlayın və özəl günləri planlaşdırın.',applicationName:'Wisher.az',metadataBase:new URL(process.env.SITE_URL||'https://wisher.az'),robots:{index:process.env.SITE_INDEXABLE==='true',follow:process.env.SITE_INDEXABLE==='true'},icons:{icon:[{url:'/icon.svg',type:'image/svg+xml'},{url:'/favicon.png',sizes:'32x32'}],apple:'/apple-touch-icon.png'},openGraph:{siteName:'Wisher.az',locale:'az_AZ',type:'website',images:[OG_IMAGE]},twitter:{card:'summary_large_image'},formatDetection:{telephone:false}};
export const viewport:Viewport={themeColor:'#a3122f'};
export default function Layout({children}:{children:React.ReactNode}) {return <html lang="az"><body className={`${display.variable} ${text.variable}`}><JsonLd data={[organizationLd,websiteLd]}/><SiteShell>{children}</SiteShell></body></html>}
