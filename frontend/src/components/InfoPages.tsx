import Link from 'next/link';
import {Icon} from './HomeOpening';
import home from './HomePage.module.css';
import s from './InfoPages.module.css';
export function CompaniesLanding(){return <main className="product-page"><section className="company-hero"><div><span className="kicker">Wisher şirkətlər üçün</span><h1>Şirkətiniz üçün<br/>təbrik və hədiyyə planları.</h1><p>Əməkdaşların ad günləri, müştərilərə təşəkkür və komanda bayramları. İnsanları, hədiyyə seçimlərini və təbrik planlarını bir iş sahəsində idarə edin.</p><Link className="button" href="/user/company">Şirkət sahəsini aç <Icon name="arrow"/></Link></div><div className="company-illustration"><span>Şirkət sahəsində nə saxlanır?</span><dl><dt>İnsanlar</dt><dd>Əməkdaşlar və müştərilər</dd><dt>Təbrik planı</dt><dd>Tarix, alıcılar və hədiyyə seçimi</dd><dt>Şirkət kartı</dt><dd>Şirkətin adı, imzası və təbrik mətni</dd></dl></div></section><div className="feature-columns">{[['İnsanlar','Əməkdaşları və müştəriləri, şöbələri və doğum tarixlərini saxlayın.'],['Şirkət üslubu','Şirkətin adını, imzasını və kart rəngini müəyyən edin.'],['Təbrik planları','Tarixi və alıcıları seçin, ümumi büdcəni qeyd edin, hədiyyə və mesaj hazırlayın.']].map(([title,body])=><article key={title}><h2>{title}</h2><p>{body}</p></article>)}</div><div className="explanation"><h2>Planlama sizdə, alış-veriş mağazada.</h2><p>Bu mərhələdə şirkət sahəsi hazırlıq və planlama üçündür. Hədiyyələr mağazanın saytından alınır, təbriklər isə sizin seçdiyiniz kanalla paylaşılır. Kampaniyanı saxlamaq avtomatik mesaj və ya sifariş yaratmır.</p></div></main>}
export function GreetingsLanding(){return <main className="product-page"><div className="page-intro"><span className="kicker">Şəxsi təbriklər</span><h1>Ad günləri və bayramlar üçün şəxsi təbriklər.</h1><p>Kimə yazdığınızı, münasibəti və bir şəxsi detalı əlavə edin. Üç variantdan bəyəndiyinizi seçin, dəyişin və kart kimi endirin.</p><Link className="button" href="/user/wishes">Təbrik hazırlamağa başla <Icon name="arrow"/></Link></div><div className="greeting-occasions">{[['birthday','Ad günü'],['anniversary','İldönümü'],['novruz','Novruz'],['thanks','Təşəkkür'],['wedding','Toy'],['graduation','Məzuniyyət'],['newyear','Yeni il'],['support','Dəstək']].map(([key,label])=><Link href={'/user/wishes?occasion='+key} key={key}><Icon name="heart"/><h2>{label}</h2><Icon name="arrow"/></Link>)}</div><div className="explanation"><h2>Son söz sizindir.</h2><p>Mətnləri Azərbaycan, ingilis və rus dillərində hazırlaya bilərsiniz. Səmimi, rəsmi, zarafatcıl və duyğulu üslublar arasından seçin. Hazır mətnlər avtomatik göndərilmir; paylaşmazdan əvvəl nəzərdən keçirin.</p></div></main>}


/* Owner review: no public contact address exists yet. Replace before launch. */
export const CONTACT_EMAIL='salam@example.com';

function Flame(){return <svg viewBox="0 0 20 28" aria-hidden="true" className={s.flame}><path d="M10 1C10 1 3 10 3 17a7 7 0 0014 0C17 10 10 1 10 1z" fill="#ffb627"/><path d="M10 11s-3 4-3 7a3 3 0 006 0c0-3-3-7-3-7z" fill="#fff3c4"/></svg>}

