# Legacy feature inventory

Updated 2026-11-12. Sources: old routes, controllers/models, prior read-only production audit, and local authenticated route inspection. Every registered application route from `docs/evidence/legacy-routes.json` is listed below. No credential endpoint was called.

The latest product direction permits physical gift recommendations from Azerbaijani stores. Retailers handle purchases initially. Old orders are retained in the migration plan, not erased.

| Method and route | Feature | Data | Verdict | Reason |
| --- | --- | --- | --- | --- |
| GET,HEAD `/` | Public homepage, about, how it works | Features, menus, testimonials | Improve | New brand and accurate personal, gift and company journeys. |
| GET,HEAD `/about` | Public homepage, about, how it works | Features, menus, testimonials | Improve | New brand and accurate personal, gift and company journeys. |
| GET,HEAD `/api/user` | Framework/session utility or static closure: Closure | Route/session state | Review/replace | Preserve only required behavior in the new app; no legacy closure copied. |
| GET,HEAD `/api/wish-photo-templates` | Public template catalog and API | Wish photo templates | Merge | Card styles in the greeting flow; no standalone legacy photo editor. |
| POST `/authenticate` | Password login/register/logout | Users and password hashes | Replace | Kimlik login; local-only demo is isolated and disabled in production. |
| GET,HEAD `/blog` | Article list and detail | Blog posts and images | Defer | Keep migration/redirect plan; launch content requires editorial review. |
| GET,HEAD `/blog/{id}/{title}` | Article list and detail | Blog posts and images | Defer | Keep migration/redirect plan; launch content requires editorial review. |
| GET,HEAD `/cart` | Session basket and quantities | Cart and product variants | Cut for first release | Purchases occur at the retailer; revisit with own products. |
| GET,HEAD `/cart/remove/{itemId}` | Session basket and quantities | Cart and product variants | Cut for first release | Purchases occur at the retailer; revisit with own products. |
| POST `/cart/update` | Session basket and quantities | Cart and product variants | Cut for first release | Purchases occur at the retailer; revisit with own products. |
| GET,HEAD `/category/{id}` | Product listing, filtering, detail and variants | Products, categories, brands, variants, sizes, colors | Improve | Replace stock and checkout assumptions with retailer-linked gift catalog; own products later. |
| GET,HEAD `/chat/{user}` | Conversations and messages | Conversations and messages | Defer | Not required for gift discovery or greeting sharing; use existing sharing channels. |
| GET,HEAD `/check-twilio-credentials` | Credential-returning diagnostic | Environment secrets | Cut | Security blocker: never recreate; rotate legacy credentials separately. |
| GET,HEAD `/checkout` | Checkout, payment and success | Cart, contacts, orders, payments | Cut for first release | No Wisher checkout or fake purchase confirmation for external shopping. |
| POST `/checkout/payment` | Checkout, payment and success | Cart, contacts, orders, payments | Cut for first release | No Wisher checkout or fake purchase confirmation for external shopping. |
| GET,HEAD `/checkout/success` | Checkout, payment and success | Cart, contacts, orders, payments | Cut for first release | No Wisher checkout or fake purchase confirmation for external shopping. |
| GET,HEAD `/contact` | Legal, FAQ, contact, features and pricing pages | Page content and pricing plans | Improve | Useful help and accurate privacy/terms drafts; no unsupported paid-plan claims. |
| POST `/contact` | Legal, FAQ, contact, features and pricing pages | Page content and pricing plans | Improve | Useful help and accurate privacy/terms drafts; no unsupported paid-plan claims. |
| GET,HEAD `/contacts/events` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| POST `/contacts/import/android` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| POST `/contacts/import/ios` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| GET,HEAD `/contacts/search/checkout` | Checkout, payment and success | Cart, contacts, orders, payments | Cut for first release | No Wisher checkout or fake purchase confirmation for external shopping. |
| GET,HEAD `/contacts/{contact}/events` | Nested contact event CRUD | Contacts and events | Merge | Single owner-scoped occasion flow. |
| POST `/contacts/{contact}/events` | Nested contact event CRUD | Contacts and events | Merge | Single owner-scoped occasion flow. |
| GET,HEAD `/contacts/{contact}/events/create` | Nested contact event CRUD | Contacts and events | Merge | Single owner-scoped occasion flow. |
| PUT `/contacts/{contact}/events/{event}` | Nested contact event CRUD | Contacts and events | Merge | Single owner-scoped occasion flow. |
| GET,HEAD `/contacts/{contact}/events/{event}` | Nested contact event CRUD | Contacts and events | Merge | Single owner-scoped occasion flow. |
| DELETE `/contacts/{contact}/events/{event}` | Nested contact event CRUD | Contacts and events | Merge | Single owner-scoped occasion flow. |
| GET,HEAD `/contacts/{contact}/events/{event}/edit` | Nested contact event CRUD | Contacts and events | Merge | Single owner-scoped occasion flow. |
| GET,HEAD `/contacts/{contact}/groups` | Nested contact groups | Contacts and groups | Merge | Use scoped contact editing; retire duplicate unguarded routes. |
| POST `/contacts/{contact}/groups` | Nested contact groups | Contacts and groups | Merge | Use scoped contact editing; retire duplicate unguarded routes. |
| GET,HEAD `/contacts/{contact}/groups/create` | Nested contact groups | Contacts and groups | Merge | Use scoped contact editing; retire duplicate unguarded routes. |
| PUT `/contacts/{contact}/groups/{group}` | Nested contact groups | Contacts and groups | Merge | Use scoped contact editing; retire duplicate unguarded routes. |
| GET,HEAD `/contacts/{contact}/groups/{group}` | Nested contact groups | Contacts and groups | Merge | Use scoped contact editing; retire duplicate unguarded routes. |
| DELETE `/contacts/{contact}/groups/{group}` | Nested contact groups | Contacts and groups | Merge | Use scoped contact editing; retire duplicate unguarded routes. |
| GET,HEAD `/contacts/{contact}/groups/{group}/edit` | Nested contact groups | Contacts and groups | Merge | Use scoped contact editing; retire duplicate unguarded routes. |
| GET,HEAD `/events-by-category` | Browse wishes and event categories | Wishes, events, categories | Improve | DeepSeek personal generation with edit/save/copy/card export and quota controls. |
| GET,HEAD `/events/category` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| GET,HEAD `/events/category/{categoryId}` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| GET,HEAD `/events/{categoryId}` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| GET,HEAD `/faq` | Legal, FAQ, contact, features and pricing pages | Page content and pricing plans | Improve | Useful help and accurate privacy/terms drafts; no unsupported paid-plan claims. |
| GET,HEAD `/features` | Legal, FAQ, contact, features and pricing pages | Page content and pricing plans | Improve | Useful help and accurate privacy/terms drafts; no unsupported paid-plan claims. |
| GET,HEAD `/get-messages` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| GET,HEAD `/gifts` | Product listing, filtering, detail and variants | Products, categories, brands, variants, sizes, colors | Improve | Replace stock and checkout assumptions with retailer-linked gift catalog; own products later. |
| POST `/groups/{group}/add-contact` | Contact grouping and bulk actions | Groups and contact membership | Merge | Personal group labels and separate company people management. |
| DELETE `/groups/{group}/remove-contact/{contact}` | Contact grouping and bulk actions | Groups and contact membership | Merge | Personal group labels and separate company people management. |
| GET,HEAD `/how-it-works` | Public homepage, about, how it works | Features, menus, testimonials | Improve | New brand and accurate personal, gift and company journeys. |
| GET,HEAD `/lang/{locale}` | Language selection | Session locale | Improve | Explicit supported language routes later; Azerbaijani UI first. |
| POST `/load-wish-message` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| GET,HEAD `/login` | Password login/register/logout | Users and password hashes | Replace | Kimlik login; local-only demo is isolated and disabled in production. |
| POST `/logout` | Password login/register/logout | Users and password hashes | Replace | Kimlik login; local-only demo is isolated and disabled in production. |
| GET,HEAD `/messages/{event}` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| GET,HEAD,POST,PUT,PATCH,DELETE,OPTIONS `/nova/dashboard` | Framework/session utility or static closure: Illuminate\Routing\RedirectController | Route/session state | Review/replace | Preserve only required behavior in the new app; no legacy closure copied. |
| POST `/password/email` | Password resets and test-email helper | Users, reset tokens, mail | Cut | Kimlik owns authentication; no public diagnostic mail route. |
| GET,HEAD `/password/reset` | Password resets and test-email helper | Users, reset tokens, mail | Cut | Kimlik owns authentication; no public diagnostic mail route. |
| POST `/password/reset` | Password resets and test-email helper | Users, reset tokens, mail | Cut | Kimlik owns authentication; no public diagnostic mail route. |
| GET,HEAD `/password/reset/{token}` | Password resets and test-email helper | Users, reset tokens, mail | Cut | Kimlik owns authentication; no public diagnostic mail route. |
| GET,HEAD `/password/sent` | Framework/session utility or static closure: Closure | Route/session state | Review/replace | Preserve only required behavior in the new app; no legacy closure copied. |
| GET,HEAD `/pricing` | Legal, FAQ, contact, features and pricing pages | Page content and pricing plans | Improve | Useful help and accurate privacy/terms drafts; no unsupported paid-plan claims. |
| GET,HEAD `/privacy-policy` | Legal, FAQ, contact, features and pricing pages | Page content and pricing plans | Improve | Useful help and accurate privacy/terms drafts; no unsupported paid-plan claims. |
| GET,HEAD `/products` | Product listing, filtering, detail and variants | Products, categories, brands, variants, sizes, colors | Improve | Replace stock and checkout assumptions with retailer-linked gift catalog; own products later. |
| GET,HEAD `/products/brand/{id}` | Product listing, filtering, detail and variants | Products, categories, brands, variants, sizes, colors | Improve | Replace stock and checkout assumptions with retailer-linked gift catalog; own products later. |
| GET,HEAD `/products/category/{id}` | Product listing, filtering, detail and variants | Products, categories, brands, variants, sizes, colors | Improve | Replace stock and checkout assumptions with retailer-linked gift catalog; own products later. |
| GET,HEAD `/products/filter` | Product listing, filtering, detail and variants | Products, categories, brands, variants, sizes, colors | Improve | Replace stock and checkout assumptions with retailer-linked gift catalog; own products later. |
| POST `/products/filter` | Product listing, filtering, detail and variants | Products, categories, brands, variants, sizes, colors | Improve | Replace stock and checkout assumptions with retailer-linked gift catalog; own products later. |
| POST `/products/variant/quantity` | Product listing, filtering, detail and variants | Products, categories, brands, variants, sizes, colors | Improve | Replace stock and checkout assumptions with retailer-linked gift catalog; own products later. |
| POST `/products/variant/sizes` | Product listing, filtering, detail and variants | Products, categories, brands, variants, sizes, colors | Improve | Replace stock and checkout assumptions with retailer-linked gift catalog; own products later. |
| GET,HEAD `/products/{id}` | Product listing, filtering, detail and variants | Products, categories, brands, variants, sizes, colors | Improve | Replace stock and checkout assumptions with retailer-linked gift catalog; own products later. |
| POST `/products/{productId}` | Session basket and quantities | Cart and product variants | Cut for first release | Purchases occur at the retailer; revisit with own products. |
| GET,HEAD `/products/{product}/reviews` | Product review CRUD | Products, users, reviews | Defer | Do not fabricate verified reviews for third-party products. |
| POST `/products/{product}/reviews` | Product review CRUD | Products, users, reviews | Defer | Do not fabricate verified reviews for third-party products. |
| GET,HEAD `/products/{product}/reviews/create` | Product review CRUD | Products, users, reviews | Defer | Do not fabricate verified reviews for third-party products. |
| GET,HEAD `/register` | Password login/register/logout | Users and password hashes | Replace | Kimlik login; local-only demo is isolated and disabled in production. |
| POST `/register` | Password login/register/logout | Users and password hashes | Replace | Kimlik login; local-only demo is isolated and disabled in production. |
| PUT `/reviews/{review}` | Product review CRUD | Products, users, reviews | Defer | Do not fabricate verified reviews for third-party products. |
| DELETE `/reviews/{review}` | Product review CRUD | Products, users, reviews | Defer | Do not fabricate verified reviews for third-party products. |
| GET,HEAD `/reviews/{review}/edit` | Product review CRUD | Products, users, reviews | Defer | Do not fabricate verified reviews for third-party products. |
| GET,HEAD `/search-contacts` | Recipient search and wish sending | Contacts, wishes, user events | Merge | Greeting preparation and user-controlled sharing; provider delivery requires separate setup. |
| POST `/send-message/{contactId}` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| POST `/subscribe` | Newsletter subscribe/unsubscribe | Subscribers | Defer | Opt-in marketing needs a real sender and reviewed consent flow. |
| GET,HEAD `/terms` | Legal, FAQ, contact, features and pricing pages | Page content and pricing plans | Improve | Useful help and accurate privacy/terms drafts; no unsupported paid-plan claims. |
| GET,HEAD `/test-email` | Password resets and test-email helper | Users, reset tokens, mail | Cut | Kimlik owns authentication; no public diagnostic mail route. |
| GET,HEAD `/testimonials` | Testimonials | Testimonials | Cut unverified content | Only publish attributable approved evidence. |
| GET,HEAD `/unsubscribe/{email}` | Newsletter subscribe/unsubscribe | Subscribers | Defer | Opt-in marketing needs a real sender and reviewed consent flow. |
| GET,HEAD `/user/calendar` | Month/date range calendar | User events | Improve | A usable date view linked to occasion editing and greeting creation. |
| GET,HEAD `/user/chat` | Conversations and messages | Conversations and messages | Defer | Not required for gift discovery or greeting sharing; use existing sharing channels. |
| POST `/user/chat/create` | Conversations and messages | Conversations and messages | Defer | Not required for gift discovery or greeting sharing; use existing sharing channels. |
| DELETE `/user/chat/message/{message}` | Conversations and messages | Conversations and messages | Defer | Not required for gift discovery or greeting sharing; use existing sharing channels. |
| GET,HEAD `/user/chat/user/{id}` | Conversations and messages | Conversations and messages | Defer | Not required for gift discovery or greeting sharing; use existing sharing channels. |
| GET,HEAD `/user/chat/{conversation}` | Conversations and messages | Conversations and messages | Defer | Not required for gift discovery or greeting sharing; use existing sharing channels. |
| DELETE `/user/chat/{conversation}` | Conversations and messages | Conversations and messages | Defer | Not required for gift discovery or greeting sharing; use existing sharing channels. |
| POST `/user/chat/{conversation}/message` | Conversations and messages | Conversations and messages | Defer | Not required for gift discovery or greeting sharing; use existing sharing channels. |
| GET,HEAD `/user/contacts` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| POST `/user/contacts` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| POST `/user/contacts/bulk-delete` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| POST `/user/contacts/bulk-status-update` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| GET,HEAD `/user/contacts/create` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| GET,HEAD `/user/contacts/edit/{contact}` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| PUT `/user/contacts/update/{contact}` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| GET,HEAD `/user/contacts/{contact}` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| DELETE `/user/contacts/{contact}` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| POST `/user/contacts/{contact}/email` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| GET,HEAD `/user/contacts/{contact}/interests` | Contact interest management | Contact interests and interest categories | Merge | Notes and gift categories first; richer interests later. |
| POST `/user/contacts/{contact}/interests` | Contact interest management | Contact interests and interest categories | Merge | Notes and gift categories first; richer interests later. |
| DELETE `/user/contacts/{contact}/interests/{interest}/{type}` | Contact interest management | Contact interests and interest categories | Merge | Notes and gift categories first; richer interests later. |
| POST `/user/contacts/{contact}/sms` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| GET,HEAD `/user/contacts/{id}` | Contact CRUD, bulk actions, contact communication/import helpers | Contacts, events, wishes, messages | Improve | Owner-scoped CRUD, search, relationship, dates and notes; no unapproved outbound messages or device import. |
| GET,HEAD `/user/dashboard` | Dashboard counts, dates, messages and activity | User, contacts, events, conversations, activity | Improve | Overview of occasions, saved greetings and gift ideas without chat counts. |
| GET,HEAD `/user/events` | User event CRUD | User events and occasion categories | Improve | Recurrence, timezone, linked person and in-app reminders. |
| POST `/user/events` | User event CRUD | User events and occasion categories | Improve | Recurrence, timezone, linked person and in-app reminders. |
| GET,HEAD `/user/events/create` | User event CRUD | User events and occasion categories | Improve | Recurrence, timezone, linked person and in-app reminders. |
| GET,HEAD `/user/events/edit/{event}` | User event CRUD | User events and occasion categories | Improve | Recurrence, timezone, linked person and in-app reminders. |
| PUT `/user/events/{event}` | User event CRUD | User events and occasion categories | Improve | Recurrence, timezone, linked person and in-app reminders. |
| GET,HEAD `/user/events/{event}` | User event CRUD | User events and occasion categories | Improve | Recurrence, timezone, linked person and in-app reminders. |
| DELETE `/user/events/{event}` | User event CRUD | User events and occasion categories | Improve | Recurrence, timezone, linked person and in-app reminders. |
| GET,HEAD `/user/groups` | Contact grouping and bulk actions | Groups and contact membership | Merge | Personal group labels and separate company people management. |
| POST `/user/groups` | Contact grouping and bulk actions | Groups and contact membership | Merge | Personal group labels and separate company people management. |
| POST `/user/groups/bulk-delete` | Contact grouping and bulk actions | Groups and contact membership | Merge | Personal group labels and separate company people management. |
| POST `/user/groups/bulk-status-update` | Contact grouping and bulk actions | Groups and contact membership | Merge | Personal group labels and separate company people management. |
| GET,HEAD `/user/groups/create` | Contact grouping and bulk actions | Groups and contact membership | Merge | Personal group labels and separate company people management. |
| GET,HEAD `/user/groups/{group}` | Contact grouping and bulk actions | Groups and contact membership | Merge | Personal group labels and separate company people management. |
| PUT `/user/groups/{group}` | Contact grouping and bulk actions | Groups and contact membership | Merge | Personal group labels and separate company people management. |
| DELETE `/user/groups/{group}` | Contact grouping and bulk actions | Groups and contact membership | Merge | Personal group labels and separate company people management. |
| GET,HEAD `/user/groups/{group}/edit` | Contact grouping and bulk actions | Groups and contact membership | Merge | Personal group labels and separate company people management. |
| GET,HEAD `/user/my-orders` | User order list and detail | Orders, items, statuses | Defer | Archive historical orders; external clicks are not orders. |
| GET,HEAD `/user/orders/{order}` | User order list and detail | Orders, items, statuses | Defer | Archive historical orders; external clicks are not orders. |
| GET,HEAD `/user/profile` | Profile and settings | User and profile | Improve | Kimlik identity, preferences, timezone and logout. |
| PUT `/user/profile` | Profile and settings | User and profile | Improve | Kimlik identity, preferences, timezone and logout. |
| GET,HEAD `/user/send-wish` | Recipient search and wish sending | Contacts, wishes, user events | Merge | Greeting preparation and user-controlled sharing; provider delivery requires separate setup. |
| POST `/user/send-wishes` | Recipient search and wish sending | Contacts, wishes, user events | Merge | Greeting preparation and user-controlled sharing; provider delivery requires separate setup. |
| GET,HEAD `/user/settings` | Profile and settings | User and profile | Improve | Kimlik identity, preferences, timezone and logout. |
| GET,HEAD `/user/wish-photos` | Create, edit, download and delete personalized images | User wish photos, template and image files | Merge | Greeting text and card download; AI imagery needs a separate provider. |
| POST `/user/wish-photos` | Create, edit, download and delete personalized images | User wish photos, template and image files | Merge | Greeting text and card download; AI imagery needs a separate provider. |
| GET,HEAD `/user/wish-photos/create` | Create, edit, download and delete personalized images | User wish photos, template and image files | Merge | Greeting text and card download; AI imagery needs a separate provider. |
| GET,HEAD `/user/wish-photos/create/{templateId?}` | Create, edit, download and delete personalized images | User wish photos, template and image files | Merge | Greeting text and card download; AI imagery needs a separate provider. |
| GET,HEAD `/user/wish-photos/{id}` | Create, edit, download and delete personalized images | User wish photos, template and image files | Merge | Greeting text and card download; AI imagery needs a separate provider. |
| GET,HEAD `/user/wish-photos/{id}/download` | Create, edit, download and delete personalized images | User wish photos, template and image files | Merge | Greeting text and card download; AI imagery needs a separate provider. |
| GET,HEAD `/user/wish-photos/{wish_photo}` | Create, edit, download and delete personalized images | User wish photos, template and image files | Merge | Greeting text and card download; AI imagery needs a separate provider. |
| PUT,PATCH `/user/wish-photos/{wish_photo}` | Create, edit, download and delete personalized images | User wish photos, template and image files | Merge | Greeting text and card download; AI imagery needs a separate provider. |
| DELETE `/user/wish-photos/{wish_photo}` | Create, edit, download and delete personalized images | User wish photos, template and image files | Merge | Greeting text and card download; AI imagery needs a separate provider. |
| GET,HEAD `/user/wish-photos/{wish_photo}/edit` | Create, edit, download and delete personalized images | User wish photos, template and image files | Merge | Greeting text and card download; AI imagery needs a separate provider. |
| GET,HEAD `/wish-photos` | Public template catalog and API | Wish photo templates | Merge | Card styles in the greeting flow; no standalone legacy photo editor. |
| GET,HEAD `/wishes` | Browse wishes and event categories | Wishes, events, categories | Improve | DeepSeek personal generation with edit/save/copy/card export and quota controls. |

## Additional inventory findings

- No complete legacy company workspace, digital voucher fulfillment, or group money pool was found. These are new product areas, not migrated working integrations.
- `/cards` was disconnected and returned 404. Merge its intent into `/wishes`.
- Legacy admin/Nova content resources are not a new public user feature; catalog maintenance is implemented as an operator CLI first.
- Tracked legacy `auth.json` and the Twilio disclosure remain production remediation items for Rashad. New code must not inherit either.
- Historical orders, images and consent records require retention review before migration; no production data was copied.
