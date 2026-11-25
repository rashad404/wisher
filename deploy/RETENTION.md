# Release retention

Keep only the live release after a successful switch and public health check.
Stop PM2 processes whose verified cwd or script points into old releases before
removal. Refuse cleanup while nginx or unmanaged processes still reference an
old release, or live dependencies link into it. Keep the deploy lock throughout.
Never delete shared storage, secrets, database backups or the candidate build.
Failed switch/health checks do not prune. Build logs expire after seven days.

Rollback means redeploying an earlier GitHub commit and rebuilding it, not
switching to a retained copy. Migrations must remain backward compatible.