function AboutPage(){
 return <main className={`${home.root} ${s.page}`}>
  <section className={s.aboutHero}>
   <div className={s.aboutText}>
    <h1>Wisher yaxınlarınızı unutmamaq üçündür.</h1>
    <p className={s.aboutLead}>Hamımızın başına gəlib: ad günü yadımızdan çıxır, hədiyyəni son gün tələsik alırıq, təbrik isə hamıya göndərdiyimiz eyni cümlə olur.</p>
    <p className={s.aboutLead}>Wisher bu üç işi bir yerə yığır. Vaxtında xatırladır, Azərbaycan mağazalarından uyğun hədiyyə göstərir və sizin sözlərinizlə təbrik hazırlamağa kömək edir.</p>
    <div className={s.actions}><a href="/gifts" className={s.primary}>Hədiyyə tap</a><a href="/wishes" className={s.outlineLight}>Təbrik yaz</a></div>
   </div>
   <ol className={s.story} aria-label="Nümunə: Ayselin ad günü Wisher ilə">
    <li><span className={s.when}>3 gün qalmış</span>
     <div className={`${s.moment} ${s.momentNote}`}><img src="/concepts/occasions/birthday_cake.png" alt="" width="52" height="52"/><span><b>Ayselin ad gününə 3 gün qaldı</b><small>Hədiyyə seçin, təbrik hazırlayın</small></span></div></li>
    <li><span className={s.when}>2 gün qalmış</span>
     <div className={`${s.moment} ${s.momentGift}`}><img src="/concepts/product-1.webp" alt="" width="84" height="84"/><span><small>Baku Electronics</small><b>LEGO Botanicals: bambuk</b><em>Mağazanın saytında alınır</em></span></div></li>
    <li><span className={s.when}>Ad günü</span>
     <div className={`${s.moment} ${s.momentCard}`}><p className={s.cardTo}>Əziz Aysel,</p><p>ad günün mübarək! Məktəb illərindən bəri kitab sevgimiz dəyişmədi. Yeni yaşında sənə oxumağa bol vaxt arzulayıram.</p><p className={s.cardFrom}>Leyla</p></div></li>
    <li className={s.sampleLabel}>Nümunə</li>
   </ol>
  </section>

  <section className={s.honest} aria-labelledby="honest">
   <h2 id="honest">Açıq danışaq: Wisher nə edir, nə etmir</h2>
   <div className={s.honestCols}>
    <div className={s.does}><h3>Wisher edir</h3><ul>
     <li><b>Yaxınlarınızı və özəl günləri saxlayır.</b> Ad, münasibət və tarix bir yerdə, yalnız sizin hesabınızda.</li>
     <li><b>Növbəti günləri göstərir.</b> Hesabınızın Xatırlatmalar bölməsində yaxınlaşan tarixləri görürsünüz.</li>
     <li><b>Hədiyyə fikirləri tapır.</b> Azərbaycan mağazalarının məhsullarını münasibətə, kimə və büdcəyə görə süzür.</li>
     <li><b>Təbrikin ilk variantlarını hazırlayır.</b> Kimə yazdığınızı və bir xatirəni yazırsınız, DeepSeek üç variant təklif edir.</li>
    </ul></div>
    <div className={s.doesnt}><h3>Wisher etmir</h3><ul>
     <li><b>Hədiyyə satmır.</b> Alış, ödəniş və çatdırılma mağazanın öz saytında olur.</li>
     <li><b>Sizin adınızdan mesaj göndərmir.</b> Təbriki siz oxuyur, düzəldir və özünüz göndərirsiniz.</li>
     <li><b>Hələ SMS və e-poçt xatırlatması göndərmir.</b> Xatırlatmalar hesabınızda görünür.</li>
    </ul></div>
   </div>
  </section>

  <section className={s.behind} aria-labelledby="behind">
   <h2 id="behind">Bunun arxasında nə var</h2>
   <div className={s.behindGrid}>
    <a href="/gifts" className={`${s.tile} ${s.tileBig}`} style={{background:'#fde8ec'}}>
     <b>Hədiyyələr Azərbaycan mağazalarından</b>
     <span>Hər məhsulda satıcı mağaza göstərilir. Bəyəndiyinizi mağazanın saytında alırsınız, qiymət və çatdırılmanı orada dəqiqləşdirirsiniz.</span>
     <span className={s.tileLink}>Hədiyyələrə baxın</span>
     <span className={s.shelf} aria-hidden="true">{[1,2,4,5].map(n=><img key={n} src={`/concepts/product-${n}.webp`} alt="" width="96" height="96" loading="lazy"/>)}</span>
    </a>
    <a href="/wishes" className={s.tile} style={{background:'#e6f4ea'}}>
     <b>Son söz sizindir</b>
     <span>Təbrik variantlarını DeepSeek hazırlayır. Azərbaycan, ingilis və ya rus dilində, istədiyiniz tonda. Siz dəyişir, saxlayır və kart kimi endirirsiniz.</span>
     <span className={s.tileLink}>Təbrik yazın</span>
     <img className={s.obj} src="/concepts/occasions/bouquet.png" alt="" width="84" height="84" loading="lazy"/>
    </a>
    <a href="/companies" className={s.tile} style={{background:'#e8f0fb'}}>
     <b>Şirkətlər üçün ayrıca sahə</b>
     <span>Əməkdaşların ad günləri və komanda bayramları üçün alıcıları, büdcəni və təbrik mətnini planlayın.</span>
     <span className={s.tileLink}>Şirkət sahəsinə baxın</span>
     <img className={s.obj} src="/concepts/occasions/briefcase.png" alt="" width="84" height="84" loading="lazy"/>
    </a>
   </div>
   <p className={s.kimlikNote}><Flame/> Giriş kimlik.az ilə olur: ayrıca parol yaratmırsınız. Hədiyyələrə baxmaq üçün isə heç daxil olmaq lazım deyil.</p>
  </section>

  <section className={s.closing} aria-labelledby="closing">
   <div><h2 id="closing">Növbəti özəl günü indi qeyd edin</h2><p>Bir ad və tarix kifayətdir. Qalanında Wisher kömək edəcək.</p></div>
   <div className={s.actions}><a href="/user/occasions" className={s.lightBtn}>Özəl gün əlavə et</a><a href="/faq" className={s.outlineLight}>Suallara baxın</a></div>
  </section>
 </main>;
}

