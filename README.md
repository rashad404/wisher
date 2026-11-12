# Wisher

New Laravel 12 + Next.js 15 / React 19 application. Product direction: [docs/knowledge/product-idea-and-plan.md](docs/knowledge/product-idea-and-plan.md). Implementation scope and later phases: [docs/roadmap.md](docs/roadmap.md).

## Local preview

- Frontend: http://100.89.150.50:3022
- Backend: http://100.89.150.50:8022
- Old reference: http://100.89.150.50:8020

Use the existing ignored environment files. Do not print, copy into documentation, or commit credentials. Kimlik and DeepSeek are configured locally. Demo access is enabled only in the local environment and creates an isolated synthetic account.

```sh
cd /Users/macmini/projects/wisher-new/backend
/opt/homebrew/opt/php@8.4/bin/php artisan migrate
/opt/homebrew/opt/php@8.4/bin/php artisan serve --host=0.0.0.0 --port=8022
```

In a second terminal:

```sh
cd /Users/macmini/projects/wisher-new/frontend
npm run start
```

Before any install/build, run `df -h /` and stop if less than 10 GB is available. To rebuild the frontend after changes, stop only its own preview process, run `npm run build` from frontend, then `npm run start`.

Scheduler: `sh /Users/macmini/projects/wisher-new/scripts/scheduler.sh start` or `stop`. The portfolio restart/stop scripts have a Wisher.az (new) block, including this scheduler. Do not run the entire portfolio restart just to refresh Wisher. The scheduler creates in-app reminders hourly and refreshes up to 20 existing catalog listings daily. It sends no mail or SMS. In-app reminders also refresh when the owner opens the dashboard/reminder view.

## Validation

```sh
cd /Users/macmini/projects/wisher-new/backend
/opt/homebrew/opt/php@8.4/bin/php vendor/bin/phpunit
cd ../frontend
npm run typecheck
cd ..
node scripts/check-full.cjs
```

PHPUnit forces in-memory SQLite and blocks real provider requests in provider tests. The browser script creates isolated local synthetic accounts and uses only the explicitly labeled sample greeting mode. It does not request paid generation, send messages, or purchase products. It uses the already installed Chrome and portfolio Playwright installation; no browser download is needed.

## Catalog operations

See [docs/knowledge/catalog-operations.md](docs/knowledge/catalog-operations.md). The repository contains source provenance, not the local SQLite database. Catalog commands can reproduce the six starter listings from the recorded product URLs.

## Deployment status

Local only. No push, production migration, DNS change, deployment, mail delivery or payment was performed. Public pages remain noindex until launch review. See [docs/briefs/wisher-rebuild.result.md](docs/briefs/wisher-rebuild.result.md) for readiness gaps.
