#!/usr/bin/env bash
# cPanel nginx administration only. Runtime commands run separately as wisher.
set -euo pipefail
[ "$(id -u)" = 0 ] || exit 1
DIR=/etc/nginx/conf.d/users/wisher/wisher.az
FILE="$DIR/wisher-next.conf"
BASE=/home/wisher/v2
if [ "${1:-}" = --rollback ]; then
    [ -f "$FILE" ] || { echo 'Legacy proxy already active'; exit 0; }
    mv "$FILE" "$FILE.disabled"
    if ! nginx -t; then mv "$FILE.disabled" "$FILE"; exit 1; fi
    nginx -s reload
    echo 'Legacy site restored; old files and database were never changed.'
else
    [ ! -f "$FILE" ] || { echo 'Already switched'; exit 1; }
    curl -fsS -o /dev/null http://127.0.0.1:8022/up
    curl -fsS -o /dev/null http://127.0.0.1:3022/
    mkdir -p "$DIR"
    cp "$BASE/current/deploy/nginx-site.conf" "$FILE"
    if ! nginx -t; then mv "$FILE" "$FILE.disabled"; exit 1; fi
    nginx -s reload
    echo 'Wisher v2 public proxy active.'
fi
