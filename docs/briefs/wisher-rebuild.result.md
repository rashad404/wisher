# Wisher rebuild result

Date: 2026-11-12. Local first release, following the revised design guidance and corrected gift-shop direction. The future own-product business and production launch are not claimed complete.

## Preview

- New application: http://100.89.150.50:3022
- Gifts: http://100.89.150.50:3022/gifts
- Greetings: http://100.89.150.50:3022/wishes
- Companies: http://100.89.150.50:3022/companies
- Account: http://100.89.150.50:3022/user
- Backend: http://100.89.150.50:8022
- Old reference stays on http://100.89.150.50:8020

Use Kimlik or the explicitly labeled local sample account. Each sample account is isolated. Local demo access is forbidden outside the local environment. No production account was impersonated or created.

## Implemented

- New Laravel 12 backend and Next.js 15 / React 19 frontend in wisher-new, with its own Git repository.
- Revised product-led opening; full homepage, real featured gifts, occasion entry points, explanatory sections, shared header, right-hand desktop/full-screen mobile menu, persistent four-item mobile navigation, grouped footer, about/FAQ and local privacy/terms drafts.
- Gift catalog with text search, category, recipient, occasion, budget and sort controls; pagination, product detail, external retailer links and private wishlist. Products are not purchased on Wisher.
- Six real Baku Electronics products, imported and refreshed from public JSON-LD, with images, descriptions, AZN prices, source links, availability and verification times. No fake products, reviews or sales counters. Catalog is intentionally a small initial selection, not a store-wide crawl.
- Allowlisted operator commands for adding a source product, importing reviewed manifests and refreshing existing listings. Safe URL checks, public-IP validation, DNS pinning, no redirects, robots checks, bounded responses/batches, refresh lock, URL deduplication and stale-state display.
- Kimlik state/PKCE login, single-use exchange, verified identity linking, backend-only secrets and frontend httpOnly session. Return-to behavior preserves a gift/account destination after login.
- Personal dashboard, scoped contact CRUD/search, group labels, birthday-to-occasion entry, event CRUD, annual/monthly recurrence, month calendar, timezone preferences, in-app upcoming reminders and read state.
- DeepSeek text generation with recipient, relationship, occasion, tone, language, format and personal detail; three variants, editing, save, copy and three card styles with PNG download. No Gemini code. Explicit local sample mode is labeled and does not call DeepSeek.
- Saved greeting editing/deletion, personal gift wishlist, account preferences and logout.
- Company owner workspace: company name/signature/color, employee/customer records, departments and birthdays, campaign CRUD, searchable/paginated recipient selection, gift selection, total budget, cost estimate, draft/planned/archived states and branded card export. Campaigns do not automatically message recipients or purchase gifts.
- Hourly in-app reminder refresh and daily bounded catalog refresh schedule; local scheduler running, plus start/stop integration in only the Wisher.az (new) portfolio script block. Existing old Wisher block preserved.
- Complete 143-route legacy inventory with feature/data/verdict/reason, revised roadmap, migration plan only, catalog operator notes and README.

## Validation

- Frontend production build and TypeScript checks passed. First-load route JavaScript is approximately 126 KB according to Next's build report.
- 26 backend tests, 149 assertions, all on forced in-memory SQLite. Includes cross-owner isolation, private wishlist, company recipient ownership, invalid branding, catalog filters/pagination/URL validation/atomic import, calendar recurrence and leap days, reminder idempotency, Kimlik state/identity tests, generation idempotency, quotas and provider failure behavior.
- The existing synthetic 100k-user fixture verifies a bounded dashboard query count and an owner/date index. This is not proof of 100k concurrent users; production load testing remains required.
- Chrome end-to-end journey: real product filtering/detail, login return, wishlist persistence, company/person/campaign create and reopen, calendar/event/reminder, explicit sample greeting, save and PNG export, mobile menu/Escape and scroll restoration. Twenty responsive route checks at 375 and 1440 pixels found no horizontal overflow or page errors.
- Six live product imports and all six subsequent refreshes succeeded. Ali & Nino failed DNS; Kontakt served an access challenge. Neither was bypassed.
- DeepSeek had a successful live generation earlier in the rebuild after balance was added. This continuation used only explicit synthetic sample generation for browser QA and mocked provider calls in tests, not more paid generation.
- Kimlik authorization navigation was inspected earlier and exchange paths are covered by mocked tests. A complete real-user consent/login round trip still needs the user's signed-in Kimlik session; it is not claimed verified here.
- Disk checked before each install/build; more than 10 GB remained. No dependency installs or browser downloads were needed in this continuation.

