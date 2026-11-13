# Rules for every redesign helper (lead: Claude)

Read first: /Users/macmini/projects/knowledge/skills/product-design/SKILL.md, /Users/macmini/projects/knowledge/skills/product-design/modern-vs-template.md, /Users/macmini/projects/wisher-new/docs/design-system.md. Study the approved pages in code and in the browser: home (frontend/src/components/HomePage.tsx + HomePage.module.css) and /gifts (GiftsOpening.tsx + GiftsOpening.module.css), local preview http://100.89.150.50:3022.

- Redesign the assigned pages so they belong to the same system as the approved home and /gifts. Keep all existing functionality and API calls working (frontend/src/lib/workspace.ts, the /api/workspace proxy); change presentation, layout, copy clarity and UX, not backend contracts.
- Each page gets its own CSS module. Do NOT edit shared files (SiteShell, globals.css, HomePage.*, GiftsOpening.*, lib/*, the api route) except to import; if a shared change is truly needed, describe it in your report instead.
- Render-look-fix loop: after every change, screenshot with Playwright (require('/Users/macmini/projects/elek/frontend/node_modules/playwright'), chromium channel 'chrome'), block analytics routes (googletagmanager|google-analytics|doubleclick|facebook) in every context, LOOK at the screenshot, fix. Desktop 1440 first, then 375 mobile.
- Logged-in pages locally: POST http://100.89.150.50:3022/api/workspace/auth/demo through the browser context (it sets the session cookie) before visiting /user pages. Local only.
- Native Azerbaijani copy, plain ASCII punctuation, example.com for invented emails/domains, label sample data "Nümunə". 12.5px text floor, 44px touch targets, visible focus, no horizontal scroll.
- Check the page against modern-vs-template.md sections 3 and 4 before you finish; no house-style items, no grey admin forms, no native date inputs.
- Run `npm run build` in frontend/ at the end (disk check: df -h / must show >= 10 GB). Commit locally with a plain message, no AI mentions. Do not deploy.
- Save screenshots to /Users/macmini/projects/wisher-new/docs/screenshots/redesign/<your-group>/ (desktop and mobile for every page) and finish with a short report: pages done, what changed, anything you could not do.
