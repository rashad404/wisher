# Wisher design decisions
Follows the product-design skill. Only product-specific choices here.

- Personality: thoughtful = named greetings and remembered dates; expressive = large serif headlines and pomegranate surfaces; practical = real prices, simple forms and explicit retailer links.
- Palette: canvas #ffffff, text #1d1416, muted #5f5357, brand #a3122f (hero, identity and greeting cards), action #0f6b4f (primary actions and approved closing surface), highlight #ffbd52 (candle flame only), success #0f6b4f, error #a3122f. Selection uses ink; quiet section tint #fbf7f8. The approved closing reverses the red/green pairing for contrast.
- Typography: text Manrope 400/500/600/700/800; display Fraunces 600/700 for headings and card signatures. Azerbaijani and Cyrillic text coverage; serif fallback where needed. Desktop h1 clamp(38px,5.4vw,68px), body 16px, secondary 13px minimum, tabular prices.
- Hero: split pomegranate stage because remembering someone is personal and the result should be tangible.
- Product moment: a named birthday greeting beside a real priced gift. Synthetic example visibly labelled Nümunə.
- Signature detail: candle forming the i in wisher; faint flame repeat on approved red hero and green closing; slightly tilted greeting stationery.
- Imagery: actual catalog products and the approved licensed occasion object family in public/concepts/occasions. No stock people or invented social proof.
- Voice: warm, spoken Azerbaijani; core terms Hədiyyələr, Təbriklər, Özəl günlər, Yadda saxla. Copy remains draft pending owner review. Purchases happen at the retailer; reminders currently appear inside Wisher.
- Shapes: buttons 12-14px, cards 16-20px, pills for filters and the countdown. Shadows only on raised stationery; flat controls.
- Approved versions: 2026-11-13 concept D home, candle-i variant 2, flame-only favicon, faint flame backgrounds. Original code preserved at frontend/src/app/az/concepts/d; review screenshots at docs/screenshots/apply-design/approved-*.png.
- Rejected and why: earlier Archivo/IBM Plex pairing, black hero, gold actions, rust and beige looked like a copied template. LEGO Flowers in Watering Can must never be featured (owner: looks like an aftafa).

Home conversion: discover a suitable gift, with greeting and saved occasion as connected journeys. Browsing is free; retailer prices are shown, with no Wisher checkout. Gifts conversion: open a suitable product detail and then visit the retailer. Its desktop first screen is the next approval checkpoint; no new lower sections or mobile redesign until approved.
