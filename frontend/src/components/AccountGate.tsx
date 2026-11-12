'use client';
import {useEffect,useState} from 'react';
import {openKimlik} from '@/lib/kimlik';
import {usePathname} from 'next/navigation';
import {api,ApiError} from '@/lib/workspace';
export default function AccountGate({children}:{children:React.ReactNode}){const [state,setState]=useState('loading'),path=usePathname();const [error,setError]=useState('');useEffect(()=>{api('auth/me').then(()=>setState('ready')).catch(e=>setState(e instanceof ApiError&&e.status===401?'login':'error'))},[]);if(state==='ready')return <>{children}</>;return <main className="product-page"><div className="empty-state"><h1>{state==='loading'?'Yüklənir...':state==='login'?'Hesabınıza daxil olun.':'Məlumatlar yüklənmədi.'}</h1><p>{state==='login'?'Şəxsi məlumatlarınız yalnız hesabınızda görünür.':''}</p>{state==='login'?<button className="button" onClick={()=>{setError('');openKimlik(path+location.search).catch(e=>setError(e.message))}}>Kimlik ilə davam et</button>:state==='error'?<button className="button" onClick={()=>location.reload()}>Yenidən yoxla</button>:null}{error&&<p role="alert" className="error">{error}</p>}</div></main>}
