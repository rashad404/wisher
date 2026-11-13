'use client';
import {FormEvent,useEffect,useState} from 'react';
import {api,ApiError,Product} from '@/lib/workspace';
import {openKimlik} from '@/lib/kimlik';
import {track} from '@/lib/analytics';
import s from './HomePage.module.css';

const titles:Record<number,string>={1:'LEGO Botanicals: bambuk',2:'JBL Go 5 portativ dinamik, ağ',4:'Tognana qəhvə dəmləyən',5:'Fujifilm Instax Mini LiPlay+ fotoaparat',6:'Ttec 20000 mAh power bank'};
const tags:Record<number,string>={1:'Dosta',2:'Yeniyetməyə',4:'Valideynə',5:'Gəncə',6:'Həmkara'};
const titleFor=(p:Product)=>titles[p.id]||p.title;
const priceFor=(p:Product)=>p.price_minor===null?'Qiymət mağazada':(p.price_minor/100).toFixed(2).replace('.',',')+' '+p.currency;
export const allowedGift=(p:Product)=>p.id!==3&&!/flowers in watering can/i.test(p.title);
const imageFor=(p:Product)=>[1,2,4,5,6].includes(p.id)?`/concepts/product-${p.id}.webp`:p.image_url;
export function GiftPhoto({product:p}:{product:Product}){const [failed,setFailed]=useState(false);return imageFor(p)&&!failed?<img src={imageFor(p)!} alt={p.title} width="320" height="320" loading="lazy" onError={()=>setFailed(true)}/>:<span>Şəkil mövcud deyil</span>}
export function GiftCard({product:p}:{product:Product}){
 const [saved,setSaved]=useState(false),[busy,setBusy]=useState(false),[error,setError]=useState('');
 async function save(){setBusy(true);setError('');try{await api('wishlist/'+p.id,'PUT',{});setSaved(true);track('gift_saved')}catch(e){if(e instanceof ApiError&&e.status===401){try{await openKimlik('/gifts/'+p.id)}catch(e){setError((e as Error).message)}}else setError((e as Error).message)}finally{setBusy(false)}}
 return <article className={s.gift}><a href={'/gifts/'+p.id} className={s.giftPhoto}><GiftPhoto product={p}/>{tags[p.id]&&<span className={s.giftFor}>{tags[p.id]}</span>}</a><button type="button" className={s.save} aria-label={saved?'Siyahıya əlavə edildi':p.title+' - siyahıya əlavə et'} aria-pressed={saved} disabled={busy||saved} onClick={save}><svg viewBox="0 0 24 24" aria-hidden="true" style={saved?{fill:'#a3122f'}:{}}><path d="M12 21s-7.5-4.6-9.5-9.3C1 8 3.4 4.5 7 4.5c2 0 3.6 1.1 5 3 1.4-1.9 3-3 5-3 3.6 0 6 3.5 4.5 7.2C19.5 16.4 12 21 12 21z"/></svg></button><a href={'/gifts/'+p.id} className={s.giftInfo}><strong>{priceFor(p)}</strong><span>{titleFor(p)}</span><small>{p.store}</small></a>{p.availability==='out_of_stock'&&<small>Hazırda mövcud deyil</small>}{p.stale&&<small>Qiyməti mağazada yoxlayın</small>}{error&&<p role="alert">{error}</p>}</article>
}
const recipientOptions=[['','Hamısı'],['family','Anaya'],['family','Ataya'],['family','Həyat yoldaşına'],['friend','Dosta'],['child','Uşağa'],['colleague','Müəllimə'],['colleague','Həmkara']];
export function FeaturedGifts(){
 const [products,setProducts]=useState<Product[]|null>(null),[error,setError]=useState(''),[retry,setRetry]=useState(0);
 useEffect(()=>{let alive=true;api('catalog').then(d=>{if(alive)setProducts(d.data.filter(allowedGift).sort((a:Product,b:Product)=>[5,2,4,1,6].indexOf(a.id)-[5,2,4,1,6].indexOf(b.id)).slice(0,5))}).catch(e=>{if(alive)setError(e.message)});return()=>{alive=false}},[retry]);
 return <><div className={s.chips} aria-label="Kimə">{recipientOptions.map(([value,label],i)=><a key={label} href={'/gifts'+(value?'?recipient='+value:'')} className={i===0?s.chipOn:s.chip}>{label}</a>)}</div><div className={s.chips} aria-label="Büdcə">{[['max=50','50 AZN-ə qədər'],['min=50&max=150','50-150 AZN'],['min=150','150 AZN-dən çox']].map(([q,l])=><a key={q} href={'/gifts?'+q} className={s.chipSoft}>{l}</a>)}</div>{error?<p role="alert">{error} <button onClick={()=>{setError('');setRetry(retry+1)}}>Yenidən yoxla</button></p>:products?<div className={s.giftGrid}>{products.length?products.map(p=><GiftCard key={p.id} product={p}/>):<p>Hələ hədiyyə yoxdur.</p>}</div>:<p role="status">Hədiyyələr yüklənir...</p>}</>;
}
export function HeroGift(){const [p,setP]=useState<Product|null>(null);useEffect(()=>{api('catalog/1').then(setP).catch(()=>{})},[]);return p&&allowedGift(p)?<a href={'/gifts/'+p.id} className={s.giftTag}><GiftPhoto product={p}/><span><small>{p.store}</small><b>{titleFor(p)}</b><em>{priceFor(p)}</em></span></a>:null}
const months=['Yanvar','Fevral','Mart','Aprel','May','İyun','İyul','Avqust','Sentyabr','Oktyabr','Noyabr','Dekabr'];
export function ReminderForm(){
 const [error,setError]=useState(''),[busy,setBusy]=useState(false);
 async function submit(e:FormEvent<HTMLFormElement>){e.preventDefault();const data=new FormData(e.currentTarget);const name=String(data.get('name')).trim(),day=Number(data.get('day')),month=Number(data.get('month'));if(!name){setError('Adı yazın.');return}let year=new Date().getFullYear();if(month===2&&day===29){while(new Date(year,1,29).getMonth()!==1)year++}const date=new Date(year,month-1,day);if(date.getMonth()!==month-1){setError('Bu ay üçün düzgün gün seçin.');return}const target='/user/occasions?'+new URLSearchParams({recipient:name,date:`${year}-${String(month).padStart(2,'0')}-${String(day).padStart(2,'0')}`});setBusy(true);setError('');track('reminder_start');try{await api('auth/me');location.assign(target)}catch(e){if(e instanceof ApiError&&e.status===401){try{await openKimlik(target)}catch(e){setError((e as Error).message)}}else setError((e as Error).message)}finally{setBusy(false)}}
 return <><form className={s.remind} onSubmit={submit}><label><span>Kimin?</span><input name="name" placeholder="Məsələn, Aysel" autoComplete="off" required maxLength={100}/></label><div className={s.dateGroup}><label><span>Gün</span><select name="day" defaultValue="15">{Array.from({length:31},(_,i)=><option key={i} value={i+1}>{i+1}</option>)}</select></label><label><span>Ay</span><select name="month" defaultValue="11">{months.map((m,i)=><option key={m} value={i+1}>{m}</option>)}</select></label></div><button disabled={busy} type="submit">{busy?'Açılır...':'Yadda saxla'}</button></form>{error&&<p role="alert">{error}</p>}</>;
}
