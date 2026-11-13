'use client';
import {FormEvent,useEffect,useState} from 'react';
import {api,Page,Product} from '@/lib/workspace';
import {site} from '@/messages/site';
import {GiftPhoto} from './HomeInteractions';
import {downloadPng,isLight} from './greetingCard';
import home from './HomePage.module.css';
import s from './CompanyWorkspace.module.css';

type Company={name:string;signature:string;color:string;people_count?:number;campaigns_count?:number};
type Person={id:number;name:string;email:string;kind:string;department:string;birthday:string};
type Campaign={id:number;title:string;date:string;occasion:string;budget_minor:number;message:string;status:string;product_id:number|null;people_count:number;people?:Person[];product?:Product|null};
const blankPerson={name:'',email:'',kind:'employee',department:'',birthday:''};
const blankCampaign={title:'',date:'',occasion:'thanks',budget:'',message:'',status:'draft',product_id:'',people:[] as number[]};
const MONTHS=['Yanvar','Fevral','Mart','Aprel','May','İyun','İyul','Avqust','Sentyabr','Oktyabr','Noyabr','Dekabr'];
const SHORT=['yan','fev','mar','apr','may','iyn','iyl','avq','sen','okt','noy','dek'];
const occIcon:Record<string,string>={birthday:'birthday_cake',anniversary:'wrapped_gift',wedding:'ring',novruz:'seedling',newyear:'christmas_tree',graduation:'graduation_cap',thanks:'bouquet',support:'heart'};
const statuses:[string,string][]=[['draft','Qaralama'],['planned','Planlaşdırılıb'],['archived','Arxiv']];
const palette=['#a3122f','#0f6b4f','#1d4e89','#1d1416','#b45309','#0e7490'];
const pretty=(iso:string)=>{const [y,m,d]=iso.split('-').map(Number);return y&&m&&d?d+' '+MONTHS[m-1].toLowerCase():''};
const clean=(t:string)=>t.replace(/\s*\([A-Z0-9][A-Z0-9 /-]{3,}\)\s*$/,'').trim();
const money=(n:number)=>(n/100).toFixed(2).replace('.',',')+' AZN';
const ink=(bg:string)=>isLight(bg)?'#1d1416':'#ffffff';

