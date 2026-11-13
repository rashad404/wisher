import type {MetadataRoute} from 'next';
export default function robots():MetadataRoute.Robots {
 return process.env.SITE_INDEXABLE==='true'?{rules:{userAgent:'*',allow:'/',disallow:['/user','/api/','/az/auth/','/en/auth/','/ru/auth/','/az/concepts/','/concepts/']},sitemap:'https://wisher.az/sitemap.xml'}:{rules:{userAgent:'*',disallow:'/'}};
}
