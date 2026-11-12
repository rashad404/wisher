# Wisher design directions result

Completed 2026-11-12. Three proposals are ready for lead review and Rashad's choice. No direction is selected and no further product work is included.

## Preview URLs

- A, personal letter: http://100.89.150.50:3022/az/concepts/a
- B, gift editorial: http://100.89.150.50:3022/az/concepts/b
- C, remembered date: http://100.89.150.50:3022/az/concepts/c

Local equivalents use http://localhost:3022 with the same paths. The frontend runs in production mode on 0.0.0.0:3022. Backend 8022 and reference 8020 were not restarted or changed.

[Design decisions and selling rationale](../design-directions.md) record each personality, palette and roles, font pairing, composition, product moment, signature detail, imagery and voice.

## Required screenshots

Desktop first screens are 1440 x 900. Mobile first screens are 375 x 812. Full-page captures use those widths. All were opened and visually reviewed after rendering. Full-page captures suppress only the fixed mobile action bar to keep the page content readable; the unmodified bar is visible in every mobile first-screen capture.

| Direction | Desktop first screen | Desktop full page | Mobile first screen | Mobile full page |
| --- | --- | --- | --- | --- |
| A | [a-1440-first.png](../screenshots/design-directions/a-1440-first.png) | [a-1440-full.png](../screenshots/design-directions/a-1440-full.png) | [a-375-first.png](../screenshots/design-directions/a-375-first.png) | [a-375-full.png](../screenshots/design-directions/a-375-full.png) |
| B | [b-1440-first.png](../screenshots/design-directions/b-1440-first.png) | [b-1440-full.png](../screenshots/design-directions/b-1440-full.png) | [b-375-first.png](../screenshots/design-directions/b-375-first.png) | [b-375-full.png](../screenshots/design-directions/b-375-full.png) |
| C | [c-1440-first.png](../screenshots/design-directions/c-1440-first.png) | [c-1440-full.png](../screenshots/design-directions/c-1440-full.png) | [c-375-first.png](../screenshots/design-directions/c-375-first.png) | [c-375-full.png](../screenshots/design-directions/c-375-full.png) |

Additional evidence in `docs/screenshots/design-directions/`:

- `before-1440.png`, `before-375.png`: existing home inspected before implementation.
- `reference-sayt-1440.png`, `reference-sayt-375.png`: reference inspected before implementation.
- `after-home-1440.png`, `after-home-375.png`: unchanged home; pixel comparison against the corresponding before captures passed at both widths.
- `{a,b,c}-375-focus.png`: keyboard skip-link focus.
- `{a,b,c}-375-image-error.png`: deliberately failed product images with readable fallback and retained product information.
- `verification.json`: six layout checks, including CTA visibility, images, text size, touch targets, contrast and horizontal overflow.
- `interactions.json`: all four primary links per concept fire the expected event, keyboard entry works, failed images recover to fallback, and the hero CTA opens /gifts.

## Section 5 checklist: A

0. Conversion: one goal, open the existing gift catalogue with "Hədiyyə tap". At both widths the first screen explains gifts and personal greetings for a loved one, says browsing is free without registration, and shows the action. The real gift price and greeting excerpt are visible. The same action repeats after the greeting and in the closing section, with a mobile sticky action. All four primary links emit `wisher_concept_action` to `dataLayer` and a `wisher:analytics` browser event.
1. Fixed rules: passed scoped punctuation scan, font glyph inspection for Azerbaijani and Russian, rendered minimum text size 12.5px, normal-text contrast 4.5:1, and visible links at least 44 x 44px. No Archivo, IBM Plex, gradient text, emoji, fake proof, or stock photography in the concept.
2. AI-looking patterns: familiar split composition remains. The content is a personal letter rather than a dashboard. The lower letter section also uses two columns, a deliberate reading layout; the closing section changes scale and purpose. The specific nine-item house-style list has 0 exact matches. Conservatively, the pale rose canvas and one white letter surface could remind a reviewer of the soft-panel habit, counted as 1 resemblance. It has no beige/rust/gold bundle, fake widget, repeated card grid, eyebrows, arrow controls, uniform radii or default section stack. The full generated text repeats the opening excerpt so its provenance and personal detail can be judged; it is not a testimonial. No invented proof, decorative imagery or uniformly excited copy.
3. Headline: "Yaxınınıza hədiyyə, ona özəl sözlər." It names Wisher's combined gift-and-greeting offer; the adjacent text specifies Azerbaijani stores. It could describe another business offering that same combination, but it is not a generic technology slogan.
4. Product: real generated greeting shown prominently in the first screen, alongside the catalogue gift and recorded price. Mobile shows both before the sticky action bar.
5. Sameness: rose correspondence, Noto Serif with Source Sans 3 and navy rectangular actions differ from B's photographic spread and C's open date band. Visually compared with the rejected home and sayt.az; no black hero, gold pill or centered two-tone headline.
6. Screenshots: all four required views captured and inspected. Azerbaijani/light only, as requested. Image failure and keyboard focus captured separately. No other language or dark mode is advertised by the concepts.
7. Limits: owner review of Azerbaijani copy and the direction remains pending. No user conversion experiment, live analytics collector, mobile-network performance benchmark, or assistive-technology audit was run.

## Section 5 checklist: B

