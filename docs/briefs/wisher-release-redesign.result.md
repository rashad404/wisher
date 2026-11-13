# Redesign release result

Released `14851ec7a297caf949c27447f8495fcd4b31eb23` to https://wisher.az on 2026-11-13. The application was built from GitHub branch `v2`, without application edits on the server.

## One-command operations

Release the latest GitHub `v2`:

```sh
ssh -p 21098 root@203.161.35.63 'bash /home/wisher/wisher-v2/deploy/release.sh'
```

Release a specific commit on `v2` (the command used for this release):

```sh
ssh -p 21098 root@203.161.35.63 'bash /home/wisher/wisher-v2/deploy/release.sh 14851ec'
```

Roll back to the retained previous release:

```sh
ssh -p 21098 root@203.161.35.63 'bash /home/wisher/wisher-v2/deploy/release.sh --rollback'
```

Rollback uses the cached deployment script and running previous slot, without fetching GitHub or rebuilding. It checks the previous slot's routes and build manifest before switching. It switches application code and routing, not the database. Future migrations must remain compatible with the previous application version. The previous slot is retained until another release needs that idle slot.

## Release state

- Current: `/home/wisher/v2/releases/14851ec7a297caf949c27447f8495fcd4b31eb23`, port 3022.
- Previous: `/home/wisher/v2/releases/2a016cd04ff9f006399730ab13e4199aa0d370ca`, port 3023, still running.
- Shared private configuration and storage: `/home/wisher/v2/shared`.
- Verified database backup before migrations: `/home/wisher/backups/releases/20261113-202044-45e721/`. SQL checksum and dump completion marker checked. Credentials remain private on the server.
- Release history: `/home/wisher/v2/releases.log`.
- Private build and migration logs: `/home/wisher/v2/build-14851ec7a297caf949c27447f8495fcd4b31eb23.log` and `/home/wisher/v2/migrate-14851ec7a297caf949c27447f8495fcd4b31eb23.log`.

`deploy/release.sh` was committed and pushed to GitHub `v2` before use. It fetches the branch, validates the requested commit, prepares a detached release directory, links shared configuration/storage, installs production Composer dependencies, builds Next.js, backs up `wisher_v2`, migrates, starts the idle PM2 slot, checks health, switches nginx, restarts the scheduler, and records the previous release. Every install/build is guarded by the 10 GB disk minimum. Application operations run as `wisher`; privileged nginx changes run through the root entry point. A deployment lock prevents concurrent releases. Routing failures trigger restoration of the previous nginx configuration and application target.

## Verification

- Production Next.js build and type checks passed. An initial font-loader failure was resolved by retrying the same source; no application code was changed.
- Local backend tests passed: 27 tests, 153 assertions, forced in-memory SQLite.
- Shell and verification-script syntax checks passed.
- Live checks passed for 22 page views: `/`, `/gifts`, `/gifts/1`, `/wishes`, `/companies`, `/about`, `/faq`, `/privacy`, `/terms`, `/user`, and a missing page, each at 1440 and 375 pixels.
- Screenshots were captured and visually reviewed at both widths. No page-level horizontal overflow was found.
- `/user` displays the warm logged-out screen, the Kimlik button, and no old account tab strip.
- Header login opens the Kimlik popup with the production callback and PKCE S256. Authentication was checked through login start, without completing consent or creating an account.
- Mobile menu opens and closes. Missing pages and old concept URLs return 404. Login/register redirect to `/user`. Robots and sitemap respond successfully.
- Workspace configuration reports Kimlik ready, demo login disabled, and DeepSeek as provider. Demo login endpoint returns 404. No paid generation, SMS, or email calls were made.
- Both current and retained previous frontends serve their respective build manifests. Rollback readiness was checked without temporarily reverting the public site.
- Analytics requests were blocked in every browser context before navigation, including the popup. HTTP health checks do not execute analytics scripts.

An initial browser pass reported one React hydration error without a route attached. Error reporting was improved to include the URL, and the complete repeat pass finished with zero browser errors. The first warning was not reproduced; its cause remains unconfirmed.

FAQ/legal pages retain the requested commit's `salam@example.com` placeholder and draft legal copy. Azerbaijani copy remains pending owner review. This release does not certify authenticated account flows or external gift checkout.

Evidence: [live checks](../evidence/release-redesign-checks.json), [all screenshots](../screenshots/release-redesign/), [desktop account](../screenshots/release-redesign/user-1440.png), [mobile account](../screenshots/release-redesign/user-375.png).

The legacy database, old application reference, and Elek source were not changed. No DNS changes were needed.
