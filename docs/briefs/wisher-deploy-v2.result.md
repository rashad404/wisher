# Wisher v2 deployment result

Date: 2026-11-13
Status: Stopped at the mandatory GitHub deploy-key gate. The production switch has not happened.

## Blocking condition

Read the deployment brief, the old production audit, and Elek's blue-green deployment README, wrapper and deployment script. Checked the server as the `wisher` account, with its working directory set to `/home/wisher`.

The read-only repository check failed:

```text
git@github.com: Permission denied (publickey).
fatal: Could not read from remote repository.
```

The brief requires: "If the server cannot read GitHub (deploy key missing), generate a read-only deploy key for the `wisher` account, put the public key in the result and STOP". Followed that stop condition. No alternate code transfer was used.

## Action needed from the lead / Rashad

Add this public key in [rashad404/wisher deploy keys](https://github.com/rashad404/wisher/settings/keys):

- Suggested title: `wisher-v2-readonly`
- Leave **Allow write access** unchecked. Read-only access is assigned by GitHub when the key is registered.

```text
ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIAEEjU6/bsdnib8jp/gXpPRrzDzUOqb/BJQg4o+Bv2GS wisher-v2-readonly
```

The private key was generated directly as `wisher` and remains only at `/home/wisher/.ssh/id_ed25519_wisher_v2`, mode 600. Public key: `/home/wisher/.ssh/id_ed25519_wisher_v2.pub`. Existing SSH keys were preserved. The new key has not been installed as the default identity or tested after GitHub registration, which is still pending.

After registration, resume with an explicit identity:

```sh
ssh -p 21098 root@203.161.35.63 'runuser -u wisher -- sh -c '\''cd /home/wisher && GIT_SSH_COMMAND="ssh -i /home/wisher/.ssh/id_ed25519_wisher_v2 -o IdentitiesOnly=yes -o BatchMode=yes" git ls-remote git@github.com:rashad404/wisher.git HEAD'\'''
```

## State left intact

- Production docroot is `/home/wisher/public_html`, a symlink to `public`; resolved target `/home/wisher/public`.
- Old environment file exists at `/home/wisher/.env`; contents were not printed.
- Server filesystem has approximately 292 GB available.
- Local read-only GitHub check found `main`; `v2` did not yet exist. No branch was pushed, and `main` was not changed.
- No production files, database, proxy, DNS, TLS, cron, PM2 applications or application environment were changed. Only the new SSH key pair was created.
- No production or local paid API calls, messages, test accounts or purchases were made.

## Backup and rollback status

Backups have not been created because work stopped before deployment preparation. There are no backup paths to report yet. The old app and database remain in their original locations and have not been changed.

Rollback is currently unnecessary: the old site is still the configured production site. No switch-back command is claimed or supplied for a switch that has not been implemented. On resumption, create and verify the full old docroot backup, separate old `.env` backup, and old database dump outside `public_html` before any production switch; record their exact paths and the tested one-step rollback command here.

## Remaining deployment work

Once the key is added, continue the original brief: preserve the current working-tree design changes, prepare the production-safe application, push its own history to `v2`, pull from GitHub as `wisher`, create backups and rollback tooling, provision a separate v2 database/user, select/configure the PHP 8.4 API topology, build and run Next under PM2, install the scheduler, import only approved curated products excluding the LEGO watering can, disable demo access, block concept pages, add legacy redirects and production SEO, and verify the HTTPS switch with analytics blocked in browser contexts.

No live v2 screenshots or launch verification are claimed. Alert.az email/SMS remains unimplemented; production mail should stay on log as required by the brief.