0. Conversion: one goal, "Hədiyyə tap" to /gifts. Offer, free browsing, gift image, price and primary action are visible at both widths. The action repeats beside the full greeting and the coffee gift, and remains reachable in the mobile bar. All four links emit the concept analytics event with direction and placement.
1. Fixed rules: passed punctuation, glyph coverage, text-size, contrast, touch-target and overflow checks. Nunito Sans and Noto Serif Display both include the required Azerbaijani and Russian characters. Square controls, local real product photos, no gradients or invented evidence.
2. AI-looking patterns: a familiar image/text split and a second two-column editorial section remain. The large object, attached caption and separate letter-reading type role give those layouts a specific purpose. The nine-item house-style list has 0 matches. There is no centered demo card, beige panel, card grid, arrow row, repeated rounded outline, eyebrow stack or dark closing footer. The actual catalogue happens to name an electronics retailer, but the selected objects are flowers made from LEGO and a coffee maker, presented as personal gift ideas. No invented matching score, customer enthusiasm or review.
3. Headline: "Hədiyyəsi də, təbriki də ona uyğun." Describes the combined offer and personal relevance. The supporting copy says how Wisher helps and where the gifts come from. It is not claimed as a unique phrase no competing gifting service could use.
4. Product: actual LEGO flowers at large scale with source store and recorded price in the first screen. The full real generated greeting follows in the next section; it is intentionally not squeezed into the photographic hero.
5. Sameness: white/cyan photographic composition, berry square action and heavy Nunito Sans hierarchy differ from A's letter spread and C's occasion strip. No sayt.az black/mint/gold composition or banned fonts.
6. Screenshots: four required views and mobile image-failure/focus evidence captured. Fixed a mobile word-joining issue, preserved deliberate three-line headline, and reduced image height so the recorded price is visible. Azerbaijani/light only.
7. Limits: the same shared validation limits apply. This proposes editorial discovery, not a new recommendation engine. Product availability and checkout continue to belong to the existing catalogue and retailer.

## Section 5 checklist: C

0. Conversion: "Hədiyyə tap" opens /gifts. The first screen connects remembered dates with gifts, explains the personal greeting, states free gift search, and shows the action. Mobile includes the sample date, gift and price. Repeated primary links and sticky mobile access emit the tested event.
1. Fixed rules: punctuation scan, AZ/RU glyph coverage, rendered text sizes, contrast and 44px targets pass. Noto Sans and Roboto Slab, white canvas, lemon occasion surface and green action. No dark hero, gold pill, decorative icons or fake proof.
2. AI-looking patterns: the occasion illustration resembles a planner at a conceptual level. Conservatively count 1 house-style resemblance to the calendar/widget habit, although the page has no bounded calendar, fake controls or dashboard. The nine specific patterns otherwise do not occur. Large date numerals are sample content with a visible label, not a fabricated urgency countdown. The full-width open spread and differently shaped closing occasion list replace repetitive cards and arrow rows. No invented reminder delivery, order status, or automated personalization.
3. Headline: "Özəl gün yadınızda, hədiyyə fikri Wisher-də." Names both the occasion and Wisher's gift-discovery role. It avoids the rejected pair of commands and abstract promises.
4. Product: real catalogue bamboo gift, recorded price, clearly synthetic birthday date and real greeting excerpt occupy the desktop first screen. On mobile, date and gift take priority; the greeting continues below the fold.
5. Sameness: a horizontal open date spread with slab numerals differs from both the personal letter and the oversized gift photograph. Light lemon/white composition differs from sayt.az and the rejected home. Green is used for the wordmark/date and a separately specified darker action role; it is not spread onto every element.
6. Screenshots: four required views, mobile failure and focus evidence. Reduced mobile headline size to avoid splitting "Wisher-də" and leaving a suffix alone. Azerbaijani/light only.
7. Limits: same shared validation limits. No live countdown or personal date query. All date data is fixed and labeled as an example.

## State and implementation scope

These are server-rendered public concept pages using a documented, dated catalogue snapshot. They have no asynchronous catalogue fetch, editable names, account-specific content, saving, or generation operation. Loading, empty catalogue, generation success and returning-user variants are therefore not new states here. Image space is reserved while loading, and failed images retain useful product information and a working detail link. Actual catalogue titles are available in image alt text; shortened display titles remove identifiers while keeping the real product identity. No new private query or database write is performed by the concepts.

Analytics events are wired and browser-tested. There is no new collector or persistent analytics service; no claim of a measured conversion funnel is made. No backend work was authorized or performed.

Only the exact concept paths bypass the existing SiteShell and its account lookup. All other paths take the unchanged rendering branch. The current home route file, its styles and copy, other page implementations, backend, and existing design.md were not edited.

## Verification and delivery

- Read before implementation: the complete product-design skill, product idea and plan, AGENTS.md, roadmap, feature inventory, Wisher design notes, sayt.az reference, Azerbaijani-wording skill and editorial examples, and the English/Azerbaijani voice guidance. Inspected current home and sayt.az at both required widths before coding.
- No Sites plugin, template, image generation, new npm package, production write, push, deployment, native build or outbound message.
- Existing Playwright dependency used read-only; no Elek edits. Browser plugin execution tool was unavailable after discovery.
- `npm run typecheck` passed. Final `npm run build` passed. Every install/build guard used `df -h /`; approximately 17 GiB available, above the 10 GB minimum. No packages were installed.
- `node scripts/check-design-directions.cjs` passed all six view checks with no page errors.
- `node scripts/check-concept-interactions.cjs` passed navigation, all primary event emissions, keyboard focus, image failure and invalid-direction 404 checks.
- Home screenshots at 1440 and 375 are pixel-identical before and after this work.
- No backend tests run, because backend code was unchanged. No development or production database was used for tests.
- Font license files and source product URLs are retained with the local assets. Cold mobile font loading was not benchmarked; production optimization would be assessed after a direction is chosen.
- Existing user changes in AGENTS.md and knowledge documents were left untouched and excluded from the task commit.

Stop point: proposals only. Lead reviews screenshots; Rashad chooses.
