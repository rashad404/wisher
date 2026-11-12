<?php
namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class OccasionReminders {
 public function refresh(User $user):void{
  $today=now($user->timezone)->toDateString();$until=now($user->timezone)->addDays(7)->toDateString();
  $user->occasions()->where('recurrence','!=','none')->where('next_date','<',$today)->chunkById(100,function($rows)use($user){foreach($rows as $o)$o->update(['next_date'=>NextOccasion::date($o->date,$o->recurrence,$user->timezone)]);});
  $user->occasions()->whereBetween('next_date',[$today,$until])->chunkById(100,function($rows)use($user){foreach($rows as $o)DB::table('reminders')->insertOrIgnore(['user_id'=>$user->id,'occasion_id'=>$o->id,'occurrence_date'=>$o->next_date,'created_at'=>now(),'updated_at'=>now()]);});
 }
}
