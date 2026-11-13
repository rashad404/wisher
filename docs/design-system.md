# Wisher design system

Source of truth: the approved pages (home `/` and `/gifts`), built from concept D. Every Wisher screen uses these building blocks. Read the product-design skill and modern-vs-template.md first; this file only records Wisher's own choices.

## Feeling
Warm, personal, celebratory, Azerbaijani. Someone you love feels remembered. Pages show real things (a card, a gift, a date, a reminder), never abstract dashboards.

## Tokens (components/HomePage.module.css)
- `--pom #a3122f` brand surface (header, hero band), `--pom-deep #7c0c22` hover/pressed.
- `--leaf #0f6b4f` the action colour (primary buttons only), `--leaf-hover #0a5740`.
- `--ink #1d1416` text and selected states (selected chip/tile = ink fill or ink outline).
- `--muted #5f5357` secondary text (min 13px; 12.5px absolute floor).
- `--line #eadfe1` dividers and quiet borders; `#f1e8ea` row dividers.
- `--paper #fff` page; `--blush #fff3f1` / `#fbf7f8` a quiet tinted section (one per page at most); `#f6f3f4` image wells.
- Amber `#ffb627` with core `#fff3c4`: the flame, only in the logo, favicon and the small countdown chip icon.
- Occasion tints: `#fde8ec #e6f4ea #fff0e6 #e8f0fb #f3ecfb #e6f6f8 #fdf6dd #fbe9f3` with the Fluent 3D objects in /concepts/occasions/.

## Type
- Display: Fraunces 700 (headings, card salutations, signatures in italic).
- Text: Manrope 400-800.
- Page H1 clamp(36px, 4.2vw, 56px), section H2 28-40px, body 16-18px, meta 13-14px.

## Components (copy patterns from the approved pages)
- Header: red band, white candle-i wordmark, nav links, pill "Daxil ol". Footer: as on home.
- Primary button: leaf, 14px radius, 50-52px tall, 800 weight, flat (no drop shadow). Secondary: 2px outline (white on red, ink on white). Text link: pom, 800, underline on hover.
- Chips: pill 38-40px, 1.5px line border; selected = ink fill with white text.
- Tiles: tinted 18px-radius tile, label top-left 800, 3D object bottom-right; selected = 2px ink outline.
- Cards: product card (grey image well, tag pill top-left, heart top-right, price 800, name, store); greeting card (white, dashed red striped border, Fraunces salutation, italic signature); coloured greeting cards (red with flame pattern, white striped, green).
- Form card: white, 18px radius, 1px line border, soft shadow, rows separated by dividers, label left (muted 14px) and value/control right; full-width leaf button at the bottom.
- Inputs: soft grey well (#f6f3f4) with small label above inside the well (see the reminder form); selects styled with a chevron; no native date input (use day + month selects in Azerbaijani).
- Notices/reminder rows: white rounded rows with a 3D object, bold title, muted line, time on the right.
- Empty states: a 3D object, one sentence on what to do, one leaf button.

## Layout
- Side padding clamp(16px, 5vw, 64px); content max ~1312px; generous vertical rhythm (56-72px between sections).
- Each section has its own shape; never stack identical blocks; at most one tinted section per page.
- Mobile: 16px gutters, stacked, 44px targets, tiles 2 per row, product grid 2 columns.

## Copy
Native Azerbaijani, short, warm, concrete; action labels say what happens. Plain ASCII punctuation. Mark examples "Nümunə".

## Never
Beige/rust/gold palette, eyebrow labels on every section, arrow-circle buttons, grey admin forms, heavy shadows, emoji icons, stock photos, purple, gradients on text.
