import './fonts.css';
import './globals.css';
import './product.css';
import './lower-page.css';
import './brand.css';
import {Fraunces, Manrope} from 'next/font/google';
const display = Fraunces({subsets:['latin','latin-ext'],weight:['600','700'],variable:'--d-display'});
const text = Manrope({subsets:['latin','latin-ext','cyrillic'],weight:['400','500','600','700','800'],variable:'--d-text'});
import SiteShell from '@/components/SiteShell';
import type {Metadata} from 'next';
export const metadata:Metadata={title:'Wisher.az - Hədiyyələr və şəxsi təbriklər',description:'Yaxınlarınız üçün hədiyyə seçin, şəxsi təbriklər hazırlayın və özəl günləri planlaşdırın.',metadataBase:new URL(process.env.SITE_URL||'https://wisher.az'),robots:{index:process.env.SITE_INDEXABLE==='true',follow:process.env.SITE_INDEXABLE==='true'},icons:{icon:[{url:'/icon.svg',type:'image/svg+xml'},{url:'/favicon.png',sizes:'32x32'}],apple:'/apple-touch-icon.png'}};
export default function Layout({children}:{children:React.ReactNode}) {return <html lang="az"><body className={`${display.variable} ${text.variable}`}><SiteShell>{children}</SiteShell></body></html>}
