import './fonts.css';
import './globals.css';
import './product.css';
import './lower-page.css';
import SiteShell from '@/components/SiteShell';
import type {Metadata} from 'next';
export const metadata:Metadata={title:'Wisher.az - Hədiyyələr və şəxsi təbriklər',description:'Yaxınlarınız üçün hədiyyə seçin, şəxsi təbriklər hazırlayın və özəl günləri planlaşdırın.',robots:{index:false,follow:false}};
export default function Layout({children}:{children:React.ReactNode}) {return <html lang="az"><body><SiteShell>{children}</SiteShell></body></html>}
