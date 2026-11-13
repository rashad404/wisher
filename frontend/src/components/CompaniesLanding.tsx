import home from './HomePage.module.css';
import s from './CompaniesLanding.module.css';

const people=[
 {d:'14',m:'noy',name:'Nigar Əliyeva',dep:'Marketinq',gift:'Qəhvə dəmləyən'},
 {d:'19',m:'noy',name:'Elvin Məmmədov',dep:'Satış',gift:'Qəhvə dəmləyən'},
 {d:'23',m:'noy',name:'Səbinə Quliyeva',dep:'Mühasibatlıq',gift:'Qəhvə dəmləyən'},
 {d:'28',m:'noy',name:'Rauf Həsənov',dep:'IT',gift:'Qəhvə dəmləyən'},
];
function Tick(){return <svg viewBox="0 0 24 24" aria-hidden="true" className={s.tick}><path d="M4 12l5 5L20 6"/></svg>}

export default function CompaniesLanding(){
 return <main className={`${home.root} ${s.page}`}>
  <section className={s.hero}>
   <div className={s.heroText}>
    <p className={s.for}>HR və ofis menecerləri üçün</p>
    <h1>Komandada heç kimin ad günü unudulmasın.</h1>
    <p className={s.lead}>Əməkdaşların ad günlərini, müştərilərə təşəkkürü və bayram hədiyyələrini bir planda toplayın: kimə, nə vaxt, hansı hədiyyə və hansı söz.</p>
    <div className={s.actions}><a href="/user/company" className={s.primary}>Şirkət sahəsini pulsuz açın</a><a href="#how" className={s.secondary}>Necə işləyir</a></div>
    <ul className={s.ticks}><li><Tick/>Hazırda pulsuzdur</li><li><Tick/>Bir planda 200 nəfərə qədər</li><li><Tick/>Hədiyyələr Azərbaycan mağazalarından</li></ul>
   </div>
   <div className={s.stage} aria-label="Nümunə: noyabr ad günləri planı">
    <article className={s.sheet}>
     <header><b>Noyabr ad günləri</b><span>4 nəfər</span></header>
     <ul>{people.map(p=><li key={p.name}><span className={s.date}><b>{p.d}</b>{p.m}</span><span className={s.who}><b>{p.name}</b><small>{p.dep}</small></span><span className={s.giftChip}>{p.gift}</span></li>)}</ul>
     <footer>
      <div className={s.budgetLine}><span>Hədiyyələr: 4 x 32,99 AZN</span><b>131,96 / 200 AZN</b></div>
      <div className={s.bar} aria-hidden="true"><i style={{width:'66%'}}/></div>
     </footer>
    </article>
    <figure className={s.companyCard}>
     <p className={s.ccTo}>Nigar, ad günün mübarək!</p>
     <p>Komandamızın ən yaradıcı insanı olduğun üçün sağ ol. Yeni yaşın uğurlu olsun.</p>
     <figcaption>Nümunə MMC komandası</figcaption>
    </figure>
    <a href="/gifts/4" className={s.product}><img src="/concepts/product-4.webp" alt="" width="72" height="72"/><span><small>Baku Electronics</small><b>Tognana qəhvə dəmləyən</b><em>32,99 AZN</em></span></a>
    <p className={s.sample}>Nümunə</p>
   </div>
  </section>

  <section className={s.cases} aria-labelledby="cases">
   <h2 id="cases">Kimləri sevindirirsiniz?</h2>
   <div className={s.caseGrid}>
    <article className={`${s.case} ${s.caseBig}`} style={{background:'#fde8ec'}}>
     <h3>Əməkdaşların ad günü</h3>
     <p>Doğum tarixlərini bir dəfə yazın. Ay ərzində kimin ad günü olduğunu, kimə hədiyyə alındığını bir siyahıda görün.</p>
     <p className={s.example}>Nümunə: 12 əməkdaş, hər birinə 30 AZN-lik hədiyyə və şirkət kartı</p>
     <img src="/concepts/occasions/birthday_cake.png" alt="" width="140" height="140"/>
    </article>
    <article className={s.case} style={{background:'#e6f4ea'}}>
     <h3>Novruz və Yeni il</h3>
     <p>Bütün komandaya bir plan: ümumi büdcə, bir hədiyyə, bir təbrik.</p>
     <img src="/concepts/occasions/seedling.png" alt="" width="96" height="96"/>
    </article>
    <article className={s.case} style={{background:'#fbe9f3'}}>
     <h3>Müştərilərə təşəkkür</h3>
     <p>Daimi müştərilərinizi ayrıca qrupda saxlayın, ilin sonunda təşəkkür edin.</p>
     <img src="/concepts/occasions/bouquet.png" alt="" width="96" height="96"/>
    </article>
   </div>
  </section>

  <section className={s.how} id="how" aria-labelledby="how-title">
   <h2 id="how-title">Üç addımda hazır plan</h2>
   <ol>
    <li><b>1</b><h3>İnsanları əlavə edin</h3><p>Ad, şöbə və doğum tarixi. Əməkdaşları və müştəriləri ayrı saxlayın.</p></li>
    <li><b>2</b><h3>Şirkət kartını qurun</h3><p>Şirkətin adı, rəngi və imzası. Hər təbrik eyni üslubda çıxır.</p></li>
    <li><b>3</b><h3>Planı saxlayın</h3><p>Tarix, alıcılar, büdcə və hədiyyə. Wisher cəmi hesablayır, büdcəni aşanda deyir.</p></li>
   </ol>
   <a href="/user/company" className={s.howGo}>Şirkət sahəsini pulsuz açın</a>
  </section>

  <section className={s.faq} aria-labelledby="faq">
   <div>
    <h2 id="faq">Planlama sizdə, alış-veriş mağazada.</h2>
    <p>Wisher hədiyyə satmır və təbrikləri özü göndərmir. Siz planı qurursunuz, hədiyyəni mağazanın saytından alırsınız, kartı istədiyiniz kanalla paylaşırsınız.</p>
   </div>
   <div>
    <details><summary>Bu xidmət pulludur?</summary><p>Hazırda şirkət sahəsi pulsuzdur. Hədiyyələrin pulunu mağazaya özünüz ödəyirsiniz.</p></details>
    <details><summary>Təbriklər avtomatik göndərilir?</summary><p>Xeyr. Planı saxlamaq mesaj göndərmir və sifariş yaratmır. Kartı PNG kimi endirib özünüz paylaşırsınız.</p></details>
    <details><summary>Neçə nəfəri əlavə edə bilərəm?</summary><p>İnsanların sayına məhdudiyyət yoxdur. Bir planda ən çox 200 alıcı seçilə bilər.</p></details>
    <details><summary>Əməkdaşların məlumatları kimə görünür?</summary><p>Yalnız şirkət sahəsini açan hesaba. Yalnız saxlamağa icazəniz olan məlumatları əlavə edin.</p></details>
   </div>
  </section>

  <section className={s.closing}>
   <p><b>Növbəti ad günü bu ay ola bilər.</b> Siyahını bu gün qurun.</p>
   <a href="/user/company" className={s.primary}>Şirkət sahəsini pulsuz açın</a>
  </section>
 </main>;
}