type QA=[string,React.ReactNode];
const faq:{id:string;title:string;img:string;bg:string;items:QA[]}[]=[
 {id:'hediyyeler',title:'Hədiyyələr',img:'wrapped_gift',bg:'#fde8ec',items:[
  ['Hədiyyəni Wisher-dən alıram?','Xeyr. Bəyəndiyiniz məhsulun səhifəsindən mağazanın saytına keçirsiniz. Ödəniş, çatdırılma və qaytarma həmin mağazanın şərtləri ilə olur.'],
  ['Qiymətlər yenilənirmi?','Qiymətlər mağazaların saytından götürülür və məhsul səhifəsində son yoxlanış vaxtı göstərilir. Qiymət və mövcudluq dəyişə bilər, alışdan əvvəl mağazada dəqiqləşdirin.'],
  ['Bəyəndiyim hədiyyəni necə yadda saxlayım?',<>Məhsulun üzərindəki ürəyə toxunun. O, hesabınızdakı <a href="/user/wishlist">Hədiyyə siyahım</a> bölməsinə düşür. Bunun üçün kimlik.az ilə daxil olmaq lazımdır.</>],
  ['Hədiyyələrə baxmaq üçün qeydiyyat lazımdır?','Xeyr. Kataloqa baxmaq və mağazaya keçmək üçün daxil olmaq lazım deyil.'],
 ]},
 {id:'tebrikler',title:'Təbriklər',img:'heart',bg:'#fbe9f3',items:[
  ['Təbrik necə hazırlanır?',<>Hesabınızda <a href="/user/wishes">təbrik formasını</a> açın, kimə yazdığınızı, münasibəti, bir xatirəni və tonu seçin. Wisher üç variant təklif edir. Bəyəndiyinizi dəyişə, saxlaya, köçürə və kart kimi endirə bilərsiniz.</>],
  ['Mətnləri kim yazır?','Variantları DeepSeek süni intellekt xidməti formaya yazdığınız məlumatlara görə hazırlayır. Mətni göndərməzdən əvvəl oxuyun və öz sözlərinizlə düzəldin.'],
  ['Hansı dillərdə və tonlarda yazmaq olar?','Azərbaycan, ingilis və rus dillərində. Ton olaraq səmimi, rəsmi, zarafatcıl və duyğulu üslub seçə bilərsiniz.'],
  ['Təbrik avtomatik göndərilir?','Xeyr. Wisher heç kimə sizin adınızdan mesaj göndərmir. Mətni köçürüb WhatsApp-da və ya istədiyiniz yerdə özünüz göndərirsiniz.'],
 ]},
 {id:'xatirlatmalar',title:'Xatırlatmalar',img:'birthday_cake',bg:'#fff0e6',items:[
  ['Xatırlatmalar harada görünür?',<>Hesabınızın <a href="/user/reminders">Xatırlatmalar</a> bölməsində növbəti yeddi günün özəl günləri görünür.</>],
  ['SMS və ya e-poçt gələcək?','Hazırda yox. Xatırlatmalar yalnız hesabınızda görünür.'],
  ['Doğum ilini yazmalıyam?','Xeyr. Ad günü üçün gün və ay kifayətdir.'],
 ]},
 {id:'hesab',title:'Hesab və məxfilik',img:'seedling',bg:'#e6f4ea',items:[
  ['Necə daxil oluram?','kimlik.az hesabınızla. Ayrıca parol yaratmırsınız. Yuxarıdakı "Daxil ol" düyməsinə toxunun, açılan pəncərədə kimlik.az ilə təsdiqləyin.'],
  ['Wisher pulsuzdur?','Hədiyyələrə baxmaq, yaxınları və tarixləri saxlamaq pulsuzdur. Təbrik hazırlamaq üçün gündəlik limit var.'],
  ['Saxladığım məlumatları kim görür?',<>Yaxınlarınız, tarixlər, təbriklər və hədiyyə siyahınız yalnız sizin hesabınızda görünür. Ətraflı: <a href="/privacy">Məxfilik</a>.</>],
  ['Məlumatlarımı necə silim?',<>Yaxınları, tarixləri, təbrikləri və siyahıdakı hədiyyələri hesabınızda özünüz silə bilərsiniz. Hesabı tamamilə silmək üçün bizə yazın.</>],
 ]},
 {id:'sirketler',title:'Şirkətlər',img:'briefcase',bg:'#e8f0fb',items:[
  ['Şirkət sahəsində nə var?',<>Əməkdaş və müştəri siyahısı, şirkətin adı və imzası, təbrik planları: tarix, alıcılar, büdcə, hədiyyə və mətn. <a href="/companies">Şirkətlər üçün</a></>],
  ['Şirkət kampaniyası avtomatik göndərilir?','Xeyr. Kampaniya planlaşdırmaq üçündür. Mesajı paylaşmaq və hədiyyəni mağazadan almaq sizin əlinizdədir.'],
 ]},
];

