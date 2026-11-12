# Wisher home design directions

Exploratory pages for the 2026-11-12 brief. None is selected. Existing home and its brand decisions remain untouched. Azerbaijani copy is draft pending owner review.

## Offer and conversion

For someone preparing a loved one's birthday or another occasion: browse gifts from Azerbaijani stores, prepare a personal greeting, and keep dates in an account. Gift browsing is free and requires no account. Products are paid for at the retailer; Wisher does not fulfill these orders. Primary action on all concepts: "Hədiyyə tap", opening the existing /gifts catalogue. Greetings and dates are quiet secondary links. No pricing plans, delivery promises, partner claims or fabricated proof.

The brief supplies the emotional argument: someone you love feels remembered. Copy is drafted around that argument without waiting for a separate copy approval, as the requested deliverable is three reviewable proposals.

## A - A personal letter

- Personality: intimate = a greeting addressed to Aysel; considered = serif reading rhythm; warm = pale rose paper and a real personal detail.
- Palette: canvas #fff5f7, text #342b31, brand #a34566 for the wordmark and letter rule, action #243d57 for primary buttons, letter surface #ffffff; success #276143, error #a32432 reserved for states.
- Typography: Source Sans 3 body/UI, 400/600; Noto Serif display, 400/500. H1 64px desktop, 38px mobile; body 18px. Both families cover Azerbaijani and Russian.
- Hero: an asymmetric letter spread, headline beside a large greeting excerpt and its accompanying gift. Mobile reads as a personal note after a concise offer.
- Product moment: Aysel's birthday, a real generated sentence about school friendship, and a catalogue gift with its recorded price.
- Signature detail: the letter's vertical pink margin rule; a typographic sign-off, not fake handwriting.
- Imagery: actual catalogue LEGO flowers photograph. No stock or generated imagery.
- Voice: personal, calm Azerbaijani; hədiyyə, təbrik, özəl gün.
- Shapes: square paper, 4px buttons, no pills or repeated bordered cards.
- Why it sells: the greeting demonstrates personal relevance before asking for an account. A visible product price makes the next step concrete.

## B - A gift with a story

- Personality: expressive = oversized product photography; playful = cropped editorial scale; direct = price and store beside the object.
- Palette: canvas #ffffff, text #172c36, brand #12627a for wordmark, action #b52b43 for primary buttons, photo surround #e4f4f7; success #276143, error #a32432 reserved for states.
- Typography: Nunito Sans body/UI and headline, 400/600/800; Noto Serif Display for the greeting only, 400. H1 60px desktop, 37px mobile; body 17px. Both cover Azerbaijani and Russian.
- Hero: large real gift photograph on the left and an offset headline on the right, with price anchored to the photograph. Mobile leads with the offer and then the object.
- Product moment: LEGO flowers as a birthday gift, followed by words for the accompanying greeting.
- Signature detail: the product caption sits on the edge of the photo spread, like a considered gift selection in a magazine.
- Imagery: real catalogue product photos, object-fit contain, never misleading lifestyle composites.
- Voice: conversational and concrete; presents an editorial gift idea, not an automatic match.
- Shapes: square sections, 0px buttons; no enclosing demo frame.
- Why it sells: the visitor sees what they can give, its price, and where it comes from immediately. The greeting adds personal value beyond a store catalogue.

## C - The date worth remembering

- Personality: attentive = a prominent birthday date; grounded = plain purchase information; cheerful = a light lemon occasion band.
- Palette: canvas #ffffff, text #26372e, brand #496552 for wordmark and date, action #174f43 for primary buttons, occasion band #f4f5c9; success #276143, error #a32432 reserved for states.
- Typography: Noto Sans body/UI, 400/600; Roboto Slab for headline/date, 400/600. H1 54px desktop, 30px mobile; body 17px. Both cover Azerbaijani and Russian.
- Hero: a wide headline above an open, large-format birthday date, a gift, and a greeting excerpt. No calendar widget, account dashboard, or bounded demo.
- Product moment: the sample date 15 November belongs to Aysel; a gift and personal words sit alongside that occasion.
- Signature detail: oversized date numerals organize the page; compact genuine occasion names organize the closing section.
- Imagery: actual LEGO bamboo photograph from the catalogue. No decorative icons.
- Voice: practical and affectionate; dates are explicitly samples, reminders are described as in-app only.
- Shapes: square bands, 8px primary buttons, no card grid.
- Why it sells: the occasion provides a reason to act now without a false countdown. Free browsing is the first step; saving dates is an optional follow-on.

## Content provenance and scope

- Public catalogue read from the existing local backend through /api/workspace/catalog on 2026-11-12. Product IDs 1 (LEGO bamboo), 3 (LEGO flowers), and 4 (Tognana coffee maker). Store, price, title and source URL come from those records. Images are local copies of those record URLs for reliable concept review. The design does not imply retailer partnership.
- Greeting reused verbatim from frontend/src/messages/opening.ts, documented as a successful DeepSeek response in docs/knowledge/design-review-result.md. No new generation, private records or paid provider calls. Extracts use whole original sentences; the full text is also shown.
- Aysel and 15 November are synthetic examples labeled "Nümunə". Ad günü, Novruz, Yeni il and toy ildönümü are real occasion types. No customer evidence is invented.
- These are Azerbaijani-only, light-only public proposals. No new backend, forms, login flows or application features. Existing routes retain their existing behavior.
- Browser plugin execution tools were unavailable after discovery; local Chrome via the existing Playwright dependency is used for screenshots. No new npm package is needed.

## Review

Section 5 checklists and final screenshot evidence are recorded in docs/briefs/wisher-design-directions.result.md after the render loop.
