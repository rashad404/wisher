# Brief: deploy the new Wisher (wisher-new) to wisher.az

Rashad, 2026-11-13: "deploy current version to wisher.az, I know it is not ready, but at least better than the current one." This brief authorises the production switch described here.

## Current production
- Server ssh -p 21098 root@203.161.35.63 (cPanel). Account `wisher`, docroot /home/wisher/public_html, old Laravel 10 app (see wisher/docs/audit.md, section on production). DNS for wisher.az is served by ns1/ns2.websiteca.com (this server), apex A 203.161.35.63, www aliases apex.
- Old code repo: git@github.com:rashad404/wisher.git (main).

## Rules (hard)
- Deploy ONLY from GitHub: push first, the server pulls. Push wisher-new to the same repo as a new branch `v2` (its own history; do not touch main). If the server cannot read GitHub (deploy key missing), generate a read-only deploy key for the `wisher` account, put the public key in the result and STOP so the lead can ask Rashad to add it in GitHub; do not work around it with archives, rsync or scp.
- Back up first, outside public_html: the full old docroot, the old app's .env, and a mysqldump of the old database (keep it; do not drop or modify the old database). Record paths.
- One-step rollback: keep the old site intact on disk and document the exact command to switch back.
- Never print secrets. Run things as the `wisher` user, not root (except cPanel/DNS/AutoSSL admin steps).

## Target setup (follow the Elek pattern where it fits: elek/deploy/bluegreen)
- New MariaDB database and user for v2 (cPanel), migrations run, no demo/sample accounts; local demo login must be off in production.
- Backend (Laravel 12, PHP 8.4 via ea-php84) served on api.wisher.az (create the subdomain and DNS record in this server's cPanel; AutoSSL certificate) with docroot backend/public; or, if simpler and equally solid, keep the API private on localhost behind the Next.js proxy and do not expose it. Pick one, explain.
- Frontend (Next.js 15) production build run under PM2 as `wisher`, on a free local port, with wisher.az and www.wisher.az proxied to it (nginx/Apache config consistent with how Elek's frontend is proxied), HTTPS, HTTP->HTTPS and www->apex redirects.
- Env: production .env files from the local ones minus local-only values: APP_URL https://wisher.az, KIMLIK client already registered with https://wisher.az/{az,en,ru}/auth/kimlik/callback (copy KIMLIK_CLIENT_ID/SECRET from the local env silently), DEEPSEEK keys, mail via log until Alert.az is set, scheduler (reminders hourly, catalog refresh daily) via PM2 or ugn-style crontab for the wisher account.
- Catalog: the current curated products only (not the LEGO watering can). Concept pages (/az/concepts/*, /concepts/*.html) must not be public: block or remove them in production (noindex at minimum).
- Old URLs: add redirects for the main old paths to their new equivalents (/gifts, /wishes, /login, /register -> new login, /user -> /user) so links do not 404; everything else from the old app returns the new 404 page.
- SEO: real title/description, robots allowing the public pages, sitemap for home, gifts and info pages.

## Verify and report
- Live checks (with analytics blocked in browser checks): https://wisher.az home, /gifts, a product, /wishes, login button goes to kimlik.az with the right callback, 404 page, www and http redirects, TLS valid, no concept pages exposed, no demo login. Screenshots at 1440 and 375.
- Result: docs/briefs/wisher-deploy-v2.result.md with backup paths, rollback command, what was set up, URLs, anything still missing (for example Alert.az email/SMS).
- Commit locally with plain messages, no AI mentions.

## Resume (lead, 2026-11-13)
Rashad added the deploy key. Verified: the wisher account can read git@github.com:rashad404/wisher.git with /home/wisher/.ssh/id_ed25519_wisher_v2 (IdentitiesOnly). Continue the deployment from where you stopped: push v2, backups, database, setup, switch, verify. Configure the server checkout to use that key permanently (ssh config Host alias for the wisher account).
