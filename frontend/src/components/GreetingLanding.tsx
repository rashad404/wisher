import home from './HomePage.module.css';
import info from './InfoPages.module.css';
import s from './GreetingLanding.module.css';
import CopyGreeting from './CopyGreeting';
import JsonLd from './JsonLd';
import {breadcrumbLd,faqLd} from '@/lib/seo';
import {greetingPages,greetingsHub,wishHref,type Greeting,type GreetingPage} from '@/messages/greetings';

const full=(g:Greeting)=>g.to+' '+g.body;

function Card({g,page,lead=false}:{g:Greeting;page:string;lead?:boolean}){
 return <article className={lead?s.leadCard:s.card}>
  <p className={s.to}>{g.to}</p>
  <p className={s.body}>{g.body}</p>
  <div className={s.cardFoot}><span className={s.tone}>{g.tone}</span><CopyGreeting text={full(g)} className={s.copy} page={page}/></div>
 </article>;
}

function Faq({items}:{items:[string,string][]}){
 return <section className={s.faq} aria-labelledby="faq-h">
  <h2 id="faq-h">Suallar və cavablar</h2>
  <div className={info.qaList}>{items.map(([q,a],i)=><details key={q} className={info.qa} open={i===0}><summary>{q}<span className={info.plus} aria-hidden="true"/></summary><div className={info.answer}>{a}</div></details>)}</div>
 </section>;
}

function Others({current}:{current?:string}){
 return <section className={`${home.occasions} ${s.others} ${current?'':s.hubOthers}`} aria-labelledby="others-h">
  <h2 id="others-h">{current?'Digər təbriklər':'Münasibəti seçin'}</h2>
  <ul>{greetingPages.filter(p=>p.slug!==current).map(p=><li key={p.slug}><a href={'/tebrikler/'+p.slug} style={{background:p.bg}}><b>{p.name}</b><img src={`/concepts/occasions/${p.img}.png`} alt="" width="96" height="96" loading="lazy"/></a></li>)}{current&&<li><a href="/tebrikler" style={{background:'#fde8ec'}}><b>Bütün təbriklər</b><img src="/concepts/occasions/wrapped_gift.png" alt="" width="96" height="96" loading="lazy"/></a></li>}</ul>
 </section>;
}

function Builder({page}:{page:GreetingPage}){
 return <section className={s.builderBand} aria-labelledby="build-h">
  <div className={s.builderText}>
   <h2 id="build-h">Öz sözlərinizlə təbrik hazırlayın</h2>
   <p>Kimə yazdığınızı, aranızdakı bir xatirəni və tonu seçin. Wisher üç variant hazırlayır, bəyəndiyinizi düzəldib WhatsApp-da göndərirsiniz.</p>
   <ol className={s.steps}><li><b>Kimə və nə münasibətilə</b><span>Adı və aranızdakı münasibəti yazın.</span></li><li><b>Bir xatirə əlavə edin</b><span>Təbrik ümumi yox, ona aid səslənsin.</span></li><li><b>Üç variantdan seçin</b><span>Düzəldin, köçürün və ya kart kimi endirin.</span></li></ol>
  </div>
  <div className={home.builder}>
   <dl className={home.picks}>{page.wishPicks.map(([k,v])=><div key={k}><dt>{k}</dt><dd>{v}</dd></div>)}<div><dt>Ton</dt><dd className={home.tones}><span className={home.toneOn}>Səmimi</span><span>Zarafatlı</span><span>Rəsmi</span></dd></div></dl>
   <a href={wishHref(page.wish)} className={home.builderGo}>Təbrik hazırla</a>
   <p className={s.builderNote}>Nümunə. Hazırlamaq üçün kimlik.az ilə daxil olursunuz.</p>
  </div>
 </section>;
}

