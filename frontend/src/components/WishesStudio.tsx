'use client';
import {FormEvent,useEffect,useRef,useState} from 'react';
import {api,ApiError,Product} from '@/lib/workspace';
import {openKimlik} from '@/lib/kimlik';
import {track} from '@/lib/analytics';
import {GiftCard,allowedGift} from './HomeInteractions';
import home from './HomePage.module.css';
import s from './WishesStudio.module.css';
import {downloadPng,splitGreeting as split} from './greetingCard';

type Wish={id:number;brief:Record<string,string>;variants:string[];selected_text?:string;provider:string;status:string};
type User={name:string;language:string;is_demo:boolean};
type Brief={recipient:string;relationship:string;occasion:string;tone:string;language:string;format:string;details:string};

const occasions:Record<string,[string,string]>={birthday:['Ad günü','birthday_cake'],anniversary:['İldönümü','wrapped_gift'],wedding:['Toy','ring'],novruz:['Novruz','seedling'],newyear:['Yeni il','christmas_tree'],graduation:['Məzuniyyət','graduation_cap'],thanks:['Təşəkkür','bouquet'],support:['Dəstək','heart']};
const tones:Record<string,string>={warm:'Səmimi',funny:'Zarafatcıl',formal:'Rəsmi',heartfelt:'Duyğulu'};
const languages:Record<string,string>={az:'Azərbaycanca',en:'İngiliscə',ru:'Rusca'};
const formats:Record<string,string>={message:'Mesaj',sms:'Qısa SMS',speech:'Nitq'};
const styles:Record<string,string>={red:'Qırmızı',white:'Ağ',green:'Yaşıl'};
const styleOrder=['red','white','green'];
const blank:Brief={recipient:'',relationship:'Dostum',occasion:'birthday',tone:'warm',language:'az',format:'message',details:''};
const sampleBodies:Record<string,[string,string,string]>={
 birthday:['ad günün mübarək! Hər görüşümüzdə məni güldürən sənsən. Yeni yaşında sənə cansağlığı və bol sevinc arzulayıram.','yaşın mübarək! Tortdakı şamların sayı artır, amma sən hələ də ən gənc ruhlu dostumsan.','ad gününüz münasibətilə sizi ürəkdən təbrik edirəm. Uğurlar, cansağlığı və xoş günlər arzulayıram.'],
 anniversary:['ildönümünüz mübarək! Birlikdə keçən hər il sizi bir az da yaxınlaşdırıb. Qoy sevginiz həmişə belə isti qalsın.','daha bir il bir-birinizə dözdünüz, bu artıq medala layiqdir! İldönümünüz mübarək.','ildönümünüz münasibətilə sizi təbrik edirəm. Ailənizə xoşbəxtlik və uzun illər arzulayıram.'],
 wedding:['toyunuz mübarək! Bu gün başlayan yolunuz sevgi, anlaşma və bol gülüşlə dolu olsun.','toyunuz mübarək! Artıq pultu kimin saxlayacağını da birlikdə həll edəcəksiniz.','izdivacınız münasibətilə sizi səmimi qəlbdən təbrik edirəm. Bir yastıqda qocalasınız.'],
 novruz:['Novruz bayramın mübarək! Süfrən bol, evin işıqlı, ürəyin həmişə bahar kimi təzə olsun.','bayramın mübarək! Bu il şəkərbura mənə də çatsın, yoxsa küsəcəyəm.','Novruz bayramı münasibətilə sizi və ailənizi təbrik edirəm. Bahar evinizə bərəkət gətirsin.'],
 newyear:['Yeni ilin mübarək! Qarşıdakı il sənə arzuladığın hər şeyi, bir az da artığını gətirsin.','Yeni ilin mübarək! Bu il verdiyin vədlərin heç olmasa yarısını tutmağı arzulayıram.','Yeni il münasibətilə sizi təbrik edirəm. Uğurlu, sağlam və sakit bir il arzulayıram.'],
 graduation:['məzuniyyətin mübarək! Bu illərin zəhmətini gördüm, qarşıdakı yol da elə sənin kimi parlaq olsun.','məzuniyyətin mübarək! Nəhayət, gecə yarısı imtahan oxumağa əlvida.','məzuniyyətiniz münasibətilə sizi təbrik edirəm. Peşə həyatınızda uğurlar arzulayıram.'],
 thanks:['hər şey üçün sağ ol. Ən lazım olan anda yanımda olduğunu heç vaxt unutmayacağam.','sağ ol! Sənə bir çay borcum var, bəlkə də iki.','göstərdiyiniz dəstəyə görə ürəkdən təşəkkür edirəm. Köməyiniz mənim üçün çox dəyərli oldu.'],
 support:['yanındayam. Nə lazım olsa, bir zəng uzağındayam. Bu günlər də keçəcək.','bilirəm, çətindir. Amma sən mənim tanıdığım ən güclü insansan, bunu da aşacaqsan.','çətin gününüzdə sizinlə olduğumu bildirmək istəyirəm. Səbir və güc arzulayıram.'],
};
const sampleText=(name:string,occasion:string)=>{const b=sampleBodies[occasion]||sampleBodies.birthday;return [{to:'Əziz '+name+',',body:b[0],tone:'Səmimi'},{to:name+',',body:b[1],tone:'Zarafatcıl'},{to:'Hörmətli '+name+',',body:b[2],tone:'Rəsmi'}]};
function uuid(){const b=crypto.getRandomValues(new Uint8Array(16));b[6]=(b[6]&15)|64;b[8]=(b[8]&63)|128;const h=Array.from(b,x=>x.toString(16).padStart(2,'0')).join('');return `${h.slice(0,8)}-${h.slice(8,12)}-${h.slice(12,16)}-${h.slice(16,20)}-${h.slice(20)}`}
function fromQuery():Partial<Brief>{if(typeof location==='undefined')return {};const q=new URLSearchParams(location.search),out:Partial<Brief>={};const pick=(k:keyof Brief,allowed?:Record<string,unknown>,max=100)=>{const v=q.get(k);if(v&&(!allowed||v in allowed))out[k]=v.slice(0,max)};pick('recipient');pick('relationship',undefined,60);pick('occasion',occasions);pick('tone',tones);pick('language',languages);pick('format',formats);pick('details',undefined,500);return out}

