# Wisher product idea and planning direction

Recorded: 2026-11-12

Status: Product direction captured from Rashad's discussion. Detailed scope, launch priorities, pricing, partners, and final UI are still to be agreed. This document describes the intended product, not a claim that these features are implemented.

## The idea

Wisher helps people celebrate people. Remember important dates, find a suitable gift and create a personal greeting. Initially, gift purchases happen on the websites of the Azerbaijani stores listed on Wisher. Companies can use Wisher to celebrate employees, thank customers, and manage gifting.

Wisher brings occasions, greetings, and gift discovery together for individuals and companies. AI helps create personal messages and, eventually, richer greeting formats. It is a supporting capability, not the entire product.

We are building a completely new application in `/Users/macmini/projects/wisher-new`. The old `/Users/macmini/projects/wisher` application is a reference for understanding existing features and planning migration. We are not redesigning or upgrading the old application in place.

## Gift shop direction - corrected by Rashad

The catalog is not limited to digital gifts. Wisher can recommend physical products from other Azerbaijani ecommerce stores as well as suitable digital gifts.

Initially, Wisher is a gift discovery and recommendation service. Collect product information from store websites through scraping, or feeds/APIs where available, and display relevant products on Wisher. Listings should include the image, title, description, price and currency, store name, and original product URL. Users choose a product on Wisher and follow a clear "Buy at store" link to complete the purchase on the retailer's website.

The retailer handles checkout, payment, shipping, and order support in this initial model. An outbound click is not a confirmed purchase; Wisher must not present retailer order or delivery status without an actual integration.

Later, Wisher will offer its own products. Their categories, checkout, fulfillment, and operational requirements will be planned separately. Physical products are not excluded from that future scope.

This explicit user correction supersedes the earlier digital-only product restriction in the original brief, old roadmap, and any repository guidance repeating it. The other engineering and operational constraints remain in effect.

## Three connected parts

### 1. Personal Wisher

- Save important people and their dates.
- View birthdays, anniversaries, holidays, and other occasions in a calendar.
- Receive reminders and prepare for upcoming occasions.
- Create personal messages and greeting cards.
- Keep wishlists and saved greetings.
- Discover gift ideas, save products, and visit the selling store to buy.
- Prepare a greeting to accompany a gift. Do not imply it is automatically attached to an external store order.
- Keep saved gift ideas and wishlists. Gifts sent and received and order history depend on later supported purchasing or delivery flows.

Example journey: A friend's birthday is approaching. Wisher reminds the user, suggests suitable products from Azerbaijani stores, and helps prepare a personal card. The user buys the chosen gift on the store's website.

### 2. Gift shop and recommendations

- Browse products by occasion, recipient, interests, and budget.
- See product images, titles, descriptions, prices, and the selling store.
- Save suitable products to a wishlist.
- Follow the product link to the retailer's website to buy.
- Start with products collected from other Azerbaijani ecommerce stores.
- Add Wisher's own products in a later phase.

Plan source selection, category mapping, duplicate handling, refresh frequency, and unavailable-product handling before building collection jobs. Store source URLs and last-checked timestamps so changing prices and availability can be handled honestly. Store selection and any affiliate or commercial arrangements are still to be decided; listing a product does not imply a partnership.

Group gifting is a possible extension; its collection and payment arrangement needs separate planning.

### 3. Wisher for companies

- Manage employee and customer occasions.
- Prepare company-branded greetings and discover suitable employee or customer gifts.
- Organize individual or group gifting campaigns.
- Plan gift budgets. Actual spending and order tracking require supported purchase data or a later integration.
- Work within a company workspace with appropriate access roles.

Example journey: A company prepares branded Novruz greetings and selects employee gifts from Azerbaijani stores within a defined budget. Initially, purchases happen at those stores.

The company offering belongs in the product architecture and public explanation from the beginning. The exact capabilities included at launch remain a planning decision.

## SMS and email delivery - Alert.az

Rashad confirmed on 2026-11-12 that Alert.az is our own startup and offers SMS and email APIs. Plan to use Alert.az for Wisher's SMS and email delivery: occasion reminders, personal greetings sent at the user's request, and company greetings to selected recipients.

