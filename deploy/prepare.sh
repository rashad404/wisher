#!/usr/bin/env bash
set -euo pipefail
[ "$(id -un)" = wisher ] || { echo 'Run as wisher'; exit 1; }
export PATH=/opt/cpanel/ea-nodejs22/bin:/usr/local/bin:/usr/bin:/bin
BASE=/home/wisher/v2
SOURCE=/home/wisher/wisher-v2
PHP=/usr/local/bin/ea-php84
check_disk() { df -h /; [ "$(df -Pk / | awk 'NR==2 {print $4}')" -ge 10485760 ]; }
exec 9>"$BASE/deploy.lock"
flock -n 9
cd "$SOURCE"
git fetch origin v2
SHA=$(git rev-parse origin/v2)
REL="$BASE/releases/$SHA"
[ ! -d "$REL" ] || { echo 'Release already prepared; inspect it before proceeding'; exit 1; }
git worktree add --detach "$REL" "$SHA"
cd "$REL/backend"
ln -s "$BASE/shared/backend.env" .env
mkdir -p "$BASE/shared/storage"/framework/{cache/data,sessions,views} "$BASE/shared/storage/logs" bootstrap/cache
mv storage storage.release
ln -s "$BASE/shared/storage" storage
chmod 700 "$BASE" "$REL/backend"
check_disk
"$PHP" /usr/local/bin/composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader
"$PHP" artisan config:cache
"$PHP" artisan route:cache
"$PHP" artisan view:cache
cd "$REL/frontend"
ln -s "$BASE/shared/frontend.env" .env.production.local
check_disk
npm ci --no-audit --no-fund
check_disk
npm run build
# A separate v2 database only; no migration of legacy users or orders.
cd "$REL/backend"
"$PHP" artisan migrate --force
ln -s "$REL" "$BASE/current.next"
mv -Tf "$BASE/current.next" "$BASE/current"
echo "Prepared $SHA. Public proxy unchanged."
