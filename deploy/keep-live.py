#!/usr/bin/env python3
"""Prune verified inactive releases under the deployment lock, never shared data."""
import argparse
import fcntl
import json
import os
from pathlib import Path
import re
import shutil
import subprocess
import time


def run(args, **kw):
    return subprocess.run(args, check=True, **kw)


def candidates(base, live):
    releases = base / 'releases'
    if releases.is_symlink() or live.parent != releases or not live.is_dir():
        raise RuntimeError('Live release must be a direct real releases directory')
    result = []
    for path in releases.iterdir():
        if path.is_symlink() or not path.is_dir() or not re.fullmatch(r'[a-f0-9]{7,40}', path.name):
            raise RuntimeError('Unexpected release entry: ' + str(path))
        if path != live:
            result.append(path)
    return result


def main():
    p = argparse.ArgumentParser()
    p.add_argument('--base', required=True)
    p.add_argument('--user', required=True)
    p.add_argument('--source', required=True)
    p.add_argument('--health-url', required=True)
    p.add_argument('--apply', action='store_true')
    a = p.parse_args()
    base = Path(a.base)
    if not re.fullmatch(r'/home/[a-z0-9-]+/[a-z0-9-]+', str(base)):
        raise RuntimeError('Invalid deployment base')
    # Deploy scripts pass their locked fd 9. Standalone maintenance locks itself.
    try:
        inherited = Path('/proc/self/fd/9').resolve() == base / 'deploy.lock'
    except OSError:
        inherited = False
    lock = None
    if not inherited:
        lock = open(base / 'deploy.lock', 'a')
        fcntl.flock(lock, fcntl.LOCK_EX | fcntl.LOCK_NB)
    live = (base / 'current').resolve(strict=True)
    old = candidates(base, live)
    run(['curl', '--max-time', '30', '-fsS', a.health_url, '-o', '/dev/null'])
    nginx = subprocess.check_output(['nginx', '-T'], stderr=subprocess.DEVNULL, text=True)
    for directory, dirs, files in os.walk(str(live), followlinks=False):
        for name in dirs + files:
            link = Path(directory) / name
            if link.is_symlink() and any(str(link.resolve()).startswith(str(path) + '/') for path in old):
                raise RuntimeError('Live release depends on an old release: ' + str(link))
    for path in old:
        if str(path) in nginx:
            raise RuntimeError('Inactive release still referenced by active nginx configuration: ' + str(path))
    env = dict(os.environ, PATH='/opt/cpanel/ea-nodejs22/bin:' + os.environ['PATH'])
    prefix = ['runuser', '-u', a.user, '--']
    processes = json.loads(subprocess.check_output(prefix + ['pm2', 'jlist'], env=env, text=True))
    obsolete = [r for r in processes if any(
        str(r.get('pm2_env', {}).get('pm_cwd', '')).startswith(str(path) + '/') or
        str(r.get('pm2_env', {}).get('pm_exec_path', '')).startswith(str(path) + '/')
        for path in old)]
    print(json.dumps({'live': str(live), 'remove': [str(x) for x in old],
                      'stop_pm2': [r['name'] for r in obsolete], 'apply': a.apply}), flush=True)
    if not a.apply:
        return
    for row in obsolete:
        run(prefix + ['pm2', 'delete', str(row['pm_id'])], env=env, stdout=subprocess.DEVNULL)
    run(prefix + ['pm2', 'save'], env=env, stdout=subprocess.DEVNULL)
    # Fail closed for unmanaged workers/builds, open descriptors and mapped files.
    # Never kill an unrelated process based on a port or a substring in its command.
    for attempt in range(20):
        blockers = []
        for proc in Path('/proc').glob('[0-9]*'):
            try:
                refs = [os.readlink(str(proc / 'cwd')), os.readlink(str(proc / 'exe'))]
                for fd in (proc / 'fd').iterdir():
                    try:
                        refs.append(os.readlink(str(fd)))
                    except FileNotFoundError:
                        pass
                refs.append((proc / 'maps').read_text())
                if any(str(path) + '/' in ref or ref == str(path) for ref in refs for path in old):
                    blockers.append(proc.name)
            except (FileNotFoundError, ProcessLookupError):
                pass
        if not blockers:
            break
        time.sleep(1)
    if blockers:
        raise RuntimeError('Release files still held by processes: ' + ','.join(blockers))
    for path in old:
        if (base / 'current').resolve(strict=True) != live or path == live:
            raise RuntimeError('Live release changed during cleanup')
        shutil.rmtree(str(path))
    run(prefix + ['git', '-C', a.source, 'worktree', 'prune'], env=env)
    for path in base.glob('build-*.log'):
        if path.is_file() and not path.is_symlink() and time.time() - path.stat().st_mtime > 7 * 86400:
            path.unlink()
    print('Kept only live release: ' + str(live))


if __name__ == '__main__':
    main()