function DateSelect({value,onChange,years,label,required=false}:{value:string;onChange:(v:string)=>void;years:number[];label:string;required?:boolean}){
 const parse=(v:string)=>{const [y,m,d]=(v||'').split('-');return {y:y||'',m:m?String(Number(m)):'',d:d?String(Number(d)):''}};
 const [p,setP]=useState(parse(value));
 useEffect(()=>{const cur=p.y&&p.m&&p.d?`${p.y}-${p.m.padStart(2,'0')}-${p.d.padStart(2,'0')}`:'';if(cur!==value)setP(parse(value))},[value]);// eslint-disable-line react-hooks/exhaustive-deps
 function set(k:'d'|'m'|'y',v:string){const n={...p,[k]:v};setP(n);if(n.y&&n.m&&n.d){const dt=new Date(Number(n.y),Number(n.m)-1,Number(n.d));onChange(dt.getMonth()===Number(n.m)-1?`${n.y}-${n.m.padStart(2,'0')}-${n.d.padStart(2,'0')}`:'')}else onChange('')}
 return <div className={s.dateGroup} role="group" aria-label={label}>
  <select aria-label={label+': gün'} required={required} value={p.d} onChange={e=>set('d',e.target.value)}><option value="">Gün</option>{Array.from({length:31},(_,i)=><option key={i} value={i+1}>{i+1}</option>)}</select>
  <select aria-label={label+': ay'} required={required} value={p.m} onChange={e=>set('m',e.target.value)}><option value="">Ay</option>{MONTHS.map((m,i)=><option key={m} value={i+1}>{m}</option>)}</select>
  <select aria-label={label+': il'} required={required} value={p.y} onChange={e=>set('y',e.target.value)}><option value="">İl</option>{years.map(y=><option key={y} value={y}>{y}</option>)}</select>
 </div>;
}
function Pager({page,onPage}:{page:Page<unknown>;onPage:(n:number)=>void}){return page.last_page>1?<div className={s.pager}><button type="button" disabled={page.current_page===1} onClick={()=>onPage(page.current_page-1)}>Əvvəlki</button><span>{page.current_page} / {page.last_page}</span><button type="button" disabled={page.current_page===page.last_page} onClick={()=>onPage(page.current_page+1)}>Növbəti</button></div>:null}
function Check(){return <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12l5 5L19 7"/></svg>}

export default function CompanyWorkspace(){
 const [company,setCompany]=useState<Company|null>(null),[brand,setBrand]=useState<Company>({name:'',signature:'',color:'#a3122f'}),[loaded,setLoaded]=useState(false),[tab,setTab]=useState('campaigns'),[error,setError]=useState(''),[notice,setNotice]=useState(''),[busy,setBusy]=useState(false);
 const [people,setPeople]=useState<Page<Person>|null>(null),[personPage,setPersonPage]=useState(1),[search,setSearch]=useState(''),[person,setPerson]=useState(blankPerson),[personId,setPersonId]=useState<number|null>(null),[personOpen,setPersonOpen]=useState(false);
 const [campaigns,setCampaigns]=useState<Page<Campaign>|null>(null),[campaignPage,setCampaignPage]=useState(1),[draft,setDraft]=useState(blankCampaign),[campaignId,setCampaignId]=useState<number|null>(null),[campaignOpen,setCampaignOpen]=useState(false),[products,setProducts]=useState<Product[]>([]),[picked,setPicked]=useState<Product|null>(null),[productSearch,setProductSearch]=useState('');
 async function loadCompany(){const d=await api('company');setCompany(d.company);if(d.company)setBrand(d.company);setLoaded(true)}
 async function loadPeople(){setPeople(await api('company/people?page='+personPage+'&q='+encodeURIComponent(search)))}
 async function loadCampaigns(){setCampaigns(await api('company/campaigns?page='+campaignPage))}
 useEffect(()=>{const requested=new URLSearchParams(location.search).get('tab');if(requested&&['people','brand','campaigns'].includes(requested))setTab(requested);loadCompany().catch(e=>{setError(e.message);setLoaded(true)})},[]);
 useEffect(()=>{if(company)loadPeople().catch(e=>setError(e.message))},[company,personPage,search]);// eslint-disable-line react-hooks/exhaustive-deps
 useEffect(()=>{if(company)loadCampaigns().catch(e=>setError(e.message))},[company,campaignPage]);// eslint-disable-line react-hooks/exhaustive-deps
 useEffect(()=>{if(!campaignOpen)return;const timer=setTimeout(()=>{api('catalog?q='+encodeURIComponent(productSearch)).then(d=>setProducts(d.data)).catch(e=>setError(e.message))},250);return()=>clearTimeout(timer)},[campaignOpen,productSearch]);
 async function run(action:()=>Promise<void>,done='Saxlanıldı.'){setBusy(true);setError('');setNotice('');try{await action();setNotice(done)}catch(e){setError((e as Error).message)}finally{setBusy(false)}}
 function saveBrand(e:FormEvent){e.preventDefault();run(async()=>{await api('company','PUT',{name:brand.name,signature:brand.signature,color:brand.color});await loadCompany()},company?'Şirkət üslubu saxlanıldı.':'Şirkət sahəsi yaradıldı.')}
 function savePerson(e:FormEvent){e.preventDefault();run(async()=>{await api('company/people'+(personId?'/'+personId:''),personId?'PUT':'POST',{...person,birthday:person.birthday||null,email:person.email||null});setPersonOpen(false);setPerson(blankPerson);await loadPeople();await loadCompany()},personId?'Məlumatlar yeniləndi.':'Şəxs əlavə edildi.')}
 function saveCampaign(e:FormEvent){e.preventDefault();if(!draft.date){setError('Planın tarixini seçin.');return}run(async()=>{await api('company/campaigns'+(campaignId?'/'+campaignId:''),campaignId?'PUT':'POST',{title:draft.title,date:draft.date,occasion:draft.occasion,budget_minor:Math.round(Number(draft.budget||0)*100),message:draft.message,status:draft.status,product_id:draft.product_id?Number(draft.product_id):null,people:draft.people});setCampaignOpen(false);await loadCampaigns();await loadCompany()},'Plan saxlanıldı.')}
 async function edit(c:Campaign){await run(async()=>{const d=await api('company/campaigns/'+c.id);setCampaignId(c.id);setDraft({title:d.title,date:d.date,occasion:d.occasion,budget:String(d.budget_minor/100),message:d.message||'',status:d.status,product_id:d.product_id?String(d.product_id):'',people:d.people.map((p:Person)=>p.id)});setPicked(d.product||null);setCampaignOpen(true);scrollTo({top:0})},'')}
 const openNew=()=>{setDraft(blankCampaign);setCampaignId(null);setPicked(null);setProductSearch('');setCampaignOpen(true);setNotice('')};
 const year=new Date().getFullYear();

 const brandForm=<div className={s.brandLayout}>
  <form className={s.card} onSubmit={saveBrand}>
   <h2>{company?'Şirkət üslubu':'Şirkətinizi qeyd edin'}</h2>
   <p className={s.cardIntro}>{company?'Kartlarda görünən ad, imza və rəng.':'Ad və rəng bir dəfə yazılır, bütün təbrik kartları bu üslubda çıxır.'}</p>
   <label className={s.well}><span>Şirkətin adı</span><input required maxLength={120} placeholder="Məsələn, Nümunə MMC" value={brand.name} onChange={e=>setBrand({...brand,name:e.target.value})}/></label>
   <label className={s.well}><span>Kart imzası</span><input maxLength={200} placeholder="Komandamız adından" value={brand.signature} onChange={e=>setBrand({...brand,signature:e.target.value})}/></label>
   <fieldset className={s.swatchSet}><legend>Şirkət rəngi</legend><div>{[...palette,...(palette.includes(brand.color.toLowerCase())?[]:[brand.color])].map(c=><button key={c} type="button" aria-label={'Rəng '+c} aria-pressed={brand.color.toLowerCase()===c.toLowerCase()} className={brand.color.toLowerCase()===c.toLowerCase()?s.swatchOn:s.swatch} style={{background:c}} onClick={()=>setBrand({...brand,color:c})}>{brand.color.toLowerCase()===c.toLowerCase()&&<Check/>}</button>)}<label className={s.customColor}>Başqa rəng<input type="color" value={brand.color} onChange={e=>setBrand({...brand,color:e.target.value})}/></label></div></fieldset>
   <button className={s.primaryWide} disabled={busy}>{company?'Üslubu saxla':'Şirkət sahəsini yarat'}</button>
  </form>
  <div className={s.previewWrap}>
   <figure className={s.companyCard} style={{background:brand.color,color:ink(brand.color)}}><span className={s.ccName}>{brand.name||'Şirkətinizin adı'}</span><p className={s.ccTo}>Nigar, ad günün mübarək!</p><p>Komandamızın bir parçası olduğun üçün sağ ol. Yeni yaşın uğurlu və sevincli olsun.</p><figcaption>{brand.signature||'Komandamız adından'}</figcaption></figure>
   <p className={s.sample}>Nümunə: kart belə görünəcək</p>
  </div>
 </div>;

 const head=<header className={s.head}>
  <div><h1>{company?.name||'Şirkət sahəsi'}</h1><p>{company?`${company.people_count??0} nəfər, ${company.campaigns_count??0} plan`:'Əməkdaşların və müştərilərin özəl günləri bir planda.'}</p></div>
  {company&&<nav className={s.tabs} aria-label="Şirkət bölmələri">{[['campaigns','Planlar'],['people','İnsanlar'],['brand','Üslub']].map(([key,label])=><button key={key} type="button" aria-pressed={tab===key} className={tab===key?s.tabOn:s.tab} onClick={()=>{setTab(key);setCampaignOpen(false);setPersonOpen(false);setNotice('');setError('')}}>{label}</button>)}</nav>}
 </header>;

 const product=picked||products.find(p=>String(p.id)===draft.product_id)||null;
 const total=product&&product.price_minor!==null?product.price_minor*draft.people.length:null,budget=Math.round(Number(draft.budget||0)*100);
 const editor=company&&<form className={s.editor} onSubmit={saveCampaign}>
  <div className={s.editorMain}>
   <div className={s.card}>
    <div className={s.editorHead}><h2>{campaignId?'Plana düzəliş':'Yeni təbrik planı'}</h2><button type="button" className={s.textBtn} onClick={()=>setCampaignOpen(false)}>Ləğv et</button></div>
    <label className={s.well}><span>Planın adı</span><input required maxLength={120} placeholder="Məsələn, Noyabr ad günləri" value={draft.title} onChange={e=>setDraft({...draft,title:e.target.value})}/></label>
    <div className={`${s.twoCol} ${s.dateCol}`}>
     <div className={s.well}><span>Tarix</span><DateSelect label="Tarix" required value={draft.date} years={[year,year+1,year+2]} onChange={v=>setDraft(d=>({...d,date:v}))}/></div>
     <label className={s.well}><span>Ümumi büdcə, AZN</span><input type="number" inputMode="decimal" min="0" step="0.01" max="1000000" required placeholder="200" value={draft.budget} onChange={e=>setDraft({...draft,budget:e.target.value})}/></label>
    </div>
    <div className={s.fieldRow}><span className={s.fieldLabel}>Münasibət</span><div className={s.occChips}>{Object.entries(site.occasions).map(([k,v])=><button type="button" key={k} aria-pressed={draft.occasion===k} className={draft.occasion===k?s.chipOn:s.chip} onClick={()=>setDraft({...draft,occasion:k})}><img src={`/concepts/occasions/${occIcon[k]}.png`} alt="" width="22" height="22"/>{v}</button>)}</div></div>
    <div className={s.fieldRow}><span className={s.fieldLabel}>Vəziyyət</span><div className={s.occChips}>{statuses.map(([k,v])=><button type="button" key={k} aria-pressed={draft.status===k} className={draft.status===k?s.chipOn:s.chip} onClick={()=>setDraft({...draft,status:k})}>{v}</button>)}</div></div>
   </div>

   <fieldset className={s.card}>
    <legend className={s.legend}>Kimləri təbrik edirsiniz? <b>{draft.people.length} seçilib</b></legend>
    <label className={s.search}><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M20 20l-4-4"/></svg><input aria-label="Adla axtar" placeholder="Adla axtar" value={search} onChange={e=>{setSearch(e.target.value);setPersonPage(1)}}/></label>
    {people&&!people.total&&!search?<p className={s.inlineEmpty}>Hələ heç kim yoxdur. Əvvəlcə <button type="button" className={s.textBtn} onClick={()=>{setTab('people');setCampaignOpen(false);setPersonOpen(true)}}>insanları əlavə edin</button>.</p>:
    <div className={s.pickList}>{people?.data.map(p=>{const on=draft.people.includes(p.id);return <label key={p.id} className={on?s.pickOn:s.pick}><input type="checkbox" checked={on} onChange={e=>setDraft(d=>({...d,people:e.target.checked?[...d.people,p.id]:d.people.filter(id=>id!==p.id)}))}/><span className={s.box}>{on&&<Check/>}</span><span className={s.pickName}><b>{p.name}</b><small>{p.department||(p.kind==='employee'?'Əməkdaş':'Müştəri')}{p.birthday?', '+pretty(p.birthday):''}</small></span></label>})}</div>}
    {people&&<Pager page={people} onPage={setPersonPage}/>}
    <p className={s.fine}>Bir planda ən çox 200 alıcı seçilə bilər.</p>
   </fieldset>

   <div className={s.card}>
    <h2 className={s.cardTitle}>Hədiyyə</h2>
    {product?<div className={s.pickedProduct}><span className={s.thumb}><GiftPhoto product={product}/></span><span className={s.pickName}><b>{clean(product.title)}</b><small>{product.store}{product.price_minor!==null?', '+money(product.price_minor):''}</small></span><button type="button" className={s.textBtn} onClick={()=>{setPicked(null);setDraft({...draft,product_id:''})}}>Dəyiş</button></div>:<>
     <label className={s.search}><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M20 20l-4-4"/></svg><input aria-label="Hədiyyə axtar" placeholder="Hədiyyə axtar: dinamik, qəhvə..." value={productSearch} onChange={e=>setProductSearch(e.target.value)}/></label>
     <div className={s.productList}>{products.slice(0,6).map(p=><button type="button" key={p.id} className={s.productRow} onClick={()=>{setPicked(p);setDraft({...draft,product_id:String(p.id)})}}><span className={s.thumb}><GiftPhoto product={p}/></span><span className={s.pickName}><b>{clean(p.title)}</b><small>{p.store}</small></span><strong>{p.price_minor!==null?money(p.price_minor):'Mağazada'}</strong></button>)}{!products.length&&<p className={s.inlineEmpty}>Uyğun hədiyyə tapılmadı.</p>}</div>
     <p className={s.fine}>Hədiyyəni sonra da seçə bilərsiniz.</p></>}
   </div>

   <div className={s.card}>
    <div className={s.editorHead}><h2 className={s.cardTitle}>Təbrik mətni</h2><a className={s.textLink} href={'/wishes?occasion='+draft.occasion} target="_blank" rel="noopener">Mətni Wisher ilə yazın</a></div>
    <textarea className={s.message} aria-label="Təbrik mətni" rows={5} maxLength={2000} placeholder="Məsələn: Ad günün mübarək! Komandamızın bir parçası olduğun üçün sağ ol." value={draft.message} onChange={e=>setDraft({...draft,message:e.target.value})}/>
   </div>
  </div>

  <aside className={s.editorSide}>
   <figure className={s.companyCard} style={{background:company.color,color:ink(company.color)}}><span className={s.ccName}>{company.name}</span><p className={draft.message?'':s.ccPlaceholder}>{draft.message||'Təbrik mətni burada görünəcək.'}</p><figcaption>{company.signature}</figcaption></figure>
   <button type="button" className={s.outlineWide} disabled={!draft.message.trim()} onClick={()=>downloadPng(draft.message,company.signature,'custom',{bg:company.color,title:company.name})}>Şirkət kartını PNG endir</button>
   <div className={s.summary}>
    <div><span>Alıcılar</span><b>{draft.people.length} nəfər</b></div>
    <div><span>Hədiyyələr cəmi</span><b>{total!==null?money(total):'Seçilməyib'}</b></div>
    <div><span>Büdcə</span><b>{budget?money(budget):'Yazılmayıb'}</b></div>
    {total!==null&&budget>0&&<><div className={s.bar} aria-hidden="true"><i style={{width:Math.min(100,Math.round(total/budget*100))+'%',background:total>budget?'#a3122f':undefined}}/></div><p className={total>budget?s.over:s.fine}>{total>budget?'Seçim büdcəni '+money(total-budget)+' aşır.':'Büdcədə '+money(budget-total)+' qalır.'} Çatdırılma daxil deyil.</p></>}
   </div>
   <button className={s.primaryWide} disabled={busy||draft.people.length>200}>{busy?'Saxlanılır...':'Planı saxla'}</button>
   <p className={s.fine}>Planı saxlamaq mesaj göndərmir və sifariş yaratmır.</p>
  </aside>
 </form>;

 const campaignList=<>
  <div className={s.toolbar}><h2>Təbrik planları</h2><button type="button" className={s.primary} onClick={openNew}>Yeni plan</button></div>
  {campaigns&&!campaigns.total?<div className={s.empty}><img src="/concepts/occasions/birthday_cake.png" alt="" width="88" height="88"/><h3>İlk özəl günü planlaşdırın.</h3><p>{company?.people_count?'Tarixi, alıcıları və büdcəni seçin.':'Əvvəlcə insanları əlavə edin, sonra alıcıları və büdcəni seçin.'}</p><button type="button" className={s.primary} onClick={company?.people_count?openNew:()=>{setTab('people');setPersonOpen(true)}}>{company?.people_count?'Yeni plan':'İnsanları əlavə et'}</button></div>:
  <div className={s.plans}>{campaigns?.data.map(c=>{const [y,m,d]=c.date.split('-').map(Number);return <article key={c.id} className={s.plan}>
   <span className={s.date}><b>{d}</b>{SHORT[m-1]} {y!==year?y:''}</span>
   <div className={s.planBody}><h3>{c.title}</h3><p><img src={`/concepts/occasions/${occIcon[c.occasion]||'wrapped_gift'}.png`} alt="" width="20" height="20"/><span>{site.occasions[c.occasion as keyof typeof site.occasions]}, {c.people_count} alıcı, {money(c.budget_minor)} büdcə</span></p>{c.product&&<a href={'/gifts/'+c.product.id} className={s.planGift}>{clean(c.product.title)}</a>}</div>
   <span className={c.status==='planned'?s.statusOn:s.status}>{statuses.find(x=>x[0]===c.status)?.[1]}</span>
   <div className={s.planActions}><button type="button" className={s.outline} onClick={()=>edit(c)}>Planı aç</button><button type="button" className={s.textBtn} disabled={busy} onClick={()=>{if(confirm('Bu planı silmək istəyirsiniz?'))run(async()=>{await api('company/campaigns/'+c.id,'DELETE');await loadCampaigns();await loadCompany()},'Plan silindi.')}}>Sil</button></div>
  </article>})}{!campaigns&&<p className={s.fine} role="status">Yüklənir...</p>}</div>}
  {campaigns&&<Pager page={campaigns} onPage={setCampaignPage}/>}
 </>;

 const peopleTab=<>
  <div className={s.toolbar}><h2>İnsanlar</h2><label className={s.search}><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M20 20l-4-4"/></svg><input aria-label="Adla axtar" placeholder="Adla axtar" value={search} onChange={e=>{setSearch(e.target.value);setPersonPage(1)}}/></label><button type="button" className={s.primary} onClick={()=>{setPersonId(null);setPerson(blankPerson);setPersonOpen(true)}}>Şəxs əlavə et</button></div>
  {personOpen&&<form className={`${s.card} ${s.personForm}`} onSubmit={savePerson}>
   <div className={s.editorHead}><h2>{personId?'Məlumatlara düzəliş':'Yeni şəxs'}</h2><button type="button" className={s.textBtn} onClick={()=>setPersonOpen(false)}>Ləğv et</button></div>
   <div className={s.twoCol}>
    <label className={s.well}><span>Ad və soyad</span><input required maxLength={100} placeholder="Məsələn, Nigar Əliyeva" value={person.name} onChange={e=>setPerson({...person,name:e.target.value})}/></label>
    <label className={s.well}><span>Şöbə</span><input maxLength={80} placeholder="Məsələn, Marketinq" value={person.department} onChange={e=>setPerson({...person,department:e.target.value})}/></label>
    <label className={s.well}><span>E-poçt</span><input type="email" maxLength={255} placeholder="ad@example.com" value={person.email} onChange={e=>setPerson({...person,email:e.target.value})}/></label>
    <div className={s.well}><span>Doğum tarixi</span><DateSelect label="Doğum tarixi" value={person.birthday} years={Array.from({length:70},(_,i)=>year-15-i)} onChange={v=>setPerson(p=>({...p,birthday:v}))}/></div>
   </div>
   <div className={s.fieldRow}><span className={s.fieldLabel}>Kimdir</span><div className={s.occChips}>{[['employee','Əməkdaş'],['customer','Müştəri']].map(([k,v])=><button type="button" key={k} aria-pressed={person.kind===k} className={person.kind===k?s.chipOn:s.chip} onClick={()=>setPerson({...person,kind:k})}>{v}</button>)}</div></div>
   <button disabled={busy} className={s.primary}>{personId?'Yadda saxla':'Əlavə et'}</button>
  </form>}
  {people&&!people.total?<div className={s.empty}><img src="/concepts/occasions/balloon.png" alt="" width="88" height="88"/><h3>{search?'Bu adla heç kim tapılmadı.':'İlk əməkdaşı və ya müştərini əlavə edin.'}</h3><p>Ad, şöbə və doğum tarixi kifayətdir.</p>{!personOpen&&!search&&<button type="button" className={s.primary} onClick={()=>{setPersonId(null);setPerson(blankPerson);setPersonOpen(true)}}>Şəxs əlavə et</button>}</div>:
  <div className={s.people}>{people?.data.map(p=><article key={p.id} className={s.personRow}><span className={s.avatar} aria-hidden="true">{p.name.charAt(0)}</span><span className={s.pickName}><b>{p.name}</b><small>{p.department||(p.kind==='employee'?'Əməkdaş':'Müştəri')}{p.department?', '+(p.kind==='employee'?'əməkdaş':'müştəri'):''}</small></span><span className={s.bday}>{p.birthday?<><img src="/concepts/occasions/birthday_cake.png" alt="" width="20" height="20"/>{pretty(p.birthday)}</>:<i>Tarix yoxdur</i>}</span><span className={s.rowActions}><button type="button" className={s.textBtn} onClick={()=>{setPersonId(p.id);setPerson({...blankPerson,...p,email:p.email||'',birthday:p.birthday||''});setPersonOpen(true);scrollTo({top:0,behavior:'smooth'})}}>Düzəliş</button><button type="button" className={s.textBtn} disabled={busy} onClick={()=>{if(confirm('Bu şəxsi silmək istəyirsiniz?'))run(async()=>{await api('company/people/'+p.id,'DELETE');await loadPeople();await loadCompany()},'Şəxs silindi.')}}>Sil</button></span></article>)}</div>}
  {people&&<Pager page={people} onPage={setPersonPage}/>}
 </>;

 return <main className={`${home.root} ${s.page}`}>
  {head}
  {error&&<p role="alert" className={s.error}>{error}</p>}
  {notice&&<p role="status" className={s.notice}>{notice}</p>}
  {!loaded?<p role="status" className={s.fine}>Yüklənir...</p>:!company?brandForm:tab==='brand'?brandForm:tab==='people'?peopleTab:campaignOpen?editor:campaignList}
 </main>;
}
