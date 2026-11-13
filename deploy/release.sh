#!/usr/bin/env bash
# One-command GitHub release. Root coordinates nginx; all app work runs as wisher.
set -Eeuo pipefail
BASE=/home/wisher/v2
SRC=/home/wisher/wisher-v2
PHP=/usr/local/bin/ea-php84
export PATH=/opt/cpanel/ea-nodejs22/bin:/usr/local/bin:/usr/bin:/bin:/usr/sbin
SELF=$(realpath "$0")
app() { runuser -u wisher -- bash "$SELF" --app "$@"; }
disk() { df -h /; [ "$(df -Pk / | awk 'NR==2 {print $4}')" -ge 10485760 ]; }
slot() { case "$1" in 3022) echo wisher-web;; 3023) echo wisher-web-green;; *) exit 1;; esac; }
valid_release() { [[ "$1" =~ ^/home/wisher/v2/releases/[a-f0-9]{40}$ ]] && [ -d "$1" ]; }
current() { ln -s "$1" "$BASE/current.pending"; mv -Tf "$BASE/current.pending" "$BASE/current"; }
health() {
 local port=$1 path code
 for path in / /gifts /gifts/1 /wishes /companies /about /faq /privacy /terms /user /api/workspace/config; do
  code=$(curl --max-time 20 -sS -o "$BASE/health.json" -w '%{http_code}' "http://127.0.0.1:$port$path")
  [ "$code" = 200 ] || { echo "Health failed: $path ($code)"; return 1; }
 done
 "$PHP" -r '$d=json_decode(file_get_contents($argv[1]),true);exit(($d["demo"]??true)===false && ($d["kimlik_ready"]??false)===true ? 0:1);' "$BASE/health.json"
 code=$(curl --max-time 20 -sS -o /dev/null -w '%{http_code}' "http://127.0.0.1:$port/missing-release-check")
 [ "$code" = 404 ]
}
if [ "${1:-}" = --app ]; then
 [ "$(id -un)" = wisher ] || exit 1
 umask 077
 shift
 mode=$1; shift
 case "$mode" in
 bootstrap)
  cd "$SRC"; [ -z "$(git status --porcelain)" ] || { echo 'Server source checkout is dirty'; exit 1; }
  git fetch origin v2
  mkdir -p "$BASE/bin"
  git show origin/v2:deploy/release.sh > "$BASE/bin/release-fetched.pending"
  mv "$BASE/bin/release-fetched.pending" "$BASE/bin/release-fetched.sh"
  ;;
 resolve)
  cd "$SRC"
  ref=${1:-origin/v2}; [[ "$ref" = origin/v2 || "$ref" =~ ^[a-f0-9]{7,40}$ ]] || exit 1
  sha=$(git rev-parse --verify "$ref^{commit}")
  git merge-base --is-ancestor "$sha" origin/v2
  echo "$sha"
  ;;
 state) readlink -f "$BASE/current"; cat "$BASE/web-port";;
 previous) cat "$BASE/previous-release" "$BASE/previous-port";;
 prepare)
  sha=$1; [[ "$sha" =~ ^[a-f0-9]{40}$ ]] || exit 1
  rel="$BASE/releases/$sha"
  exec > "$BASE/build-$sha.log" 2>&1
  disk
  if [ -f "$rel/.release-ready" ]; then exit 0; fi
  if [ -e "$rel" ]; then
   [ "$(git -C "$rel" rev-parse HEAD)" = "$sha" ]
   git -C "$rel" diff --quiet HEAD -- . ":!backend/storage" ":!frontend/next-env.d.ts"
  else
   cd "$SRC"; git worktree add --detach "$rel" "$sha"
  fi
  chmod 700 "$rel"
  cd "$rel/backend"
  [ -L .env ] || ln -s "$BASE/shared/backend.env" .env
  if [ ! -L storage ]; then
   mv storage storage.release
   ln -s "$BASE/shared/storage" storage
  fi
  mkdir -p bootstrap/cache
  disk
  "$PHP" /usr/local/bin/composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader
  "$PHP" artisan config:cache
  "$PHP" artisan route:cache
  "$PHP" artisan view:cache
  cd "$rel/frontend"
  [ -L .env.production.local ] || ln -s "$BASE/shared/frontend.env" .env.production.local
  disk
  npm ci --no-audit --no-fund
  disk
  npm run build
  touch "$rel/.release-ready"
  ;;
 migrate)
  rel=$1; valid_release "$rel"
  exec > "$BASE/migrate-$(basename "$rel").log" 2>&1
  disk
  cd "$rel/backend"
  # Credentials remain in memory and a short-lived private defaults file.
  "$PHP" <<'PHP'
