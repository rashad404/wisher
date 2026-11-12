<?php
return [
 'provider' => env('WISH_PROVIDER', 'fake'),
 'deepseek_key' => env('DEEPSEEK_API_KEY'),
 'price_in' => (float) env('DEEPSEEK_PRICE_IN', 0),
 'price_out' => (float) env('DEEPSEEK_PRICE_OUT', 0),
 'model' => env('DEEPSEEK_MODEL', 'deepseek-chat'),
 'demo' => env('WISHER_DEMO', false),
 'daily_limit' => (int) env('WISH_DAILY_LIMIT', 10),
 'global_daily_limit' => (int) env('WISH_GLOBAL_DAILY_LIMIT', 100),
];
