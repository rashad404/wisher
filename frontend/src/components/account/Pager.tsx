'use client';
import {AIcon} from './AccountShell';
import s from './AccountShell.module.css';
export default function Pager({page,last,onPage}:{page:number;last:number;onPage:(n:number)=>void}){
 if(last<=1)return null;
 return <nav className={s.pager} aria-label="Səhifələr"><button className={s.outline} disabled={page<=1} onClick={()=>onPage(page-1)}><AIcon name="left" size={18}/>Əvvəlki</button><span>{page} / {last}</span><button className={s.outline} disabled={page>=last} onClick={()=>onPage(page+1)}>Növbəti<AIcon name="right" size={18}/></button></nav>;
}
