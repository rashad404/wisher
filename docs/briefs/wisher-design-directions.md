# Brief: three design directions for the Wisher home page

You are a fresh design agent for Wisher. Rashad rejected the current home page (http://100.89.150.50:3022/) twice: first a generic startup look, then a copy of sayt.az filled with the usual Codex house style. Your job is to propose three genuinely different directions, as rendered pages, before anything replaces the current home.

## Read first
1. The product-design skill, all of it. Section 0 (sell first) and section 1, including "The Codex house style", are the bar.
2. docs/knowledge/product-idea-and-plan.md: what Wisher is (remember dates, find a gift from Azerbaijani stores, prepare a personal greeting; companies later).
3. AGENTS.md (ports, rules). Ignore the old design.md decisions about palette, fonts and hero: they are rejected. Keep only facts (product, routes, data).
4. Look at the current home at 1440 and 375 so you know what not to repeat.

## What Wisher must feel like
- The emotion is the moment someone you love feels remembered: a birthday not forgotten, a gift that fits, words that sound like you.
- Warm, personal, celebratory, Azerbaijani. Not a tech service, not an electronics catalogue, not a balloons-and-confetti greeting site.
- The visitor's question: "Someone's day is coming. What do I give, and what do I say?" The page answers it in the first screen and gets them to start.

## Hard constraints
- Nothing from sayt.az's look: no black hero band with a gold pill button, no centred two-tone headline, no Archivo or IBM Plex Sans.
- None of the Codex house style items (product-design section 1). If a direction has more than two of them, redo it.
- Each direction has its own palette with colour roles, its own type pairing (Azerbaijani and Russian coverage), and its own first-screen composition. The three must not look like variants of one page.
- Real content: real product data from our catalogue, real Azerbaijani occasions, sample greetings from our real generation, labelled "Nümunə" where synthetic. No invented reviews, numbers or logos.
- Conversion: one primary action per page, visible without scrolling at 375 and 1440; a headline that says what Wisher does for the visitor (not two commands).
- Azerbaijani copy written natively; plain ASCII punctuation; example.com for any address.

## Deliverables
1. Three concept pages in the frontend at /az/concepts/a, /az/concepts/b, /az/concepts/c. Do not change the live home route, the backend, or other pages.
2. For each: a short design.md-style block (personality, palette with roles, fonts, hero composition, product moment, signature detail, imagery, voice) in docs/design-directions.md, and why it sells.
3. Screenshots of each at 1440 (first screen and full page) and 375 (first screen and full page) in docs/screenshots/design-directions/.
4. For each, the product-design section 5 checklist with honest answers, including which house-style items remain, if any.
5. Stop there. Do not pick one and do not build further. The lead reviews the screenshots, then Rashad chooses.

## Rules
- Commit locally with plain messages; no push, no deploy.
- Disk guard: df -h / before installs/builds; at least 10 GB free. No new npm packages unless a font package is needed.
- Result: docs/briefs/wisher-design-directions.result.md with the URLs, screenshot paths and checklist answers.