function FaqPage(){
 return <main className={`${home.root} ${s.page}`}>
  <section className={s.faqIntro}>
   <div><h1>Suallar və cavablar</h1><p>Wisher-i ilk dəfə açanların ən çox soruşduqları. Cavabı tapmasanız, bizə yazın.</p></div>
   <nav className={s.jump} aria-label="Bölmələr">{faq.map(g=><a key={g.id} href={'#'+g.id}>{g.title}</a>)}</nav>
  </section>
  <div className={s.faqBody}>
   <div className={s.faqGroups}>{faq.map(g=><section key={g.id} id={g.id} className={s.group} aria-labelledby={g.id+'-h'}>
    <div className={s.groupHead}><span className={s.groupIcon} style={{background:g.bg}}><img src={`/concepts/occasions/${g.img}.png`} alt="" width="40" height="40" loading="lazy"/></span><h2 id={g.id+'-h'}>{g.title}</h2></div>
    <div className={s.qaList}>{g.items.map(([q,a],i)=><details key={q} className={s.qa} open={g.id==='hediyyeler'&&i===0}><summary>{q}<span className={s.plus} aria-hidden="true"/></summary><div className={s.answer}>{a}</div></details>)}</div>
   </section>)}</div>
   <aside className={s.contact} aria-labelledby="contact-h">
    <img src="/concepts/occasions/balloon.png" alt="" width="64" height="64"/>
    <h2 id="contact-h">Cavabı tapmadınız?</h2>
    <p>Sualınızı yazın, oxuyub cavab verəcəyik.</p>
    <a className={s.primary} href={`mailto:${CONTACT_EMAIL}?subject=${encodeURIComponent('Wisher sualı')}`}>Bizə yazın</a>
    <small>{CONTACT_EMAIL}</small>
   </aside>
  </div>
 </main>;
}