<?php
require 'vendor/autoload.php';
$env=Dotenv\Dotenv::parse(file_get_contents('.env'));
if (($env['DB_DATABASE']??'')!=='wisher_v2') { throw new RuntimeException('Unexpected database'); }
$dir='/home/wisher/backups/releases/'.gmdate('Ymd-His').'-'.bin2hex(random_bytes(3));
mkdir($dir,0700,true);
$quote=fn($v)=>'"'.str_replace(['\\','"',"\n","\r"],['\\\\','\\"','\\n','\\r'],$v).'"';
$cfg="$dir/client.cnf";
file_put_contents($cfg,"[client]\nuser=".$quote($env['DB_USERNAME'])."\npassword=".$quote($env['DB_PASSWORD'])."\nhost=".$quote($env['DB_HOST'])."\n");chmod($cfg,0600);
try {
 $p=proc_open(['mysqldump',"--defaults-extra-file=$cfg",'--single-transaction','--quick','--skip-lock-tables','wisher_v2'],[0=>['file','/dev/null','r'],1=>['file',"$dir/database.sql",'w'],2=>['file',"$dir/dump.log",'w']],$pipes);
 if(proc_close($p)!==0 || !filesize("$dir/database.sql"))throw new RuntimeException('Database backup failed');
 file_put_contents("$dir/SHA256SUMS",hash_file('sha256',"$dir/database.sql")."  database.sql\n");
 copy('.env',"$dir/backend.env");chmod("$dir/backend.env",0600);
 file_put_contents('/home/wisher/v2/latest-release-backup',$dir."\n");
} finally {unlink($cfg);}
PHP
  "$PHP" artisan migrate --force
  ;;
 start)
  rel=$1; port=$2; valid_release "$rel"; name=$(slot "$port")
  if [ "$(cat "$BASE/web-port")" = "$port" ]; then echo 'Refusing to replace live slot'; exit 1; fi
  if pm2 describe "$name" >/dev/null 2>&1; then pm2 delete "$name" >/dev/null; fi
  cd "$rel/frontend"
  NODE_ENV=production pm2 start node_modules/next/dist/bin/next --name "$name" --cwd "$rel/frontend" -- start -H 127.0.0.1 -p "$port" >/dev/null
  for attempt in {1..20}; do
   if curl --max-time 2 -fsS -o /dev/null "http://127.0.0.1:$port/" 2>/dev/null; then break; fi
   sleep 1
  done
  health "$port"
  curl --max-time 20 -fsS -o /dev/null "http://127.0.0.1:$port/_next/static/$(cat "$rel/frontend/.next/BUILD_ID")/_buildManifest.js"
  pm2 save >/dev/null
  ;;
 verify-build)
  valid_release "$1"; slot "$2" >/dev/null
  curl --max-time 20 -fsS -o /dev/null "http://127.0.0.1:$2/_next/static/$(cat "$1/frontend/.next/BUILD_ID")/_buildManifest.js"
  ;;
 health) health "$1";;
 activate)
  valid_release "$1"; current "$1"
  ;;
 scheduler)
  valid_release "$1"
  if pm2 describe wisher-schedule >/dev/null 2>&1; then pm2 delete wisher-schedule >/dev/null; fi
  pm2 start "$PHP" --name wisher-schedule --cwd "$1/backend" -- artisan schedule:work >/dev/null
  pm2 save >/dev/null
  ;;
 record)
  rel=$1; port=$2; prev=$3; prevport=$4
  valid_release "$rel"; valid_release "$prev"; slot "$port" >/dev/null; slot "$prevport" >/dev/null
  echo "$prev" > "$BASE/previous-release"
  echo "$prevport" > "$BASE/previous-port"
  echo "$port" > "$BASE/web-port.pending"; mv "$BASE/web-port.pending" "$BASE/web-port"
  printf '%s release=%s port=%s previous=%s previous_port=%s\n' "$(date -u +%FT%TZ)" "$rel" "$port" "$prev" "$prevport" >> "$BASE/releases.log"
  ;;
 *) exit 1;;
 esac
 exit 0
