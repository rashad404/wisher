import type {Metadata} from 'next';
import {Fraunces, Manrope} from 'next/font/google';
import s from './d.module.css';

const display = Fraunces({subsets: ['latin', 'latin-ext'], weight: ['600', '700'], variable: '--d-display'});
const text = Manrope({subsets: ['latin', 'latin-ext'], weight: ['400', '500', '600', '700', '800'], variable: '--d-text'});

export const metadata: Metadata = {title: 'Wisher - konsept D', robots: {index: false}, icons: {icon: [{url: '/concepts/candle-logo/v2/favicon-flame.svg', type: 'image/svg+xml'}, {url: '/concepts/candle-logo/v2/favicon-flame-32.png', sizes: '32x32'}], apple: '/concepts/candle-logo/v2/apple-touch-icon.png'}};

const gifts = [
  {id: 5, title: 'Fujifilm Instax Mini LiPlay+ fotoaparat', store: 'Baku Electronics', price: '599,99', img: '/concepts/product-5.webp', tag: 'Gəncə'},
  {id: 2, title: 'JBL Go 5 portativ dinamik, ağ', store: 'Baku Electronics', price: '99,99', img: '/concepts/product-2.webp', tag: 'Yeniyetməyə'},
  {id: 4, title: 'Tognana qəhvə dəmləyən', store: 'Baku Electronics', price: '32,99', img: '/concepts/product-4.webp', tag: 'Valideynə'},
  {id: 1, title: 'LEGO Botanicals: bambuk', store: 'Baku Electronics', price: '79,99', img: '/concepts/product-1.webp', tag: 'Dosta'},
  {id: 6, title: 'Ttec 20000 mAh power bank', store: 'Baku Electronics', price: '129,99', img: '/concepts/product-6.webp', tag: 'Həmkara'},
];
const recipients = ['Hamısı', 'Anaya', 'Ataya', 'Həyat yoldaşına', 'Dosta', 'Uşağa', 'Müəllimə', 'Həmkara'];
const months = ['Yanvar', 'Fevral', 'Mart', 'Aprel', 'May', 'İyun', 'İyul', 'Avqust', 'Sentyabr', 'Oktyabr', 'Noyabr', 'Dekabr'];
const budgets = ['50 AZN-ə qədər', '50-150 AZN', '150 AZN-dən çox'];

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

