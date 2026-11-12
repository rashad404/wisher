# Wisher rebuild

Read docs/roadmap.md and docs/feature-inventory.md. Laravel 12 backend, Next.js 15 / React 19 frontend, modeled on Elek. Never edit Elek. Read docs/knowledge/product-idea-and-plan.md for the current product direction: gifts from Azerbaijani stores, purchased on their websites initially; Wisher-owned products later. This supersedes the original digital-only restriction.

- Backend 8022, frontend 3022, both bind 0.0.0.0. Keep old reference 8020 running.
- Before every install or build run df -h /; stop below 10 GB. Delete nothing outside wisher/ or wisher-new/. No native builds or iPhone work.
- Tests use forced in-memory SQLite. Never run tests on development or production databases.
- Secrets only in ignored env files. Never print keys; never track auth.json. No production writes, DNS changes, pushes or deployments. Commit locally, plain messages, no tool/AI mentions.
- Plain ASCII punctuation, preserve Azerbaijani letters. All example domains/emails use example.com. Azerbaijani copy is draft pending owner review. Communicate in English.
- Scope every private query to its owner. Paginate, index, and rate-limit expensive work. Local demo login must be off outside local environment. Fake generation must be labeled.

Before any page, logo or brand work, read docs/knowledge/design-not-ai-looking.md.
