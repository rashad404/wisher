'use client';
import {useState} from 'react';
import {track} from '@/lib/analytics';
export default function CopyGreeting({text,className,page}:{text:string;className?:string;page:string}){
 const [done,setDone]=useState(false);
 async function copy(){try{await navigator.clipboard.writeText(text);setDone(true);track('greeting_copied',{page});setTimeout(()=>setDone(false),2000)}catch{setDone(false)}}
 return <button type="button" className={className} onClick={copy} aria-live="polite">{done?'Köçürüldü':'Köçür'}</button>;
}
