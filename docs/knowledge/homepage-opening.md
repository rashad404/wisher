> Historical first opening. Superseded by the November 12 design review in design-review-result.md. The original is preserved in docs/evidence/design/before-design-review.tar.gz.

# Homepage opening - 2026-11-12

Scope: Header and opening homepage screen only. No catalog collection, checkout, new account features, or greeting generation in this pass.

References reviewed: Elek SiteDrawer, Sayt HomeHeader, mobile-navigation and Footer, and football AppTabBar. Shared principles: logo left, account and menu right, right-side desktop drawer, full-screen mobile menu, and four edge-attached mobile navigation items with safe-area spacing. Footer grouping is a reference for later work; no footer added yet.

Wisher direction: warm paper, plum actions, rose surfaces, gift-and-card illustration, gift discovery as the primary action, greetings as secondary, and visible company navigation. Illustration and recipient choices are samples. The catalog, greeting and company actions currently explain the planned sections instead of pretending those screens are built. Account links use the existing local user entry.

Implementation: frontend/src/components/HomeOpening.tsx and HomeOpening.module.css. Only the root route uses this new component; existing user routes remain separate.

Validation: Next production build and type checks; Chrome at 375 and 1440 pixels; no horizontal overflow; recipient selection; menu opening, Escape, and scroll restoration; gift information dialog; no workspace API requests or browser page errors. Screenshots in docs/screenshots/opening-*.png.
