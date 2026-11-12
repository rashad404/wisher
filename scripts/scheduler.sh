#!/bin/sh
set -eu
WISHER_ROOT=$(CDPATH= cd -- "$(dirname -- "$0")/.." && pwd)
WISHER_PIDFILE="$WISHER_ROOT/.scheduler.pid"
WISHER_PHP=/opt/homebrew/opt/php@8.4/bin/php
WISHER_ARTISAN="$WISHER_ROOT/backend/artisan"
if [ -f "$WISHER_PIDFILE" ]; then
 WISHER_PID=$(cat "$WISHER_PIDFILE")
 WISHER_COMMAND=$(ps -p "$WISHER_PID" -o command= 2>/dev/null || true)
 case "$WISHER_COMMAND" in
  *"$WISHER_ARTISAN schedule:work"*)
   if [ "${1:-start}" = stop ]; then kill "$WISHER_PID"; rm -f "$WISHER_PIDFILE"; else echo "Wisher scheduler already running"; fi
   exit 0;;
 esac
 rm -f "$WISHER_PIDFILE"
fi
if [ "${1:-start}" = stop ]; then exit 0; fi
cd "$WISHER_ROOT/backend"
nohup "$WISHER_PHP" "$WISHER_ARTISAN" schedule:work > "$WISHER_ROOT/preview-scheduler.log" 2>&1 < /dev/null &
echo $! > "$WISHER_PIDFILE"
echo "Wisher local scheduler started"
