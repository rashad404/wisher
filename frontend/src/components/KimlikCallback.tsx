'use client';
import {useEffect,useRef,useState} from 'react';
import {completeKimlik} from '@/lib/kimlik';
import home from './HomePage.module.css';
import s from './InfoPages.module.css';

/* Finishes the kimlik.az login. In the popup flow completeKimlik closes the window itself;
   otherwise it redirects to the return address. Only the error state needs actions. */
export default function KimlikCallback(){
 const started=useRef(false),[failed,setFailed]=useState(false);
 useEffect(()=>{if(started.current)return;started.current=true;completeKimlik().catch(()=>setFailed(true))},[]);
 return <main className={`${home.root} ${s.page} ${s.callback}`}>
  <div className={s.callbackCard} role={failed?'alert':'status'} aria-live="polite">
   {failed?<>
    <img className={s.errIcon} src="/concepts/occasions/balloon.png" alt="" width="72" height="72"/>
    <h1>Daxil olmaq alınmadı</h1>
    <p>Giriş vaxtı bitmiş və ya kimlik.az pəncərəsi bağlanmış ola bilər. Yenidən yoxlayın.</p>
    <div className={s.actions}><a href="/user" className={s.primary}>Yenidən daxil ol</a><a href="/" className={s.outlineInk}>Ana səhifə</a></div>
   </>:<>
    <div className={s.candle} aria-hidden="true"><svg viewBox="0 0 20 28"><path d="M10 1C10 1 3 10 3 17a7 7 0 0014 0C17 10 10 1 10 1z" fill="#ffb627"/><path d="M10 11s-3 4-3 7a3 3 0 006 0c0-3-3-7-3-7z" fill="#fff3c4"/></svg><i/></div>
    <h1>Hesabınız açılır</h1>
    <p>kimlik.az ilə girişi tamamlayırıq. Bu, bir neçə saniyə çəkəcək.</p>
    <div className={s.dots} aria-hidden="true"><span/><span/><span/></div>
    <p className={s.via}>Bu pəncərəni bağlamayın.</p>
   </>}
  </div>
 </main>;
}
