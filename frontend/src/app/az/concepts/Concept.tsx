'use client';
import {useEffect,useRef,useState} from 'react';
import products from './catalog.json';
import {opening} from '@/messages/opening';
import s from './concepts.module.css';

type Direction='a'|'b'|'c';
const excerpt=opening.greeting.split('. ')[0]+'.';
const titles:Record<number,string>={1:'LEGO Botanicals Lucky Bamboo',3:'LEGO Creator Flowers in Watering Can',4:'Tognana Marble Floatec'};
function Gift({id,large=false}:{id:number;large?:boolean}) {
  const p=products.find(p=>p.id===id)!;
  const [failed,setFailed]=useState(false), image=useRef<HTMLImageElement>(null);
  useEffect(()=>{if(image.current?.complete && image.current.naturalWidth===0)setFailed(true)},[]);
  return <figure className={`${s.gift} ${large?s.largeGift:''}`}>
    <a href={'/gifts/'+id} className={s.photo} aria-label={p.title}>
      {failed?<span className={s.imageError}>Şəkil yoxdur</span>:<img ref={image} src={p.local_image} alt={p.title} width="600" height="600" onError={()=>setFailed(true)}/>}
    </a>
    <figcaption><span>{p.store}</span><a href={'/gifts/'+id}>{titles[id]}</a><strong>{(p.price_minor!/100).toFixed(2).replace('.',',')} AZN</strong></figcaption>
  </figure>;
}
function Action({place}:{place:string}) {return <a className={s.action} data-primary={place} href="/gifts">Hədiyyə tap</a>}
function Letter({full=false}:{full?:boolean}) {return <div className={full?s.fullLetter:s.letter}><div className={s.letterTop}><span>Aysel üçün</span><span>Nümunə</span></div><p>{full?opening.greeting:excerpt}</p><div className={s.signoff}>{full?'Wisher ilə hazırlanmış təbrik':'Ad günü təbrikindən bir hissə'}</div></div>}
function Header(){return <header className={s.header}><a className={s.wordmark} href="/" aria-label="Wisher ana səhifə">wisher<span>.az</span></a><nav aria-label="Əsas menyu"><a href="/wishes">Təbriklər</a><a href="/companies">Şirkətlər üçün</a><a href="/user">Hesabım</a></nav></header>}
function Foot(){return <footer className={s.footer}><a className={s.wordmark} href="/">wisher<span>.az</span></a><p>Alış-veriş mağazanın saytında tamamlanır.</p><nav aria-label="Məlumat"><a href="/companies">Şirkətlər üçün</a><a href="/privacy">Məxfilik</a><a href="/terms">İstifadə şərtləri</a></nav></footer>}
function PurchaseNote(){return <p className={s.purchase}>Qiymətlər 12.11.2026 tarixində yoxlanıb. Almazdan əvvəl mağazada qiyməti və mövcudluğu yoxlayın. Ödəniş və çatdırılmanı mağaza həyata keçirir.</p>}
export default function Concept({direction}:{direction:Direction}) {
  return <div className={`${s.root} ${s[direction]}`} onClickCapture={e=>{
    const a=(e.target as HTMLElement).closest('a');if(!a)return;
    const detail={event:'wisher_concept_action',direction,action:a.dataset.primary?'find_gift':'navigation',placement:a.dataset.primary||'secondary',destination:a.getAttribute('href')};
    window.dispatchEvent(new CustomEvent('wisher:analytics',{detail}));
    const w=window as Window & {dataLayer?:unknown[]};(w.dataLayer??=[]).push(detail);
  }}>
    <a className={s.skip} href="#concept-main">Məzmuna keç</a><Header/>
    <main id="concept-main">
      {direction==='a' && <>
        <section className={s.aHero}>
          <div className={s.aIntro}><h1>Yaxınınıza hədiyyə,<br/>ona özəl sözlər.</h1><p>Wisher ilə Azərbaycan mağazalarından hədiyyə tapın, yanına ürəyinizdən keçən təbriki əlavə edin.</p><Action place="hero"/><span className={s.free}>Hədiyyələrə baxmaq pulsuzdur. Qeydiyyat lazım deyil.</span></div>
          <div className={s.correspondence}><div className={s.dateLine}>15 noyabr <span>Ayselin ad günü / Nümunə</span></div><Letter/><Gift id={3}/></div>
        </section>
        <section className={s.aStory}><div><h2>Birlikdə keçən illər<br/>təbrikdə hiss olunsun.</h2><p>Məktəb dostluğunuz, sevdiyi kitablar... Kiçik bir detal yazın, təbrik ona aid olsun.</p><a className={s.textLink} href="/wishes">Təbrik hazırla</a><div className={s.sectionAction}><Action place="after-greeting"/></div></div><Letter full/></section>
        <section className={s.aClose}><h2>Növbəti ad günü<br/>yaddan çıxmasın.</h2><div><p>Yaxınlarınızın özəl günlərini hesabınızda saxlayın. Yaxınlaşan tarixləri Wisher-də görün.</p><a className={s.textLink} href="/user/occasions">Özəl günləri qeyd et</a><Action place="closing"/></div></section>
      </>}
      {direction==='b' && <>
        <section className={s.bHero}><div className={s.bPhoto}><Gift id={3} large/><span className={s.photoCaption}>Ad günü üçün bir hədiyyə fikri</span></div><div className={s.bIntro}><h1>Hədiyyəsi də,<br/>təbriki də<br/>{' '}ona uyğun.</h1><p>Wisher sevdiyiniz insan üçün Azərbaycan mağazalarından hədiyyə tapmağa, şəxsi təbrik hazırlamağa kömək edir.</p><Action place="hero"/><span className={s.free}>Pulsuz baxın. Qeydiyyat lazım deyil.</span></div></section>
        <section className={s.bLetter}><div><h2>Hədiyyənin yanına<br/>sizin sözləriniz.</h2><p>Ayselin ad günü üçün Wisher-də hazırlanmış təbrik. Ad nümunədir.</p><a className={s.textLink} href="/wishes">Təbrik hazırla</a><div className={s.sectionAction}><Action place="after-greeting"/></div></div><Letter full/></section>
        <section className={s.bMore}><div><h2>Onun sevdiyi<br/>{' '}kiçik vərdişlər.</h2><p>Səhər qəhvəsini sevən birinə hədiyyə axtarırsınız?</p><Action place="more-gifts"/></div><Gift id={4}/></section>
        <div className={s.bReminder}><p>Ad günləri, Novruz, Yeni il... Özəl günləri hesabınızda saxlayın.</p><a className={s.textLink} href="/user/occasions">Özəl günləri qeyd et</a></div>
      </>}
      {direction==='c' && <>
        <section className={s.cHero}><div className={s.cHeading}><h1>Özəl gün yadınızda,<br/>hədiyyə fikri Wisher-də.</h1><div><p>Yaxınınıza hədiyyə tapın, şəxsi təbrik hazırlayın. Tarixləri də hesabınızda saxlaya bilərsiniz.</p><Action place="hero"/><span className={s.free}>Hədiyyə axtarışı pulsuzdur.</span></div></div><div className={s.occasionSpread}><div className={s.bigDate}><span>Nümunə / Ad günü</span><strong>15</strong><span>noyabr</span><h2>Ayselin günü</h2><p>Ad və tarix nümunədir.</p></div><Gift id={1}/><Letter/></div></section>
        <section className={s.cWords}><div><h2>Tarixi bilirsiniz.<br/>Bəs nə yazasınız?</h2><p>Təbrikə bir xatirənizi əlavə edin. Aysel üçün hazırlanan bu nümunədə məktəb dostluğu və kitab sevgisi var.</p><a className={s.textLink} href="/wishes">Təbrik hazırla</a><div className={s.sectionAction}><Action place="after-greeting"/></div></div><Letter full/></section>
        <section className={s.cClose}><div><h2>Yalnız ad günündə yox.</h2><p>Novruzda ailənizə, Yeni ildə dostunuza, toy ildönümündə sevdiyiniz insana.</p><Action place="closing"/></div><div className={s.occasions}><span>Novruz</span><span>Yeni il</span><span>Toy ildönümü</span><a className={s.textLink} href="/user/occasions">Özəl günləri qeyd et</a></div></section>
      </>}
      <PurchaseNote/>
    </main><Foot/><div className={s.mobileAction}><Action place="mobile-sticky"/></div>
  </div>;
}
