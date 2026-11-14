# Wisher SEO result

Released to https://wisher.az on 2026-11-14 from GitHub branch `v2`. The final release is `f25070776af813070aa88ef4ff2f257c7640f2ec`, on port 3023. The previous release `59835528...` is still running on 3022 for rollback.

## Correction to the brief

The brief assumed az, en and ru versions under `/az`, `/en` and `/ru`. The live site has only one language: Azerbaijani, at the root (`/`, `/gifts`, `/wishes`). `/en` and `/ru` return 404, and `/az` was a duplicate of the home page. So every page now declares hreflang `az` plus `x-default`, both pointing at itself, and `/az` permanently redirects (308) to `/`. English and Russian versions were not built. That is a product decision, and it would need full translations. The keyword data shows Russian demand for Azerbaijani-language greetings, so a Russian section is a reasonable next step if the owner wants one.

## What changed

- **New greeting pages**, all server-rendered:
  - a hub at `/tebrikler`
  - 8 occasion pages: `ad-gunu`, `anaya`, `sevgiliye`, `toy`, `novruz`, `yeni-il`, `8-mart`, `muellime`

  Together they carry 74 example greetings, grouped by recipient and tone, each with a Köçür (copy) button. Each page also has:
  - a builder section that opens the real Wisher composer, with the occasion filled in
  - gift and reminder links
  - a FAQ with FAQPage JSON-LD
  - BreadcrumbList JSON-LD
  - tiles linking to the other occasions

  The design reuses the approved home building blocks: red flame hero, striped greeting card, leaf button, tinted builder section, occasion tiles and FAQ accordions. Copy is draft Azerbaijani pending owner review. Only real features are described, and there are no reviews or numbers.
- **Metadata** (`frontend/src/lib/seo.ts`):
  - every public page has its own title (60 characters or fewer) and description (155 or fewer), with no duplicates
  - absolute canonical URLs and hreflang
  - Open Graph and Twitter tags with a new 1200x630 `/og.png`; gift pages use their product photo instead
  - `htmlLimitedBots` puts the metadata in `<head>` for every visitor, where Next would otherwise stream it into the body
- **Structured data**:
  - every page: Organization, plus WebSite with a SearchAction that points at the real `/gifts?q=` search
  - inner pages: BreadcrumbList
  - FAQPage on `/faq`, the hub and each occasion page
  - Product with an Offer on gift pages (price, AZN, availability, the store as seller)
  - validator.schema.org reported 0 errors and 0 warnings on the pages checked
- **Gift pages are now server-rendered** with the product data, and missing products return a real 404. Before, a missing product returned 200, because the content was loaded only in the browser. `/gifts` also server-renders its first product list. The "checked on" date is now formatted in Baku time, which fixed a hydration mismatch between server and browser.
- **Sitemap** (`/sitemap.xml`) has 22 URLs: the static pages, the hub, the 8 occasion pages and every active gift page. Each URL has a lastmod, and gift URLs use the date the price was last checked. The sitemap revalidates every 10 minutes. `robots.txt` was already correct (private, API, auth and concept paths are blocked) and is unchanged.
- **Manifest and icons**: `/manifest.webmanifest`, `icon-192.png`, `icon-512.png` and a theme colour were added.
- **Internal links**: the footer has a new "Təbriklər" column on every page. All 37 internal links found on the public pages return 200.
- **Performance**:
  - **gzip**: nginx served every response uncompressed, because the cPanel proxy strips `Accept-Encoding` and this vhost had no gzip. The new `deploy/nginx-gzip.conf` is added to the site include by `release.sh` (checked with `nginx -t`, and restored automatically if the release fails). The landing page HTML went from 61.7 KB to 10.8 KB on the wire, and the JS and CSS chunks shrank similarly.
  - **Image priority**: the product photo now loads first (eager, high fetch priority).
  - **Fonts**: the unused Cyrillic font file is no longer preloaded.

## Lighthouse, live, mobile, analytics blocked

| Page | Performance | Accessibility | Best practices | SEO | LCP |
|---|---|---|---|---|---|
| `/` | 100 | 100 | 96 | 100 | 1.1 s |
| `/gifts` | 100 | 100 | 96 | 100 | 1.3 s |
| `/tebrikler/ad-gunu` | 100 | 100 | 96 | 100 | 1.2 s |
| `/gifts/1` | 95 | 100 | 96 | 100 | 2.8 s |

Before the gzip fix, the same pages scored 76 to 96 for performance, and `/gifts/1` had an LCP of 5.8 s. The best-practices score of 96 comes from an existing console 401: the signed-out `auth/me` check fails for visitors who are not logged in. It is not an SEO issue and was left unchanged.

Evidence: [lighthouse](../evidence/seo-lighthouse.json), [screenshots 1440/375](../screenshots/seo/).

## Verification

- Backend tests passed: 27 tests, 153 assertions, in-memory SQLite. The TypeScript check and the production build passed.
- Live checks:
  - every sitemap URL returns 200, with `index, follow`, a canonical equal to its own URL, hreflang az and x-default equal to its own URL, one H1, no image without alt, and an og:image
  - `/gifts/99999`, `/tebrikler/x` and unknown paths return 404
  - `/user` sends `X-Robots-Tag: noindex`
- Browser pass of all new pages plus `/`, `/gifts`, `/gifts/1`, `/wishes` and `/faq` at 1440 and 375: no horizontal overflow and no page errors. Analytics was blocked.
- Google Fonts failed to download during the build twice, on two different releases. Each time the release stopped before switching traffic, and a retry of the same commit succeeded.

## Commits on v2

`f705c49` greeting pages and SEO, `7dba407` next-env path, `5983552` Baku date, `f250707` nginx gzip.

## Needs the owner

- **Search Console**: verify the property, submit `https://wisher.az/sitemap.xml`, and request indexing for `/tebrikler` and `/tebrikler/yeni-il`. Yeni il demand starts now.
- **Copy review**: proofread the 74 example greetings and the FAQ answers in `frontend/src/messages/greetings.ts`.
- **Yearly update**: change "2027" in the Yeni il title each November.
- **Language versions**: decide whether to add Russian or English pages.
- **Gift-idea pages**: decide whether to build pages such as "8 Marta hədiyyə" or "kişiyə hədiyyə" once the catalog has enough products. It has 5 today.
- **Contact address**: the FAQ and legal pages still show the `salam@example.com` placeholder.
