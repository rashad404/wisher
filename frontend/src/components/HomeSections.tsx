import Link from 'next/link';
import FeaturedGifts from './FeaturedGifts';
import {Icon} from './HomeOpening';
import {homeContent as t} from '@/messages/opening';
import {site} from '@/messages/site';
export default function HomeSections(){return <div className="home-sections counter-home">
 <section className="gift-finder"><h2>{t.finderTitle}</h2><form action="/gifts"><label>{t.recipient}<select name="recipient" aria-label={t.recipient}><option value="">{t.any}</option>{Object.entries(site.recipients).map(([value,label])=><option key={value} value={value}>{label}</option>)}</select></label><label>{t.occasion}<select name="occasion" aria-label={t.occasion}><option value="">{t.any}</option>{Object.entries(site.occasions).map(([value,label])=><option key={value} value={value}>{label}</option>)}</select></label><label>{t.budget}<select name="max" aria-label={t.budget}><option value="">{t.noLimit}</option>{[50,100,200].map((v,i)=><option key={v} value={v}>{t.budgets[i]}</option>)}</select></label><button type="submit">{t.search}<Icon name="arrow"/></button></form></section>
 <FeaturedGifts/>
 <div className="home-tools"><section><div className="tool-heading"><Icon name="calendar"/><h2>{t.calendarTitle}</h2></div><p>{t.calendarIntro}</p><Link href="/user/occasions" className="text-action">{t.calendarAction}<Icon name="arrow"/></Link></section><section><div className="tool-heading"><Icon name="business"/><h2>{t.companyTitle}</h2></div><p>{t.companyIntro}</p><Link href="/companies" className="text-action">{t.companyAction}<Icon name="arrow"/></Link></section></div>
 <section className="purchase-explainer"><div><h2>{t.purchaseTitle}</h2><p>{t.purchaseText}</p></div><Link href="/faq" className="text-action">{t.purchaseLink}<Icon name="arrow"/></Link></section>
 </div>}
