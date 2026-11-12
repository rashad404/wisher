# Wisher design: how not to look like an AI-generated website

Read this before designing any Wisher page, the logo, or the brand.

This was learned on sayt.az. The support hero took about 25 rounds before Rashad called it good. Most rounds were lost to the same few mistakes. The goal here is to get Wisher right in 5 rounds.

Wisher has an extra risk: it is an AI product. A site that sells AI wishes and also looks AI-made tells the visitor the wishes will be generic too. The page has to prove the opposite: personal, warm, specific.

Full sources, if you need more depth:
- /Users/macmini/projects/knowledge/design-lessons-tech-support-hero.md (what finally worked on sayt.az)
- /Users/macmini/projects/knowledge/voice-and-design-standards.md, sections 3 (native Azerbaijani), 5 to 7 (why sites read as AI, what a designer does, pre-ship checklist)
- The startup-design skill (composition, typography, rhythm)

## 1. What "AI-looking" actually means

A visitor feels a site is AI-made when it looks assembled from familiar patterns, with no sign that it was shaped for this product and these users. It is never one thing. It is a list of concrete weaknesses:

| Pattern | What it looks like | Fix |
|---|---|---|
| Predictable composition | Centred headline, two buttons, logo strip, three feature cards, testimonials, signup band | Build the page around the visitor's real questions, in their order |
| Familiar styling bundle | Gradient text, soft glows, glassmorphism, pill badges everywhere, purple | One clear visual idea in our own palette |
| Mechanical repetition | Equal section heights, identical cards, an icon for every idea | Different layouts for different kinds of information |
| Interchangeable language | "Seamless", "effortless", "unlock", "magic", broad promises | Say exactly what happens: who, which occasion, what they receive |
| Decorative product imagery | Abstract blobs, floating widgets, fake dashboards | Show the real product: a real wish, a real card, a real reminder |
| Uniform enthusiasm | Every line excited, every benefit equally important | Pick what matters most and let the rest be quiet |
| Invented proof | Made-up user counts, ratings, testimonials, logos | Use only what is true, or show nothing |
| Uneven completeness | Beautiful hero, broken mobile, no empty or error states | The same care on every screen and state |

## 2. Forbidden on Wisher

- Gradient text. It is the clearest AI tell.
- Purple or violet as the brand colour. It is the AI default.
- Glassmorphism, blur cards, glowing orbs, gradient pill badges.
- Sparkle icons, magic wands, "AI-powered" badges, robot imagery. Do not decorate the AI. Show what it writes.
- Emoji used as icons or bullet points.
- Stock photos of smiling people. Abstract illustrations standing in for the product.
- Invented numbers, reviews, star ratings, "trusted by" logos, testimonials.
- Fonts smaller than 12.5px.
- Em dashes, en dashes, curly quotes and ellipsis characters anywhere, including translations and seed data. Use plain ASCII punctuation.
- Invented domains or emails in mockups. Use example.com only.

## 3. Process: the order that works

1. **Decide the offer before any design.** What exactly does a visitor get, free and paid? What is excluded? A design cannot fix a vague offer. Write it in docs/roadmap.md first.
2. **Collect Rashad's own reasoning.** On sayt.az the strongest selling points came from his notes, not from AI ideas. Ask him why people need Wisher, in his words, and build the copy from that.
3. **Write the Azerbaijani copy first, then lock it.** Write it as spoken Azerbaijani, never translated from English. Rashad edits. Only then start layout. Neither Claude nor Codex is a native speaker: offer, he decides.
4. **The headline says what we sell. No riddles.** Product plus outcome, readable at a glance. Catchy slogans go in the small eyebrow above the headline, not in the H1.
5. **Look at a reference, not a description of it.** If Rashad points at a site, screenshot it at 1440 and 375 and look at it. Take the principle (composition, hierarchy, density). Never copy its layout, content, colours or assets.
6. **Show the product big.** People do not read. On sayt.az a text-only hero was "super bad". What worked was a big real product picture with fewer words.
7. **Build with a render loop.** Build, take a screenshot at 1440 and 375, look at it, fix, repeat. Never present a page you have not looked at rendered. Twice a sayt.az page was shipped unseen and both times it was visibly broken.
8. **Send screenshots every round and change only what was asked.** When Rashad says "show me the current version", show it as it is. Back up each approved state before the next experiment.

## 4. Wisher-specific direction

**The product moment.** The hero shows one real Wisher flow, not a feature list. For example: a reminder that Aysel's birthday is in 3 days, then a personal wish generated in natural Azerbaijani that mentions something specific about her, then the finished card ready to send on WhatsApp. Label it as an example. Keep names, dates and details consistent with each other.

**Real examples, not lorem.** Generate real sample wishes with our actual DeepSeek prompt for real Azerbaijani occasions (ad günü, Novruz, Yeni il, 8 Mart, toy, uşağın doğulması, Ramazan bayramı, a promotion at work). Pick the best few and let Rashad approve them. These samples are the visual substance of the page. If the samples read as generic, fix the prompt before designing around them.

**Warmth without cliche.** Greetings sites slide into balloons, confetti and glitter. Avoid that bundle as much as the AI bundle. Warmth comes from real names, real occasions, natural language and good typography.

**Colour roles.** Pick a small palette and give each colour exactly one job: one accent for the primary action, one for highlights, semantic colours only for status (success, error). The failure to avoid, in Rashad's words: "if u do for example green, u make everything green, doesnt look good."

**Typography.** One strong text family that covers Azerbaijani (ə, ı, İ, ş, ç, ğ, ö, ü) and Russian. Add a display family only if it has a clear role. Use intentional headline line breaks at both widths. Do not leave a single word alone on a line.

**Logo.** Simple and recognisable at 32px. A wordmark or one clear symbol. No gradient, no sparkle, no gift box with a bow. Show 2 or 3 options rendered in real use (header, app icon, WhatsApp share preview), not on an empty white canvas.

**Marketing is allowed.** Bold headlines, "Ən çox seçilən", a highlighted plan: all fine. The only hard limit is a claim someone can check and find false.

## 5. Native Azerbaijani: quick rules

- Short spoken sentences. Read it aloud with the English hidden. If it sounds translated, rewrite it from scratch.
- `olaraq` and `hansı ki` are translation tells. Avoid bureaucratic padding.
- Rejected on sayt.az as translated or wrong register: "göz qoyuruq", "tanımadığınız adam", "dərd-sər", standalone "şey" or "bir şey" ("hər şey" is fine).
- The same concept uses the same word everywhere on the site.
- Every İ, ı and ə must be correct, with hyphens after numbers before a suffix (3-cü, 2026-cı).
- Headings are sentences about the reader, not labels.

## 6. Before you show Rashad anything

1. List which patterns from section 1 the page has, and what you changed for each. "Changed the font" is not an answer.
2. Could the headline describe a different company? If so, rewrite it.
3. Does the page show the real product, or decoration standing in for it?
4. Is anything invented (stats, reviews, logos)? Remove it and list it so Rashad can supply real numbers.
5. Remove every sentence that could appear unchanged on hundreds of other sites.
6. Check every state: empty, loading, error, long names, returning user.
7. Screenshots at 375 and 1440, in az, en and ru, with long Russian labels checked. Light and dark, if both exist.
8. Grep for banned characters (em/en dashes, curly quotes, ellipsis) in code, translations and seed data. Zero hits.
9. Keyboard focus visible, contrast at least 4.5:1, touch targets at least 44px, reduced motion respected.
10. Report what you verified and what you did not. A green build is not a visual check.
