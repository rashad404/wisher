<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\User;
use App\Services\OccasionReminders;
class RefreshOccasions extends Command {
 protected $signature='occasions:refresh';protected $description='Roll recurring dates forward and create idempotent in-app reminders';
 public function handle(OccasionReminders $service):int{User::whereHas('occasions')->chunkById(100,function($users)use($service){foreach($users as $u)$service->refresh($u);});$this->info('In-app reminders refreshed. No email or SMS sent.');return self::SUCCESS;}
}
