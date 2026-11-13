import s from './HomePage.module.css';
import {FeaturedGifts, HeroGift, ReminderForm} from './HomeInteractions';

const occasions = [
  {name: 'Ad günü', img: 'birthday_cake', bg: '#fde8ec'},
  {name: 'Novruz', img: 'seedling', bg: '#e6f4ea'},
  {name: '8 Mart', img: 'tulip', bg: '#fff0e6'},
  {name: 'Yeni il', img: 'christmas_tree', bg: '#e8f0fb'},
  {name: 'Toy və nişan', img: 'ring', bg: '#f3ecfb'},
  {name: 'Uşaq doğuldu', img: 'baby_bottle', bg: '#e6f6f8'},
  {name: 'Müəllimlər günü', img: 'graduation_cap', bg: '#fdf6dd'},
  {name: 'Təşəkkür', img: 'bouquet', bg: '#fbe9f3'},
];

function Star() {
  return <svg viewBox="0 0 20 28" aria-hidden="true" className={s.star}><path d="M10 1C10 1 3 10 3 17a7 7 0 0014 0C17 10 10 1 10 1z" fill="#ffb627"/><path d="M10 11s-3 4-3 7a3 3 0 006 0c0-3-3-7-3-7z" fill="#fff3c4"/></svg>;
}

export default function HomePage() {
  return <div className={s.root}>
    <main>
      <section className={s.hero}>
        <div className={s.heroText}>
          <p className={s.countdown}><Star/> Ayselin ad gününə 3 gün qaldı</p>
          <h1>Yaxınlarınızın özəl günü yaddan çıxmasın.</h1>
          <p className={s.lead}>Wisher vaxtında xatırladır, Azərbaycan mağazalarından uyğun hədiyyə tapır və sizin sözlərinizlə təbrik hazırlayır.</p>
          <div className={s.actions}>
            <a href="/gifts" className={s.primary}>Hədiyyə tap</a>
            <a href="/wishes" className={s.secondary}>Təbrik yaz</a>
          </div>
          <p className={s.free}>Hədiyyələrə baxmaq pulsuzdur. Qeydiyyat lazım deyil.</p>
        </div>

        <div className={s.stage} aria-label="Nümunə: Aysel üçün təbrik və hədiyyə">
          <article className={s.card}>
            <div className={s.cardBorder}>
              <p className={s.cardTo}>Əziz Aysel,</p>
              <p className={s.cardBody}>ad günün mübarək! Məktəb illərindən bəri kitab sevgimiz dəyişmədi. Yeni yaşında sənə cansağlığı və oxumağa bol vaxt arzulayıram.</p>
              <p className={s.cardFrom}>Leyla</p>
            </div>
          </article>
          <HeroGift/>
          <p className={s.sample}>Nümunə</p>
        </div>
      </section>

      <section className={s.occasions} aria-labelledby="occ">
        <h2 id="occ">Hansı gün yaxınlaşır?</h2>
        <ul>{occasions.map(o => <li key={o.name}><a href={"/gifts?occasion=" + ["birthday","novruz","womens_day","newyear","wedding","birth","teachers_day","thanks"][occasions.indexOf(o)]} style={{background: o.bg}}><b>{o.name}</b><img src={`/concepts/occasions/${o.img}.png`} alt="" width="96" height="96" loading="lazy"/></a></li>)}</ul>
      </section>

      <section className={s.gifts} aria-labelledby="gifts">
        <div className={s.giftsHead}>
          <h2 id="gifts">Kimə hədiyyə axtarırsınız?</h2>
          <a href="/gifts" className={s.allLink}>Bütün hədiyyələr</a>
        </div>
        <FeaturedGifts/>
        <p className={s.shopNote}>Qiymətlər mağazaların saytından götürülür. Alış-veriş mağazanın öz saytında olur.</p>
      </section>

      <section className={s.words} aria-labelledby="words">
        <div className={s.wordsText}>
          <h2 id="words">Təbriki də siz yazmış kimi olsun</h2>
          <p>Kimə yazdığınızı, aranızdakı bir xatirəni və tonu seçin. Wisher üç variant hazırlayır, bəyəndiyinizi düzəldib WhatsApp-da göndərirsiniz.</p>
          <div className={s.builder}>
            <dl className={s.picks}>
              <div><dt>Kimə</dt><dd>Anama</dd></div>
              <div><dt>Münasibət</dt><dd>8 Mart</dd></div>
              <div><dt>Xatirə</dt><dd>Hər səhər çay hazırlayır</dd></div>
              <div><dt>Ton</dt><dd className={s.tones}><span className={s.toneOn}>Səmimi</span><span>Zarafatlı</span><span>Rəsmi</span></dd></div>
            </dl>
            <a href="/user/wishes?recipient=Anam&relationship=Anam" className={s.builderGo}>Təbrik hazırla</a>
          </div>
        </div>
        <div className={s.cards} aria-label="Nümunə təbrik kartları">
          <figure className={`${s.mini} ${s.miniRed}`}><p className={s.miniTo}>Əziz anam,</p><p>8 Mart mübarək! Hər səhər çayımı hazırlayan, hər imtahanda yanımda olan sənsən. Yaxşı ki varsan.</p><figcaption>Səni sevən oğlun</figcaption></figure>
          <figure className={`${s.mini} ${s.miniWhite}`}><p className={s.miniTo}>Anacan,</p><p>Bayramın mübarək! Bu gün çayı mən dəmləyirəm, söz verirəm, şəkəri də unutmayacağam.</p><figcaption>Kamran</figcaption></figure>
          <figure className={`${s.mini} ${s.miniGreen}`}><p className={s.miniTo}>Hörmətli anam,</p><p>Qadınlar günü münasibətilə sizi ürəkdən təbrik edirəm. Cansağlığı və uzun ömür arzulayıram.</p><figcaption>Kamran</figcaption></figure>
          <p className={s.cardsNote}>Nümunə: üç variant, üç ton</p>
        </div>
      </section>

      <section className={s.closing} aria-labelledby="closing">
        <div className={s.closingText}>
          <h2 id="closing">Növbəti ad gününü indi qeyd edin</h2>
          <p>Adı və tarixi yazın. Xatırlatmanı Wisher hesabınızda görün, hədiyyə seçin və təbrik hazırlayın.</p>
          <ReminderForm/>
          <p className={s.remindNote}>Pulsuzdur. Saxlamaq üçün kimlik.az ilə bir dəfə daxil olursunuz.</p>
        </div>
        <div className={s.notes} aria-label="Nümunə xatırlatmalar">
          <div className={s.note}><img src="/concepts/occasions/birthday_cake.png" alt="" width="44" height="44"/><span><b>Sabah Ayselin ad günüdür</b><small>Hədiyyə seçin, təbrik hazırlayın</small></span><em>indi</em></div>
          <div className={s.note}><img src="/concepts/occasions/tulip.png" alt="" width="44" height="44"/><span><b>8 Marta 5 gün qaldı</b><small>Anan, bacın və müəllimin üçün</small></span><em>5 gün</em></div>
          <div className={s.note}><img src="/concepts/occasions/seedling.png" alt="" width="44" height="44"/><span><b>Novruz yaxınlaşır</b><small>Ailə üçün təbrik və hədiyyələr</small></span><em>2 həftə</em></div>
          <p className={s.notesLabel}>Nümunə</p>
        </div>
      </section>
    </main>
  </div>;
}
