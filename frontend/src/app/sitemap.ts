import type {MetadataRoute} from 'next';
export default function sitemap():MetadataRoute.Sitemap {
 if(process.env.SITE_INDEXABLE!=='true')return [];
 return ['','/gifts','/wishes','/companies','/about','/faq','/privacy','/terms'].map(path=>({url:'https://wisher.az'+path}));
}
