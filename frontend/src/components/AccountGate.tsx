'use client';
import {useEffect,useState} from 'react';
import {openKimlik} from '@/lib/kimlik';
import {usePathname} from 'next/navigation';
import {api,ApiError} from '@/lib/workspace';
import AccountShell from './account/AccountShell';
import s from './AccountGate.module.css';

const HEADLINES:Record<string,string>={
 '/user/wishlist':'Hədiyyə siyahınız hesabınızda saxlanır',
 '/user/reminders':'Xatırlatmalarınız hesabınızda',
 '/user/contacts':'Yaxınlarınız bir yerdə',
 '/user/occasions':'Özəl günləriniz bir təqvimdə',
 '/user/saved':'Təbrikləriniz hesabınızda qalır',
 '/user/company':'Şirkət sahəsi hesabınızda',
};

// Warm logged-out screen: log in with kimlik.az (and the local demo account when enabled).
export function LoginWelcome({path,busy=false,onLogin,demo,onDemo,notice,error}:{path:string;busy?:boolean;onLogin:()=>void;demo?:boolean;onDemo?:()=>void;notice?:string;error?:string}){
 return <main className={`account-gate ${s.gate}`}>
  <section className={s.band}>
   <div className={s.text}>
    <h1>{HEADLINES[path]||'Yaxınlarınızın özəl günləri bir yerdə'}</h1>
    <p className={s.lead}>Yaxınlarınızı, ad günlərini, saxladığınız hədiyyələri və təbrikləri bir hesabda saxlayın. Gün yaxınlaşanda Wisher xatırladır.</p>
    <div className={s.actions}>
     <button className={s.primary} onClick={onLogin} disabled={busy}>{busy?'Açılır...':'kimlik.az ilə daxil ol'}</button>
     {demo&&onDemo&&<button className={s.secondary} onClick={onDemo} disabled={busy}>Nümunə hesabı aç</button>}
    </div>
    <p className={s.small}>Pulsuzdur. Məlumatlarınızı yalnız siz görürsünüz.{demo?' Nümunə hesabdakı adlar və tarixlər uydurmadır.':''}</p>
    {notice&&<p className={s.notice}>{notice}</p>}
    {error&&<p role="alert" className={s.error}>{error}</p>}
   </div>
   <div className={s.notes} aria-label="Nümunə: hesabda görünən xatırlatmalar">
    <div className={s.note}><img src="/concepts/occasions/birthday_cake.png" alt="" width="44" height="44"/><span><b>Sabah Ayselin ad günüdür</b><small>Hədiyyə seçin, təbrik hazırlayın</small></span><em>sabah</em></div>
    <div className={s.note}><img src="/concepts/occasions/ring.png" alt="" width="44" height="44"/><span><b>Valideynlərin ildönümü</b><small>12 dekabr, hər il</small></span><em>4 gün</em></div>
    <div className={s.note}><img src="/concepts/occasions/wrapped_gift.png" alt="" width="44" height="44"/><span><b>Hədiyyə siyahım: 3 seçim</b><small>JBL dinamik, Instax fotoaparat</small></span><em>saxlanıb</em></div>
    <p className={s.sample}>Nümunə</p>
   </div>
  </section>
 </main>;
}

export function GateLoading(){return <main className={`account-gate ${s.loading}`} aria-busy="true"><span role="status">Yüklənir...</span><i/><i/><i/></main>}

export default function AccountGate({children}:{children:React.ReactNode}){
 const [state,setState]=useState('loading'),[user,setUser]=useState<{name:string;is_demo:boolean}|null>(null),[error,setError]=useState(''),[busy,setBusy]=useState(false),path=usePathname();
 useEffect(()=>{api('auth/me').then(d=>{setUser(d.user||null);setState('ready')}).catch(e=>setState(e instanceof ApiError&&e.status===401?'login':'error'))},[]);
 if(state==='ready')return <AccountShell name={user?.name} demo={user?.is_demo}>{children}</AccountShell>;
 if(state==='loading')return <GateLoading/>;
 if(state==='error')return <main className={`account-gate ${s.failed}`}><img src="/concepts/occasions/balloon.png" alt="" width="80" height="80"/><h1>Məlumatlar yüklənmədi</h1><p>İnternet bağlantısını yoxlayıb yenidən cəhd edin.</p><button className={s.primary} onClick={()=>location.reload()}>Yenidən yoxla</button></main>;
 return <LoginWelcome path={path} busy={busy} error={error} onLogin={()=>{setError('');setBusy(true);openKimlik(path+location.search).catch(e=>setError(e.message)).finally(()=>setBusy(false))}}/>;
}
