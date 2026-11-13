# Brief: review the approved design, then make it the real Wisher and continue

Rashad approved the home page design built by the lead: http://100.89.150.50:3022/az/concepts/d (code: frontend/src/app/az/concepts/d/page.tsx and d.module.css). Logo: candle-i variant 2 (frontend/public/concepts/candle-logo/v2), favicon is the flame only (favicon-flame.svg/png). Faint flame pattern on the red hero and green closing is approved.

## Step 1: read and check (no code changes)
Read the product-design skill completely, especially the new modern-vs-template.md in the skill folder. Then write docs/design-review.md: how concept D meets or misses each point of modern-vs-template.md sections 3 and 4, and anything you would improve. Keep it short and honest. Record Wisher's brand decisions in docs/design.md using the skill template (replace the rejected old decisions: Archivo/IBM Plex, black band, gold, rust, beige are all rejected).

## Step 2: make concept D the real home page
- Replace the current home (/, /az) with concept D's design and content, built as proper components using the app's real data where it exists (featured products from the catalog, links to real pages, the reminder form wired to the real login/occasion flow). Keep the approved look exactly; do not "improve" it silently.
- New header, logo and favicon site-wide (all pages get the new header/footer style; the old rust "w" logo, old favicon and old SiteShell look go away). Design a footer in the same system and show it.
- Do not feature the LEGO "Flowers in Watering Can" product anywhere (looks like an aftafa).
- Mobile: the direction is approved, so now do the home page mobile layout (stack cleanly, card stage readable, gift grid 2 columns, tiles 2 per row, sticky primary action if needed). Screenshots at 375 and 1440.

## Step 3: next page, first screen only
Design the /gifts page in the same system (not a copy of the home): build only its desktop first screen, screenshot it, and STOP. Rashad approves each first screen before the rest of a page and before mobile (rule: first screen first).

## Rules
- Follow the skill and modern-vs-template.md; render and look at every screenshot before reporting.
- Commit locally, plain messages, no AI mentions; no deploy.
- Result: docs/briefs/wisher-apply-design.result.md with the review summary, screenshot paths (home 1440 + 375, footer, gifts first screen) and URLs.