export default function ConceptD() {
  return <div className={`${s.root} ${display.variable} ${text.variable}`}>
    <header className={s.header}>
      <a href="/" className={s.logo} aria-label="Wisher.az ana səhifə"><img src="/concepts/candle-logo/v2/wordmark-white.svg" alt="wisher.az" height="38"/></a>
      <nav className={s.nav} aria-label="Əsas menyu"><a href="/gifts">Hədiyyələr</a><a href="/wishes">Təbriklər</a><a href="/companies">Şirkətlər üçün</a></nav>
      <a href="/user" className={s.login}>Daxil ol</a>
    </header>

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
          <p className={s.free}>Pulsuzdur. Qeydiyyat lazım deyil.</p>
        </div>

        <div className={s.stage} aria-label="Nümunə: Aysel üçün təbrik və hədiyyə">
          <article className={s.card}>
            <div className={s.cardBorder}>
              <p className={s.cardTo}>Əziz Aysel,</p>
              <p className={s.cardBody}>ad günün mübarək! Məktəb illərindən bəri kitab sevgimiz dəyişmədi. Yeni yaşında sənə cansağlığı və oxumağa bol vaxt arzulayıram.</p>
              <p className={s.cardFrom}>Leyla</p>
            </div>
          </article>
          <a href="/gifts/1" className={s.giftTag}>
            <img src="/concepts/product-1.webp" alt="" width="96" height="96"/>
            <span><small>Baku Electronics</small><b>LEGO Botanicals: bambuk</b><em>79,99 AZN</em></span>
          </a>
          <p className={s.sample}>Nümunə</p>
        </div>
      </section>

      <section className={s.occasions} aria-labelledby="occ">
        <h2 id="occ">Hansı gün yaxınlaşır?</h2>
        <ul>{occasions.map(o => <li key={o.name}><a href="/gifts" style={{background: o.bg}}><b>{o.name}</b><img src={`/concepts/occasions/${o.img}.png`} alt="" width="96" height="96" loading="lazy"/></a></li>)}</ul>
      </section>

      <section className={s.gifts} aria-labelledby="gifts">
        <div className={s.giftsHead}>
          <h2 id="gifts">Kimə hədiyyə axtarırsınız?</h2>
          <a href="/gifts" className={s.allLink}>Bütün hədiyyələr</a>
        </div>
        <div className={s.chips} role="group" aria-label="Kimə">{recipients.map((r, i) => <a key={r} href="/gifts" className={i === 0 ? s.chipOn : s.chip}>{r}</a>)}</div>
        <div className={s.chips} role="group" aria-label="Büdcə">{budgets.map(b => <a key={b} href="/gifts" className={s.chipSoft}>{b}</a>)}</div>
        <div className={s.giftGrid}>{gifts.map(g => <article key={g.id} className={s.gift}>
          <a href={'/gifts/' + g.id} className={s.giftPhoto}><img src={g.img} alt={g.title} width="320" height="320" loading="lazy"/><span className={s.giftFor}>{g.tag}</span></a>
          <button type="button" className={s.save} aria-label="Siyahıya əlavə et"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21s-7.5-4.6-9.5-9.3C1 8 3.4 4.5 7 4.5c2 0 3.6 1.1 5 3 1.4-1.9 3-3 5-3 3.6 0 6 3.5 4.5 7.2C19.5 16.4 12 21 12 21z"/></svg></button>
          <a href={'/gifts/' + g.id} className={s.giftInfo}><strong>{g.price} AZN</strong><span>{g.title}</span><small>{g.store}</small></a>
        </article>)}</div>
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
            <a href="/wishes" className={s.builderGo}>3 variant hazırla</a>
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
          <p>Adı və tarixi yazın. Vaxtı gələndə Wisher xatırladacaq, hədiyyə fikirləri və təbrik də hazır olacaq.</p>
          <form className={s.remind} action="/user">
            <label><span>Kimin?</span><input name="name" placeholder="Məsələn, Aysel" autoComplete="off"/></label>
            <div className={s.dateGroup}>
              <label><span>Gün</span><select name="day" defaultValue="15">{Array.from({length: 31}, (_, i) => <option key={i + 1} value={i + 1}>{i + 1}</option>)}</select></label>
              <label><span>Ay</span><select name="month" defaultValue="11">{months.map((m, i) => <option key={m} value={i + 1}>{m}</option>)}</select></label>
            </div>
            <button type="submit">Yadda saxla</button>
          </form>
          <p className={s.remindNote}>Pulsuzdur. Saxlamaq üçün kimlik.az ilə bir dəfə daxil olursunuz.</p>
        </div>
        <div className={s.notes} aria-label="Nümunə xatırlatmalar">
          <div className={s.note}><img src="/concepts/occasions/birthday_cake.png" alt="" width="44" height="44"/><span><b>Sabah Ayselin ad günüdür</b><small>Hədiyyə fikirləri və təbrik hazırdır</small></span><em>indi</em></div>
          <div className={s.note}><img src="/concepts/occasions/tulip.png" alt="" width="44" height="44"/><span><b>8 Marta 5 gün qaldı</b><small>Anan, bacın və müəllimin üçün</small></span><em>5 gün</em></div>
          <div className={s.note}><img src="/concepts/occasions/seedling.png" alt="" width="44" height="44"/><span><b>Novruz yaxınlaşır</b><small>Ailə üçün təbrik və hədiyyələr</small></span><em>2 həftə</em></div>
          <p className={s.notesLabel}>Nümunə</p>
        </div>
      </section>
    </main>
  </div>;
}
