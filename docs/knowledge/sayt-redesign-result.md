# Wisher redesign from the Sayt.az reference

Date: 2026-11-12. Supersedes the earlier beige split-hero direction.

## Reference inspected before building

Read `sayt-az-design-reference.md` and `design-not-ai-looking.md`. Opened the live Sayt.az homepage and `/texniki-xidmet`, captured both at 1440 and 375 pixels and visually inspected all four opening screenshots. Reference captures, including full pages, are in `docs/evidence/design/sayt-reference/`.

The owner explicitly rejected startup-design for Wisher. This revision follows the Sayt.az reference and the owner's requested dark hero, centered two-tone headline, pill controls, product visibility, typography and density. Sayt's green palette, service prices, support claims and portfolio images were not copied.

Before implementation, listed the changes to the owner: replace the split hero, adopt Archivo/IBM Plex Sans, show actual gifts/prices alongside the greeting, use pill controls, separate color roles, and replace long explanatory sections with a working gift finder and compact product selection.

## Implemented

- Full-width near-black opening with a centered, white/peach headline naming gift selection and greeting preparation.
- Gold primary action; rust brand links, product selection and search control; peach is the brand tint on the dark surface. Status colors remain separate.
- Self-hosted Archivo headings and IBM Plex Sans interface/body text, with the font licenses included. Numeric prices use tabular figures. No runtime Google Fonts request is required.
- Large product surface showing real catalog imagery, source store, title and last-checked price alongside the existing DeepSeek greeting example. Names/dates are labeled examples. The gift selection is an editorial suggestion, not a claim of personalized AI matching.
- Three selectable actual products, live price/title updates and working detail links. Mobile switches between gift and greeting views, keeping the product and price in the first screen.
- Existing sample card download retained. No new paid greeting generation.
- Working recipient/occasion/budget finder, six compact product listings, and concise calendar/company entry points.
- Shared header, mobile navigation, account routes and Kimlik popup retained. Updated shared typography and control density; no backend behavior changed.
- Retailer checkout explanation stays below the product sections, not beneath the hero actions.

## Section 1 patterns addressed

| Previous weakness | Change |
| --- | --- |
| Predictable split landing composition | Centered dark opening leads directly into actual gift choice and greeting output. |
| Familiar beige styling bundle | Explicit dark/light contrast and separate color roles, following the owner-selected reference. |
| Mechanical, oversized explanatory sections | Gift finder and compact inventory replace long narrative blocks. |
| Interchangeable copy | Headline names the actions; product area carries real names, prices, retailer and a working download. |
| Product imagery too late | Real gift photography and its price now appear before scrolling at both requested widths. |
| Uniform visual emphasis | Gold identifies the main action; secondary tools and purchasing details stay quieter. |
| Invented proof | None added. No copied support phone, statistics, discounts, availability guarantees or merchant partnership claims. |
| Uneven completeness | Loading/error/empty handling, mobile view switch, responsive checks and functional flow verification. |

## Verification

Production build and type checking passed. First-load route JavaScript is approximately 128 KB. The design browser sweep covers 20 public/private route/viewport combinations at 1440 and 375: no horizontal overflow, page errors, rendered text smaller than 12.5px, or text contrast findings in the flat-background check. This is not a full accessibility certification.

The dedicated homepage browser check covers first-viewport price visibility, real product switching, finder filter propagation, mobile card view, PNG download and catalog failure/retry. Screenshots: `docs/screenshots/sayt-direction-home-{1440,375}.png` and `sayt-direction-opening-{1440,375}.png`.

The UI remains Azerbaijani with one light interface and a dark hero, not a theme switcher. English/Russian UI and dark-theme variants are not claimed. Azerbaijani copy remains available for owner editorial review. No production deployment, push, external messages or purchases.

Previous local design is preserved in `docs/evidence/design/before-sayt-redesign.tar.gz`.
