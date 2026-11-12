# Wisher rebuild roadmap

Updated 2026-11-12 after product and opening-screen approval. This supersedes the earlier greeting-only and digital-only proposal. Build in wisher-new; old Wisher remains a reference. No production changes.

## Product and first release

Wisher helps individuals and companies celebrate people through occasions, personal greetings, and gift discovery. The loop is: save a person and occasion -> see a reminder -> find a suitable gift -> prepare a greeting -> purchase at the retailer and share the greeting -> return for the next occasion.

The first release includes the complete public homepage and shared navigation/footer, searchable and filterable external product catalog and detail pages, private gift wishlist, Kimlik account, contacts, recurring occasions/calendar, in-app reminders, greeting generation/edit/save/copy/download, and an owner-managed company workspace with people, branded campaign drafts, recipient selection and budget planning. Company drafts do not send messages or place orders. Outbound shop visits do not become order records.

Catalog collection uses explicit allowlisted sources, bounded product fetches, JSON-LD parsing, deduplication by source URL, timestamps, and unavailable/stale states. No broad unattended scraping until source behavior is verified. An operator can import a reviewed source manifest. Do not invent product availability or price. Live initial population depends on direct network access and usable retailer sources.

Local offer: gift discovery, personal tools and company planning currently have no checkout or paid plan. Retailer products are paid for at the retailer. Future premium limits and pricing are undecided and must not be advertised as available.

## Brand and UX

Design model: Sayt.az, as explicitly directed by Rashad. Do not use startup-design for Wisher. Use a full-width dark hero, centered white/peach headline, gold primary action, rust brand links/selection/search, pill controls and dense product surfaces. Show real gifts and prices alongside an example greeting. Self-host Archivo headings and IBM Plex Sans body/UI text. Retain the familiar header, mobile navigation and grouped footer. Read both design references before visual work. The previous split hero is backed up; see `docs/knowledge/sayt-redesign-result.md`.

## Phases and dependencies

| Phase | Scope | Estimated engineering effort | External dependencies |
| --- | --- | --- | --- |
| Foundation and first release | Public/private flows above, isolation tests, local previews and inventory | 12-20 person-days total, including existing work | Kimlik and DeepSeek credentials already supplied; actual retailer source access |
| Pilot readiness | Scheduled worker/cron, monitoring, backups, reviewed legal/copy, merchant content arrangements, production benchmark and rollback rehearsal | 4-8 days | Rashad's source choices, production infrastructure, editorial/legal review and deployment authorization |
| Delivery and revenue | Owner SMS/email reminders and optional recipient/company greeting delivery through Alert.az, paid limits, company seats/roles and affiliate reporting | 8-15 days | Alert.az API credentials/documentation and sender configuration, delivery preferences, payment/affiliate agreements and pricing |
| Own products | Catalog ownership, checkout, payment verification, fulfillment, returns and order support | Separate scope after product selection | Products, merchant account, operational owner and fulfillment decisions |
| Later extensions | Partner vouchers, provider-managed group gifting, AI images, video/voice, native apps | Estimate separately | Provider agreements, image budget, operational support and explicit app publication scope |

Estimates are planning ranges, not promises or statements of completion. First release can be fully exercised locally without sending mail or charging anyone. External readiness gaps must be reported explicitly.

## SMS and email through Alert.az

Confirmed by Rashad on 2026-11-12: Alert.az is our own startup and provides SMS and email APIs. Use Alert.az as Wisher's planned provider for both channels.

Planned uses are upcoming-occasion reminders to account owners, optional delivery of personal greetings to recipients, and scheduled company greetings to selected employees/customers. Keep in-app reminders alongside these channels. Users choose the channel, recipient, content and send time; saving a greeting or campaign does not itself send it.

Implement an Alert.az delivery adapter after reviewing its API documentation and supplied credentials. Use queued delivery, timezone-aware scheduling, duplicate-send protection, bounded retries, delivery status tracking where the API supports it, and per-user/company sending limits. Plan SMS/email preferences and opt-out handling, sender identity, and message costs before enabling delivery. API capabilities beyond SMS and email remain to be verified.

This records the provider decision and future integration scope. Alert.az is not integrated yet; current reminders remain in-app and company campaigns remain drafts/plans. No messages are sent by this planning update.

## AI and cards

DeepSeek creates three text alternatives using recipient, relationship, occasion, tone, language, format and optional personal detail. Bound input, output, timeouts, daily per-user/global quotas and costs. Store saved drafts privately. Use text-and-design card export for launch. DeepSeek has no image generation. Later evaluate OpenAI image generation as an optional paid adapter only after provider/key/budget approval. No additional key is assumed.

## Monetization hypotheses

Free gift discovery and basic personal tools; later controlled premium generation/card/reminder limits, company workspace subscriptions, and retailer affiliate commission where contracted. Own-product margins come later. No prices, unlimited promises, affiliate relationships or payment capabilities are advertised without an approved operational offer.

## Migration plan only

1. Inventory old row counts, ownership, duplicates, content rights and files from an authorized snapshot, never modify production during planning.
2. Keep an immutable backup and ID mapping table. Stage import users, profiles, contacts, groups, interests and events into a separate database; validate counts and owner isolation.
3. Link Kimlik by stable subject or verified email only with collision handling. Do not import passwords into a new authentication surface.
4. Convert event recurrence/timezones deliberately, preserve original dates and map contact groups. Retain legacy consent separately; never infer marketing consent.
5. Import reviewed wishes/templates/content with provenance. Retain legacy orders read-only for accounting/support; do not turn them into new purchases.
6. Plan redirects for gifts/products/wishes/photo templates, account links and content with search value. Private pages remain noindex.
7. Dry-run, compare counts and sampled records, verify rollback and obtain production migration authorization. No migration has run.

## Performance and operations

Paginate every growing list, use owner/date and catalog/filter indexes, cache public taxonomy, bound imports, and keep provider calls outside transactions. Test isolation and idempotency in forced in-memory SQLite. A 100k-row fixture check is not proof of 100k concurrent users. Production needs MySQL/Postgres or a justified equivalent, shared cache/queues, real load testing, scheduler, backups and monitoring before making that scale claim.

Local ports: backend 8022, frontend 3022, old reference 8020. Keep credentials in ignored env files. Disk guard is 10 GB before every build/install. No pushes, DNS changes or production writes.

## Security items retained

Old unauthenticated Twilio credential route and tracked Nova auth.json require removal and credential rotation through a separate authorized production operation. Never call or recreate the credential route. New BFF uses httpOnly sessions, same-origin mutation checks, PKCE, scoped database access and safe external destinations.
