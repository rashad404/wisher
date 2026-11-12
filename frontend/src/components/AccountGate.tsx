'use client';
import {useEffect,useState} from 'react';
import Link from 'next/link';
import {usePathname} from 'next/navigation';
import {api,ApiError} from '@/lib/workspace';
export default function AccountGate({children}:{children:React.ReactNode}){const [state,setState]=useState('loading'),path=usePathname();useEffect(()=>{api('auth/me').then(()=>setState('ready')).catch(e=>setState(e instanceof ApiError&&e.status===401?'login':'error'))},[]);if(state==='ready')return <>{children}</>;return <main className="product-page"><div className="empty-state"><h1>{state==='loading'?'Yüklənir...':state==='login'?'Hesabınıza daxil olun.':'Məlumatlar yüklənmədi.'}</h1><p>{state==='login'?'Şəxsi məlumatlarınız yalnız hesabınızda görünür.':''}</p>{state==='login'?<Link className="button" href={'/user?next='+encodeURIComponent(path)}>Kimlik ilə davam et</Link>:state==='error'?<button className="button" onClick={()=>location.reload()}>Yenidən yoxla</button>:null}</div></main>}
