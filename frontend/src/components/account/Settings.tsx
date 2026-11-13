'use client';
import {FormEvent,useState} from 'react';
import {api} from '@/lib/workspace';
import {AIcon,Alert,PageHead,Toast,ui} from './AccountShell';
import s from './Settings.module.css';

export type User={id:number;name:string;timezone:string;language:string;is_demo:boolean};
const ZONES:[string,string][]=[['Asia/Baku','Bakı (GMT+4)'],['Europe/Istanbul','İstanbul (GMT+3)'],['Europe/London','London'],['Europe/Berlin','Berlin'],['America/New_York','Nyu-York'],['America/Chicago','Çikaqo'],['UTC','UTC']];
const LANGS:[string,string][]=[['az','Azərbaycanca'],['ru','Rusca'],['en','İngiliscə']];

export default function Settings({user,onUpdate}:{user:User;onUpdate:(u:User)=>void}){
 const [form,setForm]=useState({name:user.name,timezone:user.timezone,language:user.language}),[busy,setBusy]=useState(false),[error,setError]=useState(''),[notice,setNotice]=useState('');
 async function save(e:FormEvent){e.preventDefault();setBusy(true);setError('');setNotice('');try{const d=await api('settings','PUT',form);onUpdate(d.user);setNotice('Dəyişikliklər yadda saxlanıldı.')}catch{setError('Yadda saxlanmadı. Yenidən yoxlayın.')}finally{setBusy(false)}}
 async function logout(){try{await api('auth/logout','POST',{});location.assign('/')}catch{setError('Çıxış alınmadı. Yenidən yoxlayın.')}}
 const zones=ZONES.some(z=>z[0]===form.timezone)?ZONES:[...ZONES,[form.timezone,form.timezone] as [string,string]];
 return <>
  <PageHead title="Tənzimləmələr" lead="Adınız, saat qurşağınız və təbriklərin dili. Xatırlatmalar sizin saatınızla hesablanır."/>
  {notice&&<Toast>{notice}</Toast>}
  {error&&<Alert>{error}</Alert>}
  <form className={s.card} onSubmit={save}>
   <div className={s.row}><label htmlFor="set-name">Adınız</label><input id="set-name" required maxLength={100} value={form.name} onChange={e=>setForm({...form,name:e.target.value})}/></div>
   <div className={s.row}><label htmlFor="set-tz">Saat qurşağı</label><select id="set-tz" value={form.timezone} onChange={e=>setForm({...form,timezone:e.target.value})}>{zones.map(([v,l])=><option key={v} value={v}>{l}</option>)}</select></div>
   <div className={s.row}><span id="set-lang">Təbriklərin dili</span><div className={ui.chips} role="radiogroup" aria-labelledby="set-lang">{LANGS.map(([v,l])=><button type="button" role="radio" aria-checked={form.language===v} key={v} className={form.language===v?ui.chipOn:ui.chip} onClick={()=>setForm({...form,language:v})}>{l}</button>)}</div></div>
   <button type="submit" className={`${ui.primary} ${s.save}`} disabled={busy}>{busy?'Saxlanılır...':'Yadda saxla'}</button>
  </form>
  <section className={s.account} aria-labelledby="acc">
   <div><h2 id="acc">Hesab</h2><p>{user.is_demo?'Bu nümunə hesabdır. Adlar və tarixlər uydurmadır.':'Hesabınıza kimlik.az ilə daxil olmusunuz. Məlumatlarınızı yalnız siz görürsünüz.'}</p></div>
   <button type="button" className={s.logout} onClick={logout}><AIcon name="logout" size={18}/>Hesabdan çıx</button>
  </section>
 </>;
}