function Extras({page}:{page:GreetingPage}){
 return <section className={s.extras} aria-label="Hədiyyə və xatırlatma">
  <a href={'/gifts?'+page.gifts} className={s.extra}><img src="/concepts/occasions/wrapped_gift.png" alt="" width="56" height="56" loading="lazy"/><span><b>{page.giftLabel}</b><small>Azərbaycan mağazalarından seçimlər. Alış mağazanın saytında olur.</small></span><em>Hədiyyələrə bax</em></a>
  <a href="/user/reminders" className={s.extra}><img src="/concepts/occasions/balloon.png" alt="" width="56" height="56" loading="lazy"/><span><b>Növbəti dəfə unutmayın</b><small>Adı və tarixi yazın, yaxınlaşan gün hesabınızda görünsün.</small></span><em>Xatırlatma qur</em></a>
 </section>;
}

export function GreetingLanding({page}:{page:GreetingPage}){
 const lead=page.groups[0].items[0];
 return <main className={`${home.root} ${s.page}`}>
  <JsonLd data={breadcrumbLd([['Təbriklər','/tebrikler'],[page.h1,'/tebrikler/'+page.slug]])}/>
  <JsonLd data={faqLd(page.faq)}/>
  <section className={s.hero}>
   <div className={s.heroText}>
    <nav className={s.crumbs} aria-label="Yol"><a href="/">Ana səhifə</a><span aria-hidden="true">/</span><a href="/tebrikler">Təbriklər</a><span aria-hidden="true">/</span><span aria-current="page">{page.name}</span></nav>
    <h1>{page.h1}</h1>
    <p className={s.lead}>{page.intro}</p>
    <div className={home.actions}><a href={wishHref(page.wish)} className={home.primary}>Təbrik hazırla</a><a href="#numuneler" className={home.secondary}>Nümunələrə bax</a></div>
   </div>
   <div className={s.heroCard}><Card g={lead} page={page.slug} lead/><p className={s.sample}>Nümunə</p></div>
  </section>
  <section id="numuneler" className={s.examples} aria-label="Təbrik nümunələri">
   <nav className={s.jump} aria-label="Bölmələr">{page.groups.map(g=><a key={g.id} href={'#'+g.id}>{g.title}</a>)}</nav>
   {page.groups.map(g=><section key={g.id} id={g.id} className={s.group} aria-labelledby={g.id+'-h'}>
    <h2 id={g.id+'-h'}>{g.title}</h2>
    <div className={s.grid}>{g.items.map(item=><Card key={item.to+item.body.slice(0,20)} g={item} page={page.slug}/>)}</div>
   </section>)}
  </section>
  <Builder page={page}/>
  <Extras page={page}/>
  <Faq items={page.faq}/>
  <Others current={page.slug}/>
 </main>;
}

export function GreetingsHub(){
 return <main className={`${home.root} ${s.page}`}>
  <JsonLd data={breadcrumbLd([['Təbriklər','/tebrikler']])}/>
  <JsonLd data={faqLd(greetingsHub.faq)}/>
  <section className={s.hero}>
   <div className={s.heroText}>
    <nav className={s.crumbs} aria-label="Yol"><a href="/">Ana səhifə</a><span aria-hidden="true">/</span><span aria-current="page">Təbriklər</span></nav>
    <h1>{greetingsHub.h1}</h1>
    <p className={s.lead}>{greetingsHub.intro}</p>
    <div className={home.actions}><a href="/wishes" className={home.primary}>Təbrik hazırla</a><a href="#numuneler" className={home.secondary}>Nümunələrə bax</a></div>
   </div>
   <div className={s.heroCard}><Card g={greetingPages[0].groups[0].items[0]} page="tebrikler" lead/><p className={s.sample}>Nümunə</p></div>
  </section>
  <Others/>
  <section id="numuneler" className={s.examples} aria-labelledby="picks-h">
   <h2 id="picks-h" className={s.hubTitle}>Hər münasibətdən bir nümunə</h2>
   <div className={`${s.grid} ${s.hubGrid}`}>{greetingPages.map(p=><div key={p.slug} className={s.hubItem}><Card g={p.groups[0].items[1]||p.groups[0].items[0]} page="tebrikler"/><a href={'/tebrikler/'+p.slug} className={s.more}>{p.h1}: bütün nümunələr</a></div>)}</div>
  </section>
  <Faq items={greetingsHub.faq}/>
 </main>;
}
