import LostScene from '@/components/LostScene';
export const metadata={title:'Səhifə tapılmadı - Wisher.az',robots:{index:false}};
export default function NotFound(){
 return <LostScene code="404" title="Bu səhifə tapılmadı." lead="Ünvan dəyişib və ya səhv yazılıb. Hədiyyə və ya təbrik axtarırdınızsa, buradan davam edin." label="Bu ünvan boşdur"/>;
}