## Screenshots

- [Homepage desktop](../screenshots/full-home-1440.png), [homepage mobile](../screenshots/full-home-375.png)
- [Catalog desktop](../screenshots/full-gifts-1440.png), [catalog mobile](../screenshots/full-gifts-375.png)
- [Account desktop](../screenshots/full-dashboard-1440.png), [account mobile](../screenshots/full-dashboard-375.png)
- [Calendar desktop](../screenshots/full-calendar-1440.png), [calendar mobile](../screenshots/full-calendar-375.png)
- [Company workspace desktop](../screenshots/full-company-1440.png), [company workspace mobile](../screenshots/full-company-375.png)
- [Mobile menu](../screenshots/full-menu-375.png), [greeting card](../screenshots/full-card.png), [company card](../screenshots/company-card.png)

Full-page mobile captures include the fixed bottom navigation at its viewport position. All Azerbaijani copy remains an editorial draft for Rashad's review.

## Explicit limits and next phase

- Initial store coverage is one functioning source and six products. Source expansion, editorial curation and any affiliate agreements are separate work. No partnership is implied.
- No Wisher checkout, payment, shipping tracking, actual order ledger or own products yet, as agreed for the initial retailer-linked model.
- No outbound email/SMS, recipient auto-send, group-money collection, video/voice hosting or AI image generation. Reminders are in-app; campaign status means planning status, not delivery status.
- Companies have one owner account in this release. Shared seats, invitations and delegated roles belong to the next company phase. Birthdays are stored in company records; automatic company campaigns are not implied.
- UI is Azerbaijani; greeting output supports Azerbaijani, English and Russian. Full translated UI and multilingual SEO are not implemented.
- Contact groups are simple labels; rich interest taxonomies and native address-book imports are deferred. The personal occasion limit is 1000 per account; company campaigns allow at most 200 selected recipients.
- Privacy/terms describe the local implementation and are labeled as drafts; launch policies, support contact and paid plans need owner review. No fabricated support address or pricing is published.
- Production infrastructure, HTTPS secure cookie configuration, shared cache/queues, scheduler supervisor, backup/restore, monitoring, migrations and load testing remain launch work. The local preview remains noindex.
- A separate image provider could be added behind an adapter later, for example OpenAI image generation, once a key and spending budget are approved. DeepSeek cannot generate images; current cards are typography and design.
- Legacy Twilio secret-returning route and tracked Nova auth.json remain separate remediation/rotation tasks for Rashad. Neither was recreated or called. No production secrets were rotated during this work.

## Decisions needed for launch

1. Confirm initial retailer/category priorities and any commercial/content arrangements.
2. Review Azerbaijani copy, policies, support ownership and free/paid limits.
3. Complete a real Kimlik sign-in review and remove the HTTP test callback before launch.
4. Supply approved messaging sender and payment/affiliate setup only when those later flows are prioritized.
5. Authorize production launch separately after infrastructure and security gates. No push, deployment, DNS change, production write or production migration was performed.

## Operations

See [README](../../README.md), [roadmap](../roadmap.md), [feature inventory](../feature-inventory.md), and [catalog operations](../knowledge/catalog-operations.md). Source changes and documentation are committed locally. Env files, SQLite, logs, runtime cache and credentials are ignored.

## Design revision

See [Section 1 audit and implementation](../knowledge/design-review-result.md). The previous opening was backed up before replacing decorative imagery with a labeled, downloadable greeting example and applying the neutral/rust palette across the application. [Revised desktop](../screenshots/revised-home-1440.png) and [revised mobile](../screenshots/revised-home-375.png).

## Direct Kimlik popup sign-in

Sign-in and protected navigation links now open Kimlik directly in a popup, following the interaction in sayt.az. The original page remains open; successful sign-in returns to the intended account or product destination. Existing server-side PKCE/state validation and httpOnly cookies remain in place. Messages are accepted only from the opened popup and the same origin. Blocked popups, cancellation, timeout and provider errors have retry feedback. Direct account URLs retain an access gate and local-only demo entry.

The real Kimlik sign-in screen was opened from the preview without submitting credentials. Browser tests mock the OAuth exchange to cover success, destination return, invalid message source, blocked popup, cancellation, provider errors and signed-in navigation. Real-user consent is still not claimed verified.
