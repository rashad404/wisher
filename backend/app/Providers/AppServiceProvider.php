<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
class AppServiceProvider extends ServiceProvider {
 public function register(): void { $this->app->bind(\App\Services\WishProvider::class, fn()=>match(config('wisher.provider')) { 'deepseek'=>new \App\Services\DeepSeekWishProvider, 'fake'=>new \App\Services\FakeWishProvider, default=>throw new \RuntimeException('Invalid provider configuration') }); }
 public function boot(): void {
  if (!app()->environment(['local','testing']) && (config('wisher.demo') || config('wisher.provider')==='fake')) throw new \RuntimeException('Disable preview configuration before production');
  RateLimiter::for('auth',fn($r)=>Limit::perMinute(12)->by($r->ip()));
  RateLimiter::for('workspace',fn($r)=>Limit::perMinute(120)->by($r->user()?->id ?: $r->ip()));
  RateLimiter::for('generation',fn($r)=>Limit::perMinute(5)->by($r->user()->id));
 }
}
