# Wisher candle-i logo result

Review URL: http://100.89.150.50:3022/concepts/candle-logo.html

Four numbered variations are ready for Rashad to compare. No variation has been selected or installed.

1. Quiet serif: compact serif stem at approximately the x-height, with a single-color flame.
2. Birthday candle: taller, broader wax stem with a warm amber flame and no wick.
3. Fine wick: narrow stem, small wick and slightly leaning amber flame.
4. Soft wax: broader, taller stem, shallow wax dip and a white asymmetric flame with a wick.

## Artwork and exports

Every variant includes its own folder at frontend/public/concepts/candle-logo/v1/ through v4/:

- wordmark-red.svg: outlined wordmark for white backgrounds.
- wordmark-white.svg: outlined wordmark for the pomegranate header.
- app-icon.svg: square master with an opaque #a3122f background.
- app-icon-1024.png: 1024 x 1024 app icon.
- apple-touch-icon.png: 180 x 180 Apple touch icon.
- favicon-16.png, favicon-32.png, favicon-48.png: actual-size raster favicons.
- favicon.svg: deliberately simplified, pixel-scale SVG favicon.
- favicon-detail.svg: intermediate optical master for 32 and 48 px exports.
- favicon.ico: 16, 32 and 48 px images in one ICO container.
- assets.zip: all the above plus the Fraunces and Manrope license notices.

The wordmarks contain vector paths only, including the .az. Fraunces was instantiated at weight 700, optical size 48, softness 30 and WONK 1, then outlined. The domain suffix uses outlined Manrope 600. These are licensed typeface outlines with original candle drawing and adjusted spacing, not a claim that the base typefaces were newly invented.

The custom i occupies a 37-unit advance. Its stem widths are 21, 23, 20 and 24 units, respectively; all share the baseline at 108. Stem tops at 48, 43, 46 and 40 compare the ordinary i height with progressively taller wax shapes. The flame remains centered over the stem's optical center, with a slight tip lean in variants 3 and 4. The rest of the lettering is held constant so the comparison isolates the candle.

On red, amber is #ffbd52. On white it becomes #b96508 to remain visible. The single-color variants reverse white to brand red. No glow, gradient or raster effect is used; optional glow was omitted in accordance with the product-design rules.

The 16 px favicon uses a dedicated 4 px stem, a simplified flame and no wick or serif foot. Consequently variants 1/4 share the monochrome small-size drawing, while 2/3 share the amber small-size drawing. The larger artwork preserves each stem/flame treatment. The app and Apple images have no transparent corners or baked-in rounded mask; the illustrative phone applies its own mask.

## Review and checks

Read the brief and the complete product-design skill before drawing. Inspected the lead's wish-candle sketch, the previous nine-idea review and the approved concept D header. Initial reference captures at 1440 and 375 are in docs/screenshots/candle-logo/reference-*.png. Product context and repository constraints from the preceding rounds remain in effect.

The review page shows each variant on red and white, at a real header size of 156 px wide, with actual-size 16/32/48 px icons and a phone home-screen mockup. Phone screens are labeled illustrations, not claims of an installed app or native build. Only the Wisher icon artwork is product-specific; the other phone tiles are neutral placeholders.

Rendered and visually inspected all four variants at 1440 and 375. Evidence:

- docs/screenshots/candle-logo/review-1440-first.png
- docs/screenshots/candle-logo/review-1440-full.png
- docs/screenshots/candle-logo/review-375-first.png
- docs/screenshots/candle-logo/review-375-full.png
- docs/screenshots/candle-logo/variant-{1,2,3,4}-{1440,375}.png
- docs/evidence/candle-logo/verification.json
- docs/evidence/candle-logo/export-checks.json

Browser checks passed: all images load, all header samples render at 156 px, no horizontal overflow, no review text below 12.5px, all links at least 44 x 44px, downloadable variant archives return successfully, and no page errors. All browser contexts blocked analytics before navigation, including Google Analytics/Tag Manager, DoubleClick, Facebook and common analytics providers.

Export checks passed: all raster dimensions, opaque icon backgrounds, the three ICO sizes, valid SVG XML, and no text/image/filter/script/gradient elements in vector files. The 16 px artwork and small header marks were inspected visually. Brand artwork is intentionally shown at actual small sizes, including the subordinate .az, rather than enlarged to the review-copy size floor.

This is an internal comparison page. Repeated specimen layouts serve a fair comparison; the page asks for a choice by number and does not add customer-facing sales sections. The review has no account, form, payment, persistence or asynchronous data states. No live analytics collector is installed. Native-device installation and trademark clearance were not performed.

## Reproduction and scope

- docs/evidence/candle-logo/build.py creates the path masters.
- scripts/render-candle-icons.cjs rasterizes those masters in local Chrome.
- docs/evidence/candle-logo/review.py packages ICO/ZIP files and writes the review HTML.
- scripts/check-candle-logo.cjs checks the rendered review and captures screenshots.

No new npm packages, app build, paid API calls, image generation, backend changes or database tests were needed. No existing site header, favicon, approved page, or earlier proposal was replaced. Only standalone review assets, evidence, scripts and an appended design record were added. Work is committed locally; no push or deployment.
