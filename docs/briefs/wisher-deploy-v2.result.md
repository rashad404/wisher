# Wisher v2 deployment result

Date: 2026-11-13
Status: Live at https://wisher.az. Deployment and browser verification completed.

## Source and release

Read the brief (including the resume instruction), roadmap, feature inventory, product direction, old production audit and Elek blue-green deployment files before implementation. Preserved the current approved design and the pending gift catalog changes. Applied the product-design guidance only to the mobile overflow defect found during launch checks.

All application code was pushed to `git@github.com:rashad404/wisher.git`, branch `v2`, then fetched by the server. No application archive, rsync or scp transfer was used. Remote `main` remains `77e6b62ca71f2c050e983818ba60b994e96198a0`.

- Source checkout: `/home/wisher/wisher-v2`, tracking `origin/v2`.
- Active application release: `2a016cd04ff9f006399730ab13e4199aa0d370ca`.
- Active symlink: `/home/wisher/v2/current` -> `/home/wisher/v2/releases/2a016cd04ff9f006399730ab13e4199aa0d370ca`.
- Later commits contain deployment documentation, verification evidence and rollback tooling; they do not change the deployed application.
- SSH alias `github-wisher-v2` in `/home/wisher/.ssh/config` permanently selects `/home/wisher/.ssh/id_ed25519_wisher_v2`, with `IdentitiesOnly yes`. The server checkout uses this alias. The previously supplied deploy key now reads GitHub successfully.

## Backups and retained legacy site

Created before provisioning or switching, outside the public docroot:

| Backup | Path | Bytes |
| --- | --- | --- |
| Full old docroot | `/home/wisher/backups/v2-20261113-151220/old-docroot.tar.gz` | 18534330 |
| Old environment | `/home/wisher/backups/v2-20261113-151220/old.env` | 974 |
| Old database mysqldump | `/home/wisher/backups/v2-20261113-151220/old-database.sql` | 120639 |

The backup directory is private. Archive listing succeeded, the database dump has its completion marker, and all three SHA256 checks pass against `SHA256SUMS` in that directory. The saved environment matches the unchanged old environment. No restore into a test database was performed.

`/home/wisher/public_html` still links to `public`; the entire old application remains in its original location. The old `wisher_db` database and its user were neither migrated nor modified. No old users, orders or contacts were imported.

## One-step rollback

From the Mac:

```sh
ssh -p 21098 root@203.161.35.63 'bash /home/wisher/wisher-v2/deploy/switch.sh --rollback'
```

This disables only `/etc/nginx/conf.d/users/wisher/wisher.az/wisher-next.conf`, checks nginx configuration and reloads nginx. The unchanged cPanel configuration resumes serving the original Laravel site and database. It does not restore SQL over either database. V2 data remains intact and its scheduler continues using only the v2 database. The command is syntax-checked; public traffic was not deliberately switched back to the legacy site for a rehearsal.

To return to v2 after rollback:

```sh
ssh -p 21098 root@203.161.35.63 'bash /home/wisher/wisher-v2/deploy/switch.sh'
```

The script reads the active frontend port from `/home/wisher/v2/web-port` (3023), checks both services and then reinstalls the domain include. Use the source-checkout script above, not the older copy inside a release.

## Production configuration

- MariaDB database and user: `wisher_v2`, created through cPanel. All migrations completed. Zero users and five products at launch. No sample accounts or demo seeds.
- Laravel 12 uses PHP 8.4 through cPanel's existing FPM service. Dedicated pool configuration: `/opt/cpanel/ea-php84/root/etc/php-fpm.d/wisher-v2.conf`. Workers run as `wisher`, listening on `127.0.0.1:9022`.
- Private nginx API: `127.0.0.1:8022`, configuration `/etc/nginx/conf.d/wisher-v2-api.conf`. All requests enter Laravel's public index. No public API subdomain or DNS changes were needed. This avoids an additional public API surface and certificate while preserving the existing Next proxy and authentication boundaries.
- Next.js production build: PM2 application `wisher-web-green`, user `wisher`, on `127.0.0.1:3023`. The earlier `wisher-web` slot on 3022 is retained as a stopped fallback after verification.
- Domain include proxies the existing cPanel HTTPS host to Next, disables proxy caching, redirects HTTP to HTTPS and www to apex. Existing valid TLS certificate retained. Certificate-validation paths continue to use the old docroot.
- PM2 application `wisher-schedule` runs `artisan schedule:work` as `wisher`. Hourly occasion reminders and daily bounded catalog refresh at 04:00 application time (UTC). No recipient messaging is scheduled.
- PM2 state saved. The `wisher` crontab restores PM2 at reboot; the cPanel PHP 8.4 FPM service is enabled at boot.
- Secrets: `/home/wisher/v2/shared/backend.env` and `frontend.env`, mode 600, linked into the release. The v2 tree and shared directory are private to `wisher`. Runtime storage persists under `/home/wisher/v2/shared/storage`.
- `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://wisher.az`, secure cookies, production-only allowed origin, `WISHER_DEMO=false`, `WISH_PROVIDER=deepseek`, mail driver `log`. Existing Kimlik and DeepSeek credentials were copied silently; a new application key and database password were generated. No keys were printed or tracked.