function Ico({d}:{d:string}){return <svg viewBox="0 0 24 24" aria-hidden="true" className={s.ico}><path d={d}/></svg>}

export default function WishesStudio({account=false}:{account?:boolean}){
 const [brief,setBrief]=useState<Brief>(blank),[user,setUser]=useState<User|null>(null),[authKnown,setAuthKnown]=useState(false);
 const [result,setResult]=useState<Wish|null>(null),[busy,setBusy]=useState(false),[error,setError]=useState(''),[chosen,setChosen]=useState(0),[parts,setParts]=useState<{to:string;body:string}[]>([]),[style,setStyle]=useState('white'),[signature,setSignature]=useState(''),[notice,setNotice]=useState(''),[saving,setSaving]=useState(false),[savedId,setSavedId]=useState<string>('');
 const auto=useRef(false),resultRef=useRef<HTMLDivElement>(null);
 const set=(k:keyof Brief,v:string)=>setBrief(b=>({...b,[k]:v}));
 useEffect(()=>{const q=fromQuery();setBrief(b=>({...b,...q}));api('auth/me').then(d=>{setUser(d.user);setSignature(d.user.is_demo?'':(d.user.name||'').split(' ')[0]);if(!q.language&&d.user.language in languages)setBrief(b=>({...b,language:d.user.language}))}).catch(()=>{}).finally(()=>setAuthKnown(true))},[]);
 useEffect(()=>{if(!authKnown||auto.current)return;auto.current=true;if(user&&new URLSearchParams(location.search).get('auto')==='1'&&brief.recipient.trim()){history.replaceState(null,'',location.pathname);generate()}},[authKnown]);// eslint-disable-line react-hooks/exhaustive-deps

 async function generate(e?:FormEvent,sample=false){
  e?.preventDefault();setError('');setNotice('');
  if(!brief.recipient.trim()){setError('Kimə yazdığınızı qeyd edin.');return}
  if(!brief.relationship.trim()){setError('Sizə kim olduğunu yazın.');return}
  if(!user){const q=new URLSearchParams(Object.entries({...brief,auto:'1'}).filter(([,v])=>v));track('wish_login_start');try{await openKimlik('/user/wishes?'+q.toString())}catch(err){setError((err as Error).message)}return}
  setBusy(true);setResult(null);track('wish_generate',{occasion:brief.occasion,tone:brief.tone});
  if(window.innerWidth<900)setTimeout(()=>resultRef.current?.scrollIntoView({behavior:'smooth',block:'start'}),50);
  try{const d=await api('wishes/generate','POST',{...brief,recipient:brief.recipient.trim(),relationship:brief.relationship.trim(),request_key:uuid(),...(sample?{sample:true}:{})});if(d.status!=='ready')throw Error();setResult(d);setParts(d.variants.map((v:string)=>split(v)));setChosen(0);setSavedId('')}
  catch(err){setError(err instanceof ApiError&&err.status===429?'Bu gün üçün hazırlama limitinə çatdınız. Sabah yenidən yoxlayın.':err instanceof ApiError&&err.status===401?'Hesabdan çıxmısınız. Yenidən daxil olun.':'Təbrik hazırlanmadı. Bir az sonra yenidən yoxlayın.')}
  finally{setBusy(false)}
 }
 const join=(p?:{to:string;body:string})=>p?(p.to.trim()?p.to.trim()+(p.body.trim()?' '+p.body.trim():''):p.body.trim()):'';
 const texts=parts.map(join),text=texts[chosen]||'',part=parts[chosen]||{to:'',body:''};
 const edit=(k:'to'|'body',v:string)=>{setParts(ps=>ps.map((x,i)=>i===chosen?{...x,[k]:v}:x));setNotice('')};
 async function save(){if(!result)return;setSaving(true);setError('');try{await api('wishes/'+result.id,'PUT',{text});setSavedId(result.id+':'+chosen+':'+text);setNotice('saved');track('wish_saved')}catch{setError('Saxlamaq alınmadı. Yenidən yoxlayın.')}finally{setSaving(false)}}
 async function copy(){try{await navigator.clipboard.writeText(text);setNotice('Mətn köçürüldü. İndi WhatsApp-a yapışdıra bilərsiniz.')}catch{setNotice('Mətni seçib köçürə bilərsiniz.')}track('wish_copied')}
 const isSaved=result&&savedId===result.id+':'+chosen+':'+text;
 const name=brief.recipient.trim()||'Aysel';
 const occ=occasions[brief.occasion];

 const form=<form className={s.form} onSubmit={generate} noValidate>
  <div className={s.row}><label htmlFor="w-recipient">Kimə</label><input id="w-recipient" value={brief.recipient} maxLength={100} placeholder="Məsələn, Aysel" autoComplete="off" onChange={e=>set('recipient',e.target.value)}/></div>
  <div className={s.row}><label htmlFor="w-rel">Sizə kimdir</label><input id="w-rel" value={brief.relationship} maxLength={60} placeholder="Dostum, anam, həmkarım" autoComplete="off" onChange={e=>set('relationship',e.target.value)}/></div>
  <div className={s.row}><label htmlFor="w-occ">Münasibət</label><span className={s.occSelect}><img src={`/concepts/occasions/${occ[1]}.png`} alt="" width="28" height="28"/><select id="w-occ" value={brief.occasion} onChange={e=>set('occasion',e.target.value)}>{Object.entries(occasions).map(([k,[l]])=><option key={k} value={k}>{l}</option>)}</select></span></div>
  <div className={s.row}><span className={s.label} id="w-tone">Ton</span><div className={s.chips} role="group" aria-labelledby="w-tone">{Object.entries(tones).map(([k,l])=><button key={k} type="button" aria-pressed={brief.tone===k} className={brief.tone===k?s.chipOn:s.chip} onClick={()=>set('tone',k)}>{l}</button>)}</div></div>
  <div className={s.row}><span className={s.label} id="w-lang">Dil</span><div className={s.chips} role="group" aria-labelledby="w-lang">{Object.entries(languages).map(([k,l])=><button key={k} type="button" aria-pressed={brief.language===k} className={brief.language===k?s.chipOn:s.chip} onClick={()=>set('language',k)}>{l}</button>)}</div></div>
  <div className={s.row}><span className={s.label} id="w-format">Format</span><div className={s.chips} role="group" aria-labelledby="w-format">{Object.entries(formats).map(([k,l])=><button key={k} type="button" aria-pressed={brief.format===k} className={brief.format===k?s.chipOn:s.chip} onClick={()=>set('format',k)}>{l}</button>)}</div></div>
  <div className={`${s.row} ${s.rowTop}`}><label htmlFor="w-details">Xatirə</label><textarea id="w-details" rows={2} value={brief.details} maxLength={500} placeholder="Məsələn, hər səhər çay hazırlayır, səyahəti sevir" onChange={e=>set('details',e.target.value)}/></div>
  <button type="submit" className={s.go} disabled={busy}>{busy?'Hazırlanır...':result?'Yenidən 3 variant hazırla':'3 variant hazırla'}</button>
  {user?.is_demo&&<button type="button" className={s.sampleGo} disabled={busy} onClick={()=>generate(undefined,true)}>Nümunə mətnlə yoxla</button>}
  {error&&<p role="alert" className={s.error}>{error}</p>}
  <p className={s.fine}>{authKnown&&!user?'Pulsuzdur. Hazırlamaq üçün kimlik.az ilə bir dəfə daxil olursunuz. ':''}Formadakı məlumat yalnız mətn hazırlamaq üçün göndərilir; həssas məlumat yazmayın.</p>
 </form>;

 const samples=<div className={s.samples} aria-label="Nümunə təbrik kartları">
  {sampleText(name,brief.occasion).map((c,i)=><figure key={i} className={`${s.mini} ${s['mini_'+styleOrder[i]]}`}><span className={s.miniTone}>{c.tone}</span><p className={s.miniTo}>{c.to}</p><p>{c.body}</p><figcaption>Leyla</figcaption></figure>)}
  <p className={s.samplesNote}>Nümunə. Adı yazdıqca kartlar dəyişir, əsl variantlar sizin detallarınızla hazırlanır.</p>
 </div>;

 const loading=<div className={s.loading} role="status"><p className={s.resultHead}><b>{name} üçün yazırıq...</b><span>Adətən 10-20 saniyə çəkir</span></p><div className={s.skeletons}>{styleOrder.map(k=><div key={k} className={`${s.mini} ${s.skeleton}`}><i/><i/><i/><i/></div>)}</div></div>;

 const editor=result&&<div className={s.result}>
  <div className={s.resultHead}><b>{result.brief.recipient} üçün 3 variant hazırdır</b><span>Birini seçin, kartın üstündə düzəldin.</span></div>
  {result.provider==='fake'&&<p className={s.fakeNote}>Nümunə rejimi: bu mətnlər süni intellektlə yaradılmayıb.</p>}
  <div className={s.variants} role="radiogroup" aria-label="Variantlar">{texts.map((v,i)=><button key={i} type="button" role="radio" aria-checked={chosen===i} className={chosen===i?s.variantOn:s.variant} onClick={()=>{setChosen(i);setNotice('')}}><span>Variant {i+1}</span><p>{v}</p></button>)}</div>
  <div className={`${s.bigCard} ${s['big_'+style]}`}>
   <div className={s.bigInner}>
    <span className={s.bigOcc}><img src={`/concepts/occasions/${(occasions[result.brief.occasion]||occ)[1]}.png`} alt="" width="26" height="26"/>{(occasions[result.brief.occasion]||occ)[0]}</span>
    <label className={s.srOnly} htmlFor="w-to">Müraciət</label>
    <input id="w-to" className={s.bigTo} value={part.to} maxLength={60} placeholder="Əziz Aysel," onChange={e=>edit('to',e.target.value)}/>
    <label className={s.srOnly} htmlFor="w-text">Təbrik mətni</label>
    <textarea id="w-text" className={s.bigText} value={part.body} maxLength={1900} rows={Math.min(12,Math.max(4,Math.ceil(part.body.length/56)+1))} onChange={e=>edit('body',e.target.value)}/>
    <label className={s.srOnly} htmlFor="w-sign">İmza</label>
    <input id="w-sign" className={s.bigSign} value={signature} maxLength={60} placeholder="İmzanız" onChange={e=>setSignature(e.target.value)}/>
   </div>
  </div>
  <div className={s.styleRow}><span id="w-style">Kartın rəngi</span><div className={s.swatches} role="radiogroup" aria-labelledby="w-style">{Object.entries(styles).map(([k,l])=><button key={k} type="button" role="radio" aria-checked={style===k} className={style===k?s.swatchOn:s.swatch} onClick={()=>setStyle(k)}><i className={s['sw_'+k]}/>{l}</button>)}</div></div>
  <div className={s.actions}>
   <button type="button" className={s.primary} onClick={save} disabled={saving||!text.trim()||!!isSaved}>{isSaved?<><Ico d="M4 12l5 5L20 6"/>Saxlanıldı</>:saving?'Saxlanılır...':'Təbriki saxla'}</button>
   <button type="button" className={s.outline} onClick={copy} disabled={!text.trim()}><Ico d="M9 9h11v11H9zM5 15H4V4h11v1"/>Mətni köçür</button>
   <button type="button" className={s.outline} onClick={()=>{downloadPng(text,signature,style);track('wish_card_download',{style})}} disabled={!text.trim()}><Ico d="M12 4v11M7 10l5 5 5-5M5 20h14"/>PNG kart endir</button>
  </div>
  {notice&&<p role="status" className={s.notice}>{notice==='saved'?<>Saxlanıldı. <a href="/user/saved">Təbriklərim</a> bölməsində tapa bilərsiniz.</>:notice}</p>}
 </div>;

 return <main className={`${home.root} ${s.page} ${account?s.inAccount:''}`}>
  <section className={s.studio}>
   <div className={s.left}>
    <h1>Təbriki də siz yazmış kimi olsun.</h1>
    <p className={s.lead}>Kimə yazdığınızı və bir xatirəni deyin. Wisher üç variant hazırlayır, bəyəndiyinizi düzəldib kart kimi göndərirsiniz.</p>
    {form}
   </div>
   <div className={s.right} ref={resultRef} aria-live="polite">{busy?loading:result?editor:samples}</div>
  </section>
  <GiftStrip occasion={result?.brief.occasion||brief.occasion}/>
  {!account&&<section className={s.faq} aria-labelledby="w-faq">
   <h2 id="w-faq">Təbrik haqqında suallar</h2>
   <div>
    <details><summary>Təbrik özü göndərilir?</summary><p>Xeyr. Mətni köçürüb WhatsApp, SMS və ya istədiyiniz yerdə özünüz göndərirsiniz, ya da PNG kart kimi endirirsiniz.</p></details>
    <details><summary>Hansı dillərdə yaza bilərəm?</summary><p>Azərbaycan, rus və ingilis dillərində. Ton və formatı da siz seçirsiniz: qısa SMS, mesaj və ya masa arxasında deyiləcək nitq.</p></details>
    <details><summary>Saxladığım təbriklər harada qalır?</summary><p>Hesabınızda, Təbriklərim bölməsində. Onları sonra yenidən açıb dəyişə və köçürə bilərsiniz.</p></details>
    <details><summary>Məlumatlarım kimə görünür?</summary><p>Formaya yazdıqlarınız yalnız mətn hazırlamaq üçün göndərilir və başqa istifadəçilərə görünmür. Həssas şəxsi məlumat yazmayın.</p></details>
   </div>
  </section>}
 </main>;
}

function GiftStrip({occasion}:{occasion:string}){
 const [items,setItems]=useState<Product[]|null>(null);
 useEffect(()=>{let alive=true;api('catalog?occasion='+occasion).then(d=>{const list=d.data.filter(allowedGift);return list.length>=3?list:api('catalog').then(all=>all.data.filter(allowedGift))}).then(list=>{if(alive)setItems(list.slice(0,5))}).catch(()=>{if(alive)setItems([])});return()=>{alive=false}},[occasion]);
 if(items&&!items.length)return null;
 return <section className={s.gifts} aria-labelledby="w-gifts">
  <div className={s.giftsHead}><h2 id="w-gifts">Təbrikin yanına kiçik bir hədiyyə</h2><a href={'/gifts?occasion='+occasion} className={s.allLink}>Bütün hədiyyələr</a></div>
  {items?<div className={s.giftGrid}>{items.map(p=><GiftCard key={p.id} product={p}/>)}</div>:<p role="status" className={s.fine}>Hədiyyələr yüklənir...</p>}
 </section>;
}
