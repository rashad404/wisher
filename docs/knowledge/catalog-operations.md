# Catalog operations

## Current source

On 2026-11-12, six real product pages were imported from Baku Electronics using their public JSON-LD data. Fields include source title, image URL, short description, AZN price, availability and verification time. Refreshing all six succeeded. The source URLs are recorded in [import-sources.json](../evidence/catalog/import-sources.json); the first imported product is also listed below.

- https://bakuelectronics.az/mehsul/constructor-lego-botanicals-lucky-bamboo-5702017814650-235865
- https://bakuelectronics.az/mehsul/jbl-go-5-white-234124
- https://bakuelectronics.az/mehsul/constructor-lego-creator-flowers-in-watering-can-5702017585116-235869
- https://bakuelectronics.az/mehsul/tognana-coffee-maker-6-cups-grancucina-marble-nero-floatec-229130
- https://bakuelectronics.az/mehsul/instax-mini-liplay-nv-vn-ex-d-228609
- https://bakuelectronics.az/mehsul/ttec-recharger-pro-max-tft-20000mah-pd-65w-powerbank-with-built-in-usb-c-cable-234253

This is a small initial catalog, not an exhaustive store crawl or a commercial partnership. Category, recipient and occasion labels are Wisher editorial choices. Product information and images come from the retailer. No reviews, ratings or affiliate claims are copied into Wisher.

Ali & Nino failed DNS resolution on this machine, including Chrome. Kontakt returned an access challenge on its homepage. Neither was bypassed, and neither has active imported listings. Their names in the source allowlist do not claim an operational integration.

## Commands

From `backend`, with PHP 8.4:

- `php artisan catalog:add <https-product-url> --category=hobby --occasions=birthday,thanks --recipients=friend,family` fetches one reviewed product URL.
- `php artisan catalog:refresh --limit=20` refreshes an existing bounded batch, oldest verification first.
- `php artisan catalog:import <manifest.json>` atomically imports up to 500 reviewed records as unverified snapshots. It never silently marks file imports as live-checked.

The manifest schema is the validated input in `app/Services/CatalogImport.php`. Synthetic fixtures must use example.com and a test-only allowlist; real source URLs belong only to genuine catalog records.

## Boundaries

HTTPS host allowlist, public-IP validation and pinned DNS address; no redirects; robots fetched and conservatively checked before product fetch; timeouts and response-size limits; bounded batches and refresh lock; URL-hash deduplication. The operator decides which product URLs enter the catalog. A parse/network failure retains the previous snapshot and verification timestamp. A confirmed 404/410 marks a product unavailable. After two days without verification, the UI labels the price as needing confirmation.

Images are loaded from allowed retailer/CDN hosts and have a visible fallback. No upload, image proxy, or arbitrary server-side image fetching endpoint is exposed. Visitors purchase on the source website, which opens in a new tab. No external click is counted as a completed purchase.

The local scheduler refreshes admitted listings daily at 04:00 application time. Production cron, source arrangements, content review, and broader store onboarding remain launch work. Do not infer an affiliate agreement from a listing.