type Legal={title:string;lead:string;sections:{id:string;title:string;body:React.ReactNode}[]};
const legal:Record<'privacy'|'terms',Legal>={
 privacy:{title:'Məxfilik siyasəti',lead:'Wisher-də hansı məlumatları saxladığımızı, nə üçün istifadə etdiyimizi və onları necə idarə edə biləcəyinizi sadə dillə izah edirik.',sections:[
  {id:'qisa',title:'Qısaca',body:<ul><li>Giriş kimlik.az ilə olur, parolunuzu biz görmürük.</li><li>Yaxınlarınız, tarixlər, təbriklər və hədiyyə siyahınız yalnız sizin hesabınızda görünür.</li><li>Təbrik formasına yazdıqlarınız mətn hazırlamaq üçün DeepSeek xidmətinə göndərilir.</li><li>Hədiyyəni mağazanın saytında alırsınız, orada mağazanın öz qaydaları keçərlidir.</li></ul>},
  {id:'toplanan',title:'Hansı məlumatları saxlayırıq',body:<><p><b>kimlik.az-dan gələn məlumat.</b> Daxil olanda kimlik.az bizə hesab identifikatorunuzu, adınızı və paylaşdığınız halda e-poçt ünvanınızı ötürür.</p><p><b>Özünüz əlavə etdikləriniz.</b> Yaxınlarınızın adı, münasibət, qrup, doğum tarixi, e-poçt və qeydlər; özəl günlər; təbrik sorğuları və saxladığınız mətnlər; hədiyyə siyahısı; şirkət sahəsində əməkdaşlar və təbrik planları.</p><p><b>Texniki məlumat.</b> Hesabınızın açıq qalması üçün brauzerdə sessiya kukisi saxlanır. Server təhlükəsizlik və xətaların aradan qaldırılması üçün standart sorğu qeydləri apara bilər.</p></>},
  {id:'meqsed',title:'Məlumatları nə üçün istifadə edirik',body:<ul><li>Hesabınızı göstərmək və saxladıqlarınızı sizə qaytarmaq.</li><li>Yaxınlaşan özəl günləri hesabınızda göstərmək.</li><li>İstədiyiniz zaman təbrik variantları hazırlamaq.</li><li>Xidməti təhlükəsiz və işlək saxlamaq, sui-istifadənin qarşısını almaq.</li></ul>},
  {id:'deepseek',title:'Təbrik hazırlanması və DeepSeek',body:<><p>Təbrik hazırladığınız zaman formaya yazdığınız məlumatlar (kimə, münasibət, xatirə, ton, dil) mətn yaratmaq üçün DeepSeek xidmətinə göndərilir. Kontakt siyahınız bütövlükdə göndərilmir.</p><p>Bu formaya şəxsi kimlik nömrələri, sağlamlıq və ya digər həssas məlumatlar yazmayın.</p></>},
  {id:'paylasma',title:'Məlumatları kimlə paylaşırıq',body:<><p>Məlumatlarınız başqa istifadəçilərə açıq deyil. Xidmətin işləməsi üçün aşağıdakı tərəflərdən istifadə edirik:</p><ul><li><b>kimlik.az</b>: giriş üçün.</li><li><b>DeepSeek</b>: təbrik mətnlərinin hazırlanması üçün.</li><li><b>Hostinq provayderi</b>: saytın və verilənlər bazasının saxlanması üçün.</li></ul><p>Mağazanın saytına keçdikdə onun məxfilik qaydaları tətbiq olunur. Məhsul şəkilləri mağazanın serverindən yüklənə bilər.</p></>},
  {id:'saxlama',title:'Saxlama və silmə',body:<><p>Yaxınları, özəl günləri, təbrikləri və hədiyyə siyahısındakı məhsulları hesabınızda istədiyiniz vaxt özünüz silə bilərsiniz. Silinən kontaktla bağlı tarix kontaktsız qalır.</p><p>Hesabınızı və ona bağlı bütün məlumatları tamamilə silmək üçün <a href={`mailto:${CONTACT_EMAIL}`}>{CONTACT_EMAIL}</a> ünvanına yazın.</p></>},
  {id:'huquqlar',title:'Sizin hüquqlarınız',body:<p>Haqqınızda saxlanan məlumatı soruşmaq, düzəltmək və silinməsini istəmək hüququnuz var. Sorğunuzu yuxarıdakı ünvana göndərin.</p>},
  {id:'deyisiklik',title:'Dəyişikliklər',body:<p>Bu siyasət dəyişərsə, yenilənmiş mətni bu səhifədə dərc edəcəyik. Əhəmiyyətli dəyişikliklər barədə saytda xəbər verəcəyik.</p>},
 ]},
 terms:{title:'İstifadə şərtləri',lead:'Wisher-dən istifadə edərkən nəyə razılaşdığınızı qısa və aydın yazmışıq.',sections:[
  {id:'xidmet',title:'Wisher nədir',body:<p>Wisher yaxınlarınızı və özəl günləri yadda saxlamağa, Azərbaycan mağazalarından hədiyyə fikirləri tapmağa və təbrik mətni hazırlamağa kömək edən xidmətdir. Şirkətlər üçün ayrıca planlama sahəsi var.</p>},
  {id:'hesab',title:'Hesab',body:<><p>Hesaba kimlik.az ilə daxil olursunuz. Hesabınızda baş verənlərə görə siz cavabdehsiniz; cihazınızı başqası ilə paylaşırsınızsa, işinizi bitirəndə hesabdan çıxın.</p></>},
  {id:'hediyyeler',title:'Hədiyyələr və mağazalar',body:<ul><li>Wisher hədiyyə satmır. Alış, ödəniş, çatdırılma və qaytarma satıcı mağazanın saytında və onun şərtləri ilə olur.</li><li>Qiymət və mövcudluq mağazanın saytından götürülür və dəyişə bilər. Alışdan əvvəl mağazada yoxlayın.</li><li>Məhsulun Wisher-də göstərilməsi həmin mağaza ilə tərəfdaşlıq demək deyil.</li></ul>},
  {id:'tebrikler',title:'Təbriklər',body:<ul><li>Təbrik variantlarını süni intellekt (DeepSeek) hazırlayır. Onlarda səhv və ya yersiz ifadə ola bilər.</li><li>Mətni göndərməzdən əvvəl oxumaq və düzəltmək sizin qərarınızdır. Wisher sizin adınızdan heç kimə mesaj göndərmir.</li><li>Təbrik hazırlamaq üçün gündəlik limit tətbiq oluna bilər.</li></ul>},
  {id:'xatirlatma',title:'Xatırlatmalar və şirkət planları',body:<p>Xatırlatmalar hesabınızda göstərilir. Hazırda SMS və ya e-poçt göndərilmir. Şirkət kampaniyasını saxlamaq mesajın göndərilməsi və ya sifariş verilməsi demək deyil.</p>},
  {id:'melumat',title:'Əlavə etdiyiniz məlumatlar',body:<p>Yalnız saxlamağa haqqınız olan şəxsi məlumatları əlavə edin. Əməkdaşların və ya başqalarının məlumatlarını əlavə edirsinizsə, bunun üçün əsasınız olmalıdır.</p>},
  {id:'qadagan',title:'Nə etmək olmaz',body:<ul><li>Başqalarının hesabına və ya məlumatlarına giriş əldə etməyə çalışmaq.</li><li>Xidməti avtomatlaşdırılmış yolla həddən artıq yükləmək və ya limitləri keçməyə çalışmaq.</li><li>Təhqiramiz, qanunsuz və ya başqasını aldatmaq üçün mətn hazırlamaq.</li></ul>},
  {id:'odenis',title:'Ödəniş',body:<p>Hazırda Wisher-dən istifadə pulsuzdur. Ödənişli funksiyalar əlavə olunarsa, qiymət və şərtlər əvvəlcədən göstəriləcək.</p>},
  {id:'mesuliyyet',title:'Məsuliyyət',body:<p>Wisher xidməti olduğu kimi təqdim edir. Mağazaların məhsullarına, qiymətlərinə və çatdırılmasına görə satıcı mağaza cavabdehdir. Xidmətdə fasilə və ya səhv ola bilər; onları tez aradan qaldırmağa çalışırıq.</p>},
  {id:'elaqe',title:'Dəyişikliklər və əlaqə',body:<p>Şərtlər dəyişərsə, yenilənmiş mətni bu səhifədə dərc edəcəyik. Suallarınız üçün: <a href={`mailto:${CONTACT_EMAIL}`}>{CONTACT_EMAIL}</a>.</p>},
 ]},
};

