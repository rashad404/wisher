# sayt.az design system (reference for Wisher)

Copied 2026-11-12 from the lead agent's saytaz-design skill. Rashad: sayt.az is the best design in the portfolio; Wisher must learn from it. Take the method, structure, typography, density, components and quality bar from here. Section 10 (build rules) and the sayt.az prices, packages and Qara + nane colours are sayt.az-specific: Wisher keeps its own accent colours but follows the same colour-role rule.

See the result live: https://sayt.az (home hero, packages, support page). Screenshot it at 1440 and 375 and look at it before designing.


# sayt.az design system

Agreed with Rashad on 2026-10-31 after several rejected attempts. Every rule here exists
because something failed. Read the failures section before designing anything.

## 1. The one sentence

**sayt.az pages are trade counters, not journals.** A visitor should be able to see a price,
compare two options and act, inside the first screen. If an element cannot be clicked,
compared, or read as a number, it needs a reason to exist.

## 2. Palette: Qara + nane

Near-black and mint. Chosen deliberately over purple (the AI default and Hostinger's colour),
over pomegranate, and over five other candidates.

```
LIGHT                                   DARK
--bar        #101010  utility strip     #050505
--on-bar     #FFFFFF                    #FFFFFF
--on-bar-dim #9A9A9A                    #8E8E8E
--ink        #FFFFFF  hero band         #0B0B0B
--ink-2      #F3F6F3  domain desk       #121212
--on-ink     #101010                    #FFFFFF
--on-ink-dim #5E5E5E                    #8E8E8E
--ink-line   #DCDFDC                    #2C2C2C
--page       #F7F8F7                    #0F0F0F
--card       #FFFFFF                    #181818
--line       #E2E5E2                    #2A2A2A
--text       #121212                    #F2F2F2
--muted      #6A6A6A                    #8E8E8E
--brand      #13613A  deep green        #86EFAC  mint
--brand-ink  #FFFFFF                    #06230F
--price      #1A1A1A                    #F2F2F2
```

Fixed across every theme, because these carry meaning, not brand:

```
--promo      #F2B705  gold      CTA, eyebrow, nav price tags
--promo-ink  #3A2A00            text on gold
--promo-text #B57F02  (light)   gold used as TEXT; #F2B705 in dark
--tick       #1F8A52  (light)   included ticks; #4ADE8B in dark
--signal     #D4431F  red       discount chips only
```

## 3. The four-colour role rule

**This is the rule that was broken most often and matters most.**

Each colour has exactly one job. Never let the brand colour spread across every element.

| Colour | Used for | Never used for |
|---|---|---|
| **Gold** | the primary CTA, the section eyebrow, nav price tags | anything structural |
| **Brand** | nav button, billing toggle, selected row, search button, links, "most chosen" badge | the primary CTA |
| **Green** | included ticks, "Serfeli" badge, "2 ay hediyye" | buttons |
| **Red** | discount chips only | anything else |

**The failure to avoid:** if you pick green and then make the nav button, the toggle, the
badge, the selected row, the buy button, the search button and every link green, the page
reads as amateur. Rashad's words: "if u do for example green, u make everything green, doesnt
look good."

Only one structural token exists (`--brand`). Do not introduce a second near-identical one.

## 4. Typography

- Display: **Archivo**, weights 700 and 800, letter-spacing -.02em to -.03em
- Body and UI: **IBM Plex Sans**, weights 400 to 600
- Both from Google Fonts, both cover Azerbaijani

**Font size floor is 12.5px. Nothing smaller, ever.** Terms, renewal lines, footnotes and
badges were all rejected at 9.5 to 11px.

Rough scale: hero h1 clamp(30px, 4.4vw, 46px) / section h2 21-24px / plan name 16.5px /
body 15px / secondary 13.5px / smallest label 12.5px.

Use `font-variant-numeric: tabular-nums` on every price, spec and countdown.

## 5. Density

Information per screen is the point. Specific rules:

- The price must be visible in the first screen. Not after a scroll.
- Package rows carry: use-case label, name, badge, two or three real limits, strikethrough
  list price, current price, discount chip, period, renewal note.
- Every nav item that leads to something priced carries its starting price as a gold tag.
- Comparison beats browsing when there are few items. A card grid is for a catalogue of
  hundreds; a matrix is for three plans you choose between. Form follows inventory.
- No decorative paragraph where a number, a label or a control would do.

## 6. Structure that works

Proven order for a sayt.az landing surface:

1. **Utility strip** (dark in both themes): support hours, phone number, WhatsApp, language,
   currency. The phone number is the single largest trust signal and is never omitted.
2. **Nav**: logo, items with gold price tags, login, primary order button.
3. **Trade counter**: a two-column band. Left = promise, ticks, gold CTA, a talk-to-us link.
   Right = the plan rack with the billing toggle, real prices and one selected row.
4. **Domain desk**: wide input with extension selector, then per-TLD tiles showing first-year
   and renewal price.
5. **Proof rail**: years, users, domains, support, payment marks.

## 7. Copy

- **Plain ASCII punctuation only.** No em dashes, en dashes, curly quotes, ellipsis characters
  or non-breaking spaces, anywhere, including language files and database content.
- Azerbaijani is written, not translated. `olaraq` and `hansi ki` are tells.
- Headings are sentences about the reader, not labels. "Reqemler ozu danisir", not
  "Statistikalarimiz".
- Name the objection in the heading: "Hansi paket sene uygundur?"
- Never use an adjective where a number or a named system will do. "5 ms-den az gecikme",
  not "fast".
- Numbers are rounded and directionally true, never exact database figures. See section 9.
- All strings come from `src/messages/{az,en,ru}/`. No hardcoded text.

## 8. Forbidden

- **No gradient text.** The live site's gradient headline is the clearest AI tell.
- No glassmorphism, no blur cards, no gradient pill badges.
- **No purple or violet.** It is the AI default and Hostinger's colour.
- No abstract illustration standing in for a product. No coloured rectangles.
- No client website screenshot beside a hosting price; it implies design is included.
- No invented statistic, no review score we do not hold, no guarantee we do not operate.
- No fonts below 12.5px.

## 9. Numbers

Rashad's rule, which is counterintuitive and must be followed:

**Rounded and directionally true is correct. Exact database figures are wrong.** The database
starts in 2012, the business is older, and years of cash work, office walk-ins, support jobs
and SMM were never recorded. An exact figure understates the business.

- Fine: "20+ il", "32 000+ istifadeci", "9 000+ domen"
- Never: a Trustpilot or Google score we do not hold, or an uptime or response guarantee we
  do not operate. One click or one outage disproves those.

The test is checkability, not precision.

## 10. Build rules

- Work in `/Users/macmini/projects/sayt/site-frontend`, never `frontend`, which is live.
- Preview port 3003, backend port 8001, endpoint `GET /api/hosting/packages`.
- Package `id=8` ("Plan Xususiyyeti") is not a product. Select by verified id, never by index.
- `usePrice()` only prefixes a currency symbol and does no conversion. Do not use it for
  prices; print the amount with an explicit code.
- Server components wherever there is no interactivity.
- Images JPEG or WebP, never PNG.
- SEO frozen: no URL, title, description, canonical or OG change.
- Mobile first. 16px side gutters, no horizontal scroll, 44px minimum touch targets.
- Do not commit, do not push.

## 11. Process, learned the hard way

**Render the page and look at it before publishing or presenting.** Twice a page was shipped
unseen and both times it was visibly broken: clipped text inside icon tiles, a label
overflowing a progress ring, half-empty stretched cards, a logo rendering as `s SAYT . AZ`.

A render check costs one command. Do it every time.

## 12. The rejected attempts, so they are not repeated

| Attempt | Verdict | Cause |
|---|---|---|
| First redesign | "current design is 100x better" | the brief specified appearance and omitted the selling argument |
| Second redesign | "100x better" again | a wireframe: default blue, a grey rectangle where product substance belonged, no composition. The competitor screenshots were analysed in a document and never looked at while building |
| epin.az-style catalogue | "put an elephant into a bottle" | copied a layout built for thousands of browsable products and applied it to seven things a customer compares |
| Purple palette | "the one most of the times AI use" | inherited from the current site without question |
| Pomegranate palette | "bad colour choose" | |
| Monochrome schemes | "if u do green, u make everything green" | the brand colour applied to every element at once |

The pattern across all of them: **copying a form without the substance that makes it work.**
Study the reference, take the principle, build for our own inventory.

## 13. What finally worked (support hero, 2026-11-07)

Full write-up: `/Users/macmini/projects/knowledge/design-lessons-tech-support-hero.md`.
The short version, after ~25 rounds:
- **Offer and copy before design.** Settle what is sold and lock the Azerbaijani copy
  (built from Rashad's own arguments) before touching layout.
- **Headline = product + price, no riddles.** "Saytınız üçün texniki xidmət, ayda 99
  manatdan." Slogans ("Sayt sizindir, qayğısı bizdədir.") go in the eyebrow pill.
- **People don't read: show the product big.** A real portfolio screenshot in a browser
  frame plus a phone chat beat any text. Use images we own; no political news photos.
- **Dark full-width band, centred huge two-tone headline, pill buttons** (learned from
  saytim.az), in OUR palette: black band, mint accent, gold only for the main button.
- **Build visuals with a render loop** (screenshot 1440 and 375 every round). Codex
  designs blind in its sandbox; do visual polish where screenshots are possible.
- **Native Azerbaijani, spoken, never translated.** See the rejected-phrases list in the
  write-up. Marketing devices are fine; only checkable false claims are banned.