A standalone, unprivileged PHP FPM master crashed during pre-switch checks. It was stopped and removed from PM2. The dedicated cPanel-managed pool resolved the issue; no shared PHP settings or other applications' pool configurations were changed.

## Catalog, routes and indexing

Imported only reviewed products 1, 2, 4, 5 and 6: LEGO bamboo, JBL speaker, Tognana coffee maker, Fujifilm camera and Ttec power bank. All five were refreshed successfully against their retailer source. The LEGO watering can is absent from the production database.

- `/gifts`, `/wishes` and `/user` remain their new equivalents.
- `/login` and `/register` permanently redirect to `/user`, whose login action opens Kimlik.
- Unknown legacy paths receive the new application's 404. The old credential endpoint was checked by HTTP status only and returns 404; its response body was not inspected.
- Production middleware returns 404 for `/az/concepts/*` and `/concepts/*.html`. Approved product and occasion artwork remains available to the current pages.
- Public titles/descriptions, canonical URLs, permissive public robots rules and sitemap are enabled only in the production configuration. Private account and callback pages remain noindex. The sitemap lists home, gifts, wishes, companies and information pages.

## Verification and screenshots

- Backend: 27 tests, 153 assertions, all passed with forced in-memory SQLite. No tests ran against either server database.
- Frontend type check and production builds passed. Disk checks preceded installs and builds; free space stayed above 10 GB.
- Live browser checks block analytics before navigation in every context, including popups. The in-app browser execution tool was unavailable, so checks used existing Playwright and installed Chrome.
- 22 successful page checks: home, gifts, product 1, wishes, companies, about, FAQ, privacy, terms, account login and 404, each at 1440 and 375. No horizontal overflow or JavaScript page errors. Mobile menu opens and closes.
- Correct Kimlik popup host, PKCE S256 and callback `https://wisher.az/az/auth/kimlik/callback` verified. Full identity consent and account creation were not performed.
- Demo configuration is false and its endpoint returns 404. DeepSeek configuration is active. No wishes were generated and no paid API calls, emails, SMS or purchases were made.
- HTTPS certificate validation succeeds. HTTP and www variants return 308 to the HTTPS apex. Concept pages return 404. Robots and sitemap return the expected public configuration.
- Found and fixed mobile catalog overflow: search now stacks and occasion tiles use two columns. Desktop styling is preserved. Rebuilt from GitHub and switched from the earlier frontend slot after health checks.
- The old local reference on port 8020 still returns 200. Elek files were not edited.

Evidence: [browser checks](../evidence/deploy-v2-checks.json), [HTTP/TLS checks](../evidence/deploy-v2-http.json), [verification script](../../deploy/verify-live.cjs).

Screenshots were opened and visually inspected. Full set: `docs/screenshots/deploy-v2/`.

- Home: [1440](../screenshots/deploy-v2/home-1440.png), [375](../screenshots/deploy-v2/home-375.png).
- Gifts: [1440](../screenshots/deploy-v2/gifts-1440.png), [375](../screenshots/deploy-v2/gifts-375.png).
- Mobile menu: [375](../screenshots/deploy-v2/menu-375.png).

## Remaining product work

Alert.az SMS/email delivery is still unimplemented; mail remains logged and reminders are in-app. The existing privacy/terms text still describes a preview and needs owner/legal review. Azerbaijani copy remains draft. Full authenticated production workflows and a paid DeepSeek generation were not exercised in this deployment. English/Russian public UI is not implemented; the active Azerbaijani Kimlik callback was verified. No scalability claim or migration of legacy account data is made.

`deploy/prepare.sh` prepares a GitHub release; it is not a complete unattended future deployment command. Future releases need a fresh database backup, an idle frontend slot, health checks and an explicit proxy switch. After cPanel rebuilds, verify that the custom private API include and dedicated PHP pool remain loaded.
