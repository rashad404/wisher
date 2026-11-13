'use client';
import {useEffect} from 'react';
import LostScene from '@/components/LostScene';
import s from '@/components/InfoPages.module.css';
export default function Error({error,reset}:{error:Error&{digest?:string};reset:()=>void}){
 useEffect(()=>{console.error(error)},[error]);
 return <LostScene code="Xəta baş verdi" title="Səhifə açılmadı." lead="Bizdə nəsə alınmadı, sizin günahınız deyil. Bir az sonra yenidən yoxlayın. Saxladığınız məlumatlar yerindədir." label="Bir anlıq fasilə" action={<button type="button" className={s.retry} onClick={reset}>Yenidən yoxla</button>}/>;
}
