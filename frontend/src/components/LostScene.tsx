import home from './HomePage.module.css';
import s from './InfoPages.module.css';

const tiles:[string,string,string,string][]=[
 ['/gifts?occasion=birthday','Ad günü hədiyyələri','birthday_cake','#fde8ec'],
 ['/gifts?occasion=womens_day','8 Mart hədiyyələri','tulip','#fff0e6'],
 ['/wishes','Təbrik yazın','heart','#fbe9f3'],
 ['/user/reminders','Xatırlatmalarım','seedling','#e6f4ea'],
];

/* Shared by the 404 and the error page. Pure markup so both server and client pages can use it. */
export default function LostScene({code,title,lead,action,label}:{code:string;title:string;lead:string;action?:React.ReactNode;label:string}){
 return <main className={`${home.root} ${s.page}`}>
  <section className={s.lost}>
   <div>
    <p className={s.code}><svg viewBox="0 0 20 28" aria-hidden="true" className={s.flame}><path d="M10 1C10 1 3 10 3 17a7 7 0 0014 0C17 10 10 1 10 1z" fill="#ffb627"/><path d="M10 11s-3 4-3 7a3 3 0 006 0c0-3-3-7-3-7z" fill="#fff3c4"/></svg>{code}</p>
    <h1>{title}</h1>
    <p className={s.lostLead}>{lead}</p>
    <div className={s.actions}>{action}<a href="/gifts" className={action?s.outlineInk:s.primary}>Hədiyyə tap</a>{!action&&<a href="/wishes" className={s.outlineInk}>Təbrik yaz</a>}</div>
   </div>
   <div className={s.scene} aria-hidden="true">
    <img className={s.sceneA} src="/concepts/occasions/wrapped_gift.png" alt="" width="190" height="190"/>
    <img className={s.sceneB} src="/concepts/occasions/balloon.png" alt="" width="150" height="150"/>
    <img className={s.sceneC} src="/concepts/occasions/birthday_cake.png" alt="" width="120" height="120"/>
    <p className={s.sceneTag}>{label}<small>Hədiyyə isə yerindədir</small></p>
   </div>
  </section>
  <nav className={s.lostLinks} aria-labelledby="lost-links">
   <h2 id="lost-links">Bəlkə bunlardan birini axtarırdınız</h2>
   <ul className={s.lostTiles}>{tiles.map(([href,t,img,bg])=><li key={href}><a href={href} style={{background:bg}}><b>{t}</b><img src={`/concepts/occasions/${img}.png`} alt="" width="68" height="68" loading="lazy"/></a></li>)}</ul>
  </nav>
 </main>;
}
