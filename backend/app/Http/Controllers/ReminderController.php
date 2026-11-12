<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\OccasionReminders;
class ReminderController {
 public function index(Request $r,OccasionReminders $service){$service->refresh($r->user());return DB::table('reminders')->join('occasions','occasions.id','=','reminders.occasion_id')->where('reminders.user_id',$r->user()->id)->where('occurrence_date','>=',now($r->user()->timezone)->toDateString())->whereColumn('occurrence_date','occasions.next_date')->select('reminders.*','occasions.title','occasions.occasion')->orderBy('occurrence_date')->paginate(20);}
 public function read(Request $r,int $id){$q=DB::table('reminders')->where('user_id',$r->user()->id)->where('id',$id);abort_unless($q->exists(),404);$q->update(['read_at'=>now()]);return ['read'=>true];}
}
