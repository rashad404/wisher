<?php
return [
 'url' => env('KIMLIK_URL', 'https://kimlik.az'),
 'api_url' => env('KIMLIK_API_URL', 'https://api.kimlik.az/api'),
 'client_id' => env('KIMLIK_CLIENT_ID'), 'client_secret' => env('KIMLIK_CLIENT_SECRET'),
 'origins' => array_filter(explode(',', env('WISHER_ORIGINS', 'http://100.89.150.50:3022,https://wisher.az'))),
];
