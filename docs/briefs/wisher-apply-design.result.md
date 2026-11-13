# Apply approved Wisher design result

## Review and scope

Read the complete product-design skill and modern-vs-template.md before code. Wrote docs/design-review.md against every point in sections 3 and 4, and replaced the rejected brand decisions in docs/design.md. Concept D passes the confidence, tangible product, specificity and varied rhythm tests. Its gaps were placeholder interactions, undersized controls and mobile overflow.

Applied the approved pomegranate/Fraunces/Manrope home at both / and /az. Preserved the original concept D as the approved reference. Installed candle-i variant 2 in the shared header and footer, with the flame-only favicon and touch icon. The legacy logo asset now resolves to the flame. Added a white grouped footer in the same system. Shared navigation, account authentication interception and mobile menu remain functional.

Live catalog data drives the featured gifts and hero product price. Approved short editorial titles and local product images are retained. Hearts use the existing owner-scoped wishlist endpoint. Recipient links use the existing family/friend/child/colleague taxonomy; finer recipient distinctions remain future catalog work. Occasion links preserve their choice; occasions with no catalog matches show an honest empty state. The rejected watering-can LEGO is excluded from public catalog results and featured components, without deleting existing records or private saved items.

The reminder form validates the day/month, retains the name and date through Kimlik, then prefills the real yearly occasion editor for review and saving. It does not silently create records during login. February 29 uses a valid leap-year date. Greeting examples remain visibly labelled; the CTA opens the existing composer with the recipient prefilled, without paid generation during QA.

Small explicit corrections to the approved desktop: controls reach 44px, labels reach 13px, free-browsing wording no longer implies generation needs no account, and reminder wording accurately describes in-app reminders rather than automatic prepared gifts/messages. The sample builder CTA says it opens greeting preparation. Palette, flame pattern, hero composition and section order are retained.

Mobile home: 16px gutters, stacked card stage, two-column occasion and gift grids, stacked greeting cards and reminder form, reachable fixed navigation. No horizontal overflow at 375.

## Next approval checkpoint

/gifts is a desktop first-screen proposal only: white shopping surface, characterful heading, search/recipient/occasion/budget controls, real product row and prices. No new lower sections or mobile composition were designed. Stop here for Rashad's first-screen review, as required by step 3 of the brief.

## URLs

- Home: http://100.89.150.50:3022/
- Azerbaijani home alias: http://100.89.150.50:3022/az
- Gifts desktop first screen: http://100.89.150.50:3022/gifts
- Approved reference: http://100.89.150.50:3022/az/concepts/d

## Screenshots

All below were rendered and visually inspected. Full-page mobile captures show the fixed bottom navigation at the capture viewport's position; this is screenshot behavior, not an inline navigation bar.

- docs/screenshots/apply-design/home-1440.png
- docs/screenshots/apply-design/home-375.png
- docs/screenshots/apply-design/home-first-1440.png
- docs/screenshots/apply-design/home-first-375.png
- docs/screenshots/apply-design/footer-1440.png
- docs/screenshots/apply-design/footer-375.png
- docs/screenshots/apply-design/gifts-1440.png
- docs/screenshots/apply-design/az-1440.png
- docs/screenshots/apply-design/about-1440.png
- docs/screenshots/apply-design/about-375.png
- docs/screenshots/apply-design/approved-1440.png
- docs/screenshots/apply-design/approved-375.png

## Verification

- TypeScript check passed.
- Production build passed in isolated .next-verify output; checked disk first (16 GiB available). Removed only that generated directory afterward and restored Next's generated config edits.
- Backend GiftsAndCompaniesTest: 9 tests, 64 assertions passed, forced in-memory SQLite. Covers range filtering, watering-can exclusion, wishlist ownership, recurring reminders and existing company/catalog behavior.
- Browser checks: /, /az, /gifts desktop and shared shell on /about. No page errors, broken images or horizontal overflow at the tested widths. Favicon resolves to /icon.svg.
- Browser flow checks: wishlist success, invalid date rejection, reminder prefill and yearly occasion submission, live budget filtering, empty search, mobile menu open/close. All mutations intercepted with labelled test responses; no development records created.
- Separately mocked guest Kimlik start and success callback: name/date survived the popup round-trip. Real third-party login was not repeated.
- Analytics hosts blocked before every browser navigation. Actions emit local wisher:analytics/dataLayer events; no external tracking integration installed.
- No paid API calls, production writes, push or deploy. Azerbaijani copy remains pending owner review. Other page bodies retain their existing layouts pending their separate design rounds.

Evidence: docs/evidence/apply-design/visual-checks.json and flow-checks.json. Reproduction scripts: scripts/check-apply-design.cjs and scripts/check-apply-flows.cjs.