fi
[ "$(id -u)" = 0 ] || { echo 'Use the root SSH release command; application work runs as wisher.'; exit 1; }
if [ "${1:-}" != --driver ]; then
 exec 9<"$BASE/deploy.lock"
 flock -n 9 || { echo "Another deployment is running"; exit 1; }
 if [ "${1:-}" = --rollback ]; then
  runner="$BASE/bin/release-fetched.sh"
  [ -f "$runner" ] || runner="$SELF"
  exec bash "$runner" --driver --rollback
 fi
 app bootstrap
 exec bash "$BASE/bin/release-fetched.sh" --driver "$@"
fi
shift
# Existing lock, opened read-only; no root-owned application files are created.
flock -n 9 || { echo 'Run the release entry point without internal flags'; exit 1; }
mapfile -t live < <(app state)
old=${live[0]}; oldport=${live[1]}
valid_release "$old"; slot "$oldport" >/dev/null
if [ "${1:-}" = --rollback ]; then
 mapfile -t prev < <(app previous)
 rel=${prev[0]}; port=${prev[1]}
 valid_release "$rel"; slot "$port" >/dev/null
 [ "$oldport" != "$port" ]
 # Previous slot stays running, so rollback requires no install or rebuild.
 app health "$port"
 app verify-build "$rel" "$port"
else
 sha=$(app resolve "${1:-origin/v2}")
 rel="$BASE/releases/$sha"
 [ "$rel" != "$old" ] || { echo 'Requested release is already live'; exit 0; }
 port=3022; [ "$oldport" = 3022 ] && port=3023
 echo "Preparing $sha on port $port. Build log: $BASE/build-$sha.log"
 app prepare "$sha"
 app migrate "$rel"
 app start "$rel" "$port"
fi
SITE=/etc/nginx/conf.d/users/wisher/wisher.az/wisher-next.conf
API=/etc/nginx/conf.d/wisher-v2-api.conf
# Only nginx configuration and reloads below run privileged.
cp "$SITE" "$SITE.release-backup"
cp "$API" "$API.release-backup"
recover() {
 trap - ERR
 cp "$SITE.release-backup" "$SITE"
 cp "$API.release-backup" "$API"
 app activate "$old" || true
 nginx -t && nginx -s reload
 app scheduler "$old" || true
 echo 'Release failed; previous routing restored. Migrations were not reversed.' >&2
 exit 1
}
trap recover ERR
app activate "$rel"
sed -i -E "s#(CPANEL_APACHE_PROXY_PASS http://127.0.0.1:)[0-9]+#\1$port#" "$SITE"
# Absolute release paths avoid stale PHP realpath caches after the symlink swap.
sed -i -E "s#(fastcgi_param SCRIPT_FILENAME) .*;#\1 $rel/backend/public/index.php;#; s#(fastcgi_param DOCUMENT_ROOT) .*;#\1 $rel/backend/public;#" "$API"
nginx -t
nginx -s reload
app health "$port"
app scheduler "$rel"
app record "$rel" "$port" "$old" "$oldport"
trap - ERR
echo "Live: $(basename "$rel") on $port. Previous release remains running on $oldport."
