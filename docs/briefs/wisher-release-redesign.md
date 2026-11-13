# Brief: release the redesign to wisher.az and make releases one command

GitHub branch v2 now has the full redesign (commit 14851ec and the three redesign commits before it: account area, greetings/companies/product page, info pages/404/callback; plus removal of the old account tab strip). Release it to production now (authorised; Rashad asked for wisher.az to get every improvement).

1. Write /home/wisher/wisher-v2/deploy/release.sh (versioned in the repo under deploy/) that does a complete blue-green release from GitHub, like elek-deploy: fetch v2, prepare a release dir for the commit, link shared env and storage, composer install --no-dev, migrate (after a database backup), build the frontend in the idle slot (3022/3023), start it under PM2, health-check it, switch nginx to it (reuse switch.sh logic), keep the previous slot for instant rollback, record the release, and support `--rollback`. Disk check before builds. Runs as root only for nginx steps, everything else as wisher.
2. Use it to release 14851ec. Verify live with analytics blocked: /, /gifts, /gifts/<id>, /wishes, /companies, /about, /faq, /privacy, /terms, a 404, the kimlik login start, /user shows the warm login screen when logged out; screenshots 1440 and 375.
3. Result: docs/briefs/wisher-release-redesign.result.md with the one-line release and rollback commands.
Rules: deploy only from GitHub; never print secrets; commit locally and push deploy/release.sh to v2 before using it.
