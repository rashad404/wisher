import type {Product} from './workspace';
// Curated short names and photos for the hand-picked catalog items.
export const giftTitles:Record<number,string>={1:'LEGO Botanicals: bambuk',2:'JBL Go 5 portativ dinamik, ağ',4:'Tognana qəhvə dəmləyən',5:'Fujifilm Instax Mini LiPlay+ fotoaparat',6:'Ttec 20000 mAh power bank'};
export const giftTitleFor=(p:Product)=>giftTitles[p.id]||p.title;
export const giftImageFor=(p:Product)=>[1,2,4,5,6].includes(p.id)?`/concepts/product-${p.id}.webp`:p.image_url;
export const allowedGift=(p:Product)=>p.id!==3&&!/flowers in watering can/i.test(p.title);
export const cleanGiftTitle=(t:string)=>t.replace(/\s*\([A-Z0-9][A-Z0-9 /-]{3,}\)\s*$/,'').replace(/\s+\d{8,14}\s*$/,'').trim();