function LegalPage({page}:{page:'privacy'|'terms'}){
 const d=legal[page],other=page==='privacy'?['/terms','İstifadə şərtləri']:['/privacy','Məxfilik siyasəti'];
 return <main className={`${home.root} ${s.page}`}>
  <header className={s.legalHead}>
   <h1>{d.title}</h1>
   <p>{d.lead}</p>
   <p className={s.draft} role="note"><b>Qaralama.</b> Bu mətn sadə dildə hazırlanıb və hələ hüquqi yoxlamadan keçməyib. Yekun versiya dərc olunanda tarix burada göstəriləcək.</p>
  </header>
  <div className={s.legalBody}>
   <nav className={s.toc} aria-label="Mündəricat"><b>Mündəricat</b><ol>{d.sections.map(x=><li key={x.id}><a href={'#'+x.id}>{x.title}</a></li>)}</ol><a className={s.otherDoc} href={other[0]}>{other[1]}</a></nav>
   <article className={s.legalText}>{d.sections.map((x,i)=><section key={x.id} id={x.id}><h2><span>{i+1}.</span> {x.title}</h2>{x.body}</section>)}</article>
  </div>
 </main>;
}

export function InfoPage({page}:{page:string}){
 if(page==='about')return <AboutPage/>;
 if(page==='faq')return <FaqPage/>;
 return <LegalPage page={page==='terms'?'terms':'privacy'}/>;
}