In-app reminders remain available. Channel preferences, scheduling, sender identity, sending limits and costs need to be defined before enabling outbound delivery. The provider is decided; API integration details still require its documentation and credentials. This is planned functionality, not an implemented or active sending service. See the [roadmap](../roadmap.md#sms-and-email-through-alertaz) for implementation scope.

## Proposed website structure

| Section | Purpose |
| --- | --- |
| Home | Explain the whole service and provide clear paths for individuals and companies. |
| Gift shop | Discover gifts from Azerbaijani stores and visit the retailer to buy; later include Wisher's own products. |
| Greetings | Create messages and cards for different occasions and recipients. |
| For companies | Explain corporate gifting and introduce the company workspace. |
| My account | Access the personal overview, people, calendar, wishlists, saved greetings, saved products, and settings. Add gifts sent and received and orders when the relevant flows exist. |

The company workspace would contain organization settings, people, campaigns, branding, budgets, and eventually supported order history. Its detailed navigation and permissions need to be defined.

The homepage should visibly offer both "Find a gift" and "Create a greeting", with "For companies" easy to find. It must explain the broader service rather than presenting Wisher only as a greeting generator.

## Design direction

Use football/DBscore, Elek, and Sayt as references for the portfolio's familiar layout and interaction principles, without copying their visual designs:

- Logo on the left and menu controls on the right.
- Clear, consistent mobile navigation for frequent actions.
- An organized footer with useful product, company, help, and legal links.
- Readable typography and layouts that work well on small screens.
- A distinct Wisher identity suited to personal occasions and professional gifting.

The previous greeting-focused four-tab proposal is not final. Navigation must be reconsidered around the broader product, including gifts and companies. Existing local design examples are exploratory, not an approved design.

## Planning before further implementation

Rashad initially paused implementation for product planning. After approving the header and opening screen, Rashad authorized full implementation on 2026-11-12. Preserve that approved visual direction and implement the first release below; own products and other expressly later phases remain deferred.

1. Define the audiences and use cases for individuals, gift buyers, and companies.
2. Define the gift offering: initial Azerbaijani stores and categories, product collection and refresh rules, and the outbound purchase experience. Plan Wisher's own products as a later phase.
3. Map the complete personal journey from occasion to gift recommendations, saved products, greeting preparation, and purchase on the retailer's website. Distinguish Wisher's responsibilities from the retailer's.
4. Map the company journey from organization setup to people, branding, campaign preparation, budgets, and results.
5. Agree on the first release and later phases. Preserve the full product vision even if the initial release is smaller.
6. Finalize the sitemap, account areas, and mobile navigation.
7. Review simple screen layouts and the homepage explanation before committing to visual design and further coding.
8. Update the rebuild roadmap and feature inventory to reflect these decisions, then implement the agreed scope.

## Decisions still open

- Which Azerbaijani stores and product categories should be included first?
- How should product collection, price updates, and unavailable listings work?
- Which products will Wisher sell itself later, and how will checkout and fulfillment work?
- What greeting sharing experience should accompany a purchase made at another store?
- Which Alert.az SMS/email reminders and greeting delivery flows launch first, and what scheduling and sending limits apply?
- Which company features launch first: branded greetings, individual gifting, or bulk campaigns?
- What are the free and paid features, gift margins or commissions, and company pricing?
- When should wishlists and group gifting launch?
- What is the final navigation and first-release acceptance criteria?

These are unresolved planning questions, not reasons to silently remove the gift shop or company offering from the product.

## Existing technical constraints retained

- New Laravel 12 backend and Next.js 15 / React 19 frontend, following applicable Elek conventions.
- Kimlik login; the client has already been created and credentials stay in ignored environment files.
- Alert.az, our own SMS/email startup, is the planned outbound messaging provider.
- DeepSeek for text generation, not Gemini. DeepSeek does not provide image generation; image generation needs a separate proposal.
- Mobile-first and performance-first, with the brief's 100k-user scale requirement.
- No production changes, pushes, or deployments under the current brief.
- The original briefs remain the source for the engineering, security, disk, testing, and delivery constraints. Their digital-only product restriction is superseded by Rashad's correction above.

## Source briefs

- [Rebuild brief](../../../wisher/docs/briefs/wisher-rebuild.md).
- [Audit and roadmap brief](../../../wisher/docs/briefs/wisher-audit-and-roadmap.md).
- Rashad's product and design discussion on 2026-11-12, including gifts and companies, and the subsequent correction to recommend physical and digital products from Azerbaijani stores now and offer Wisher's own products later.
