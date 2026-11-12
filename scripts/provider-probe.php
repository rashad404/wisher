<?php
require __DIR__.'/../backend/vendor/autoload.php';
$app=require __DIR__.'/../backend/bootstrap/app.php';$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
try {
 $r=Illuminate\Support\Facades\Http::connectTimeout(3)->timeout(30)->withToken(config('wisher.deepseek_key'))->post('https://api.deepseek.com/chat/completions',['model'=>config('wisher.model'),'messages'=>[['role'=>'user','content'=>'Return JSON with a variants array of three short birthday wishes in Azerbaijani.']],'response_format'=>['type'=>'json_object'],'max_tokens'=>600,'thinking'=>['type'=>'disabled']]);
 $body=$r->json();echo json_encode(['status'=>$r->status(),'error_code'=>$r->json('error.code'),'error_type'=>$r->json('error.type'),'finish_reason'=>$r->json('choices.0.finish_reason'),'content_length'=>strlen($r->json('choices.0.message.content','')),'model'=>config('wisher.model')]);
 if(!$r->successful()){ $message=$r->json('error.message','');$message=str_replace(config('wisher.deepseek_key'),'[redacted]',$message);echo "\n".substr($message,0,350); }
} catch(Throwable $e) {echo 'Exception class: '.get_class($e);}
