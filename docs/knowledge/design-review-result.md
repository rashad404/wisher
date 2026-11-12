# Wisher design review and implementation

Date: 2026-11-12. Applies to the new application in wisher-new.

## Section 1 audit

| Pattern found | Implemented change |
| --- | --- |
| Predictable composition: category tiles, a three-step block and a closing banner | Homepage now answers what to choose, where to buy, how to keep dates, and how companies plan gifts. Real catalog products appear immediately after the opening. |
| Familiar styling bundle: purple actions, tinted surfaces, decorative shapes | Warm neutral canvas, charcoal text, rust actions and wheat selection highlights. Removed blur and decorative hero shapes. |
| Mechanical repetition: equal category and feature cards | Product cards remain for comparable products; purchasing information, occasions and company information use different layouts. |
| Interchangeable language: broad welcome and product promises | Headline names gifts and greetings. Copy explains retailer checkout, three editable greeting variants and in-app reminders. |
| Decorative product imagery: gift-box illustration and floating elements | Opening shows a consistent Aysel birthday example, personal detail, actual previously generated DeepSeek text and a working card download. |
| Uniform enthusiasm: competing colored panels and equally prominent calls to action | Gift discovery is primary, greeting creation secondary. Operational information uses quieter text and divided sections. |
| Invented proof | No invented reviews, counts, partnerships or testimonials were found or added. Retail products and prices come from the source. Personal names and dates in the opening are explicitly labeled examples. |
| Uneven completeness | Applied the palette and readable text sizes to public and private routes; checked mobile navigation, empty saved greetings, forms, catalog and full account workflows. |

## Preservation and provenance

- Previous sources and approved opening screenshots are backed up in `docs/evidence/design/before-design-review.tar.gz`.
- Early standalone prototypes are archived under `docs/evidence/design/early-prototype/`, outside the public web directory.
- The opening greeting reuses an existing successful DeepSeek response for Aysel, a school friend who shares a love of books. This design pass did not request new paid generation.
- The header uses a plain wordmark. No new illustrated logo or app-icon identity was commissioned.
- The offer is documented in `docs/roadmap.md`. Purchases happen on retailer websites. Wisher checkout and paid plans are not presented as available.

## Verification and limits

- Production build and TypeScript checks pass, with approximately 126 KB first-load route JavaScript.
- Browser journey passes catalog filters/detail, login return, wishlist, company people/campaign persistence, calendar/reminders, explicit sample greeting generation, saving, personal/company PNG exports and menu/Escape scroll restoration.
- Twenty route/viewport combinations checked at 375 and 1440 pixels without horizontal overflow or uncaught page errors. Separate design checks found no rendered text below 12.5px.
- Reviewed homepage desktop/mobile renders and mobile public/account layouts. Screenshots are under `docs/screenshots/revised-*` and `full-*`. Fixed bottom navigation appears at its viewport position in full-page images.
- Source scans cover application code, translations and migration/seed PHP for banned punctuation. Historical archives and the owner's source guidance are preserved verbatim.
- UI currently exists in Azerbaijani and light mode only. English/Russian UI and dark-theme screenshots are not claimed. Greeting output supports three languages.
- Copy remains a draft for Rashad's editorial review. Real Kimlik consent and production infrastructure remain separate verification items in the rebuild result.

- Computed foreground/background contrast checks across the 20 design route/viewport combinations found no text below 4.5:1. This flat-surface check is not a complete accessibility audit.
- Following owner feedback, removed the retailer-checkout sentence beneath the hero actions. Purchasing details remain in the dedicated section and product flow.
