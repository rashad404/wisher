# Wisher design decisions

- Conversion goal: help visitors choose a gift; primary action is Hədiyyə tap. Greeting creation and company planning are secondary entry points. Retailer prices appear on product listings; no Wisher paid plan is advertised.
- Personality: personal = real greetings and named examples; practical = prices and useful controls; warm = rust and peach accents with restrained typography.
- Palette: canvas #f8f8f6, text #20201f, brand #9b3d24 for identity/selection/links, action #f2b705 with #302400 text, highlight #f3bd95 on dark surfaces, success #23512e, error #9c241b.
- Typography: existing Archivo display and IBM Plex Sans body/UI retained under the owner's explicit Sayt reference instruction. This header-only revision does not change page typography. Wordmark uses a custom w symbol and tightly set lowercase type with a subordinate domain suffix.
- Hero: existing dark full-width, centered two-tone heading, explicitly requested by Rashad. Unchanged in this revision.
- Product moment: select a real gift with its price and prepare a personal greeting.
- Signature detail: continuous rounded w stroke, used as the small brand mark and favicon. No gift box, sparkle, gradient or decorative AI symbol.
- Imagery: actual retailer catalog images and the existing labeled greeting example.
- Voice: short Azerbaijani action labels; gifts, greetings, and special dates remain distinct concepts.
- Shapes: compact rounded-square logo mark; pill primary actions; understated navigation selection; 44px minimum controls.
- Header: sticky solid white surface, brand and navigation grouped on the left, account and gift action on the right, full menu retained. Mobile keeps visible sign-in and menu controls plus existing bottom navigation.
- Version history: previous header preserved in docs/evidence/design/before-header-refresh.tar.gz. New version is a proposal for owner review, not claimed approved.
- Rejected: generic startup-design direction; previous header/wordmark requested to be fixed and made more modern on 2026-11-12.

## Header revision verification

Rendered and inspected at 1440 and 375; also checked layout and sticky positioning at 820 and 320. Menu opening, Escape and scroll restoration pass. Production build and TypeScript checks pass. Header entry retains direct Kimlik popup authentication. Current UI is Azerbaijani; no additional languages or themes are implied.

Two logo treatments were rendered in actual header context: the implemented custom mark with wordmark (`header-detail-1440.png`, `header-detail-375.png`) and a quieter wordmark-only alternative (`header-wordmark-option-1440.png`, `header-wordmark-option-375.png`). Full opening views are `header-refresh-1440.png` and `header-refresh-375.png`. The icon uses the same vector mark and is served by the application as `/icon.svg`.

Patterns addressed in this narrow change: generic plain-text identity becomes a recognizable small mark; equally prominent rounded controls become a clear navigation/account/action hierarchy. No proof claims, decorative product illustrations, new marketing copy or changes to the hero were added.

## Below-hero revision

2026-11-12: Rashad accepted the header/logo for now and the hero, but rejected the remaining sections and requested a full-width footer. Preserve those accepted regions. Replace repeated bordered product cards with a photo-led collection and category filters; give occasion planning a labeled calendar example and company tools a separate divided navigation section. Footer uses a viewport-wide dark background with an aligned content grid. Backup: docs/evidence/design/before-lower-page-refresh.tar.gz.

Lower-page verification: production build/type checks passed; the design sweep found no overflow, text below 12.5px or flat-background text contrast findings across 20 route/viewport combinations. Footer bounds equal the viewport at 1440 and 375. Category filters switch all six source products to the two hobby products and back; gift finder, hero selection, card download and catalog retry pass. Company links open the requested people/branding/planning tab; tab entry was checked with mocked account responses. Desktop and mobile renders inspected. Section-only screenshots omit fixed header, bottom navigation and skip-link chrome to avoid full-page capture artifacts. Full-page screenshots preserve the actual page. No backend messaging, purchases or paid generation were performed.

## Logo exploration brief

The logo-ideas brief records Rashad's approval of the header and hero at /az/concepts/d. For this exploration the governing brand is pomegranate #a3122f, action green #0f6b4f and white, with Fraunces display/wordmark and Manrope text. This supersedes the older palette above for these proposals only. No site identity asset is replaced by this round.

Rashad rejected the rust w tile, eight-point star/gear, red serif-w tile, w gift tag, heart speech bubble and ribbon bow: "super bad", "not even close". Nine new icon proposals explore abundance, a remembered date, a folded page, an embrace, a carried wish, a candle, a handwritten gesture, a dedication and a seed. The review goal is to choose an idea by number; this is an internal comparison page, not a customer acquisition page. It uses the approved wordmark and color roles, flat one-color vectors, no enclosing tiles, and no decorative UI. All remain unselected.

## Candle-i development

Rashad's candle brief develops concept 06: the i in wisher becomes a birthday candle, and its dot becomes the flame. Four unselected proposals compare a restrained serif stem, a taller wax stem, a narrow stem with a wick, and a broader candle with an asymmetric flame. The Fraunces wordmark and smaller Manrope .az are converted to paths; candle shapes and spacing are custom drawn. Pomegranate #a3122f remains the brand surface, white/reversed red the lettering, and warm amber is reserved for the flame. All four are flat, without glow. This is a review-only identity study, with no installation into site headers or metadata.
