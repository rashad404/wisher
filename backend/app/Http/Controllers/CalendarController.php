<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\CarbonImmutable;
class CalendarController {
 public function index(Request $r){
  $d=$r->validate(['month'=>'required|date_format:Y-m']);$start=CarbonImmutable::parse($d['month'].'-01',$r->user()->timezone);$end=$start->endOfMonth();$events=[];
  $r->user()->occasions()->where('date','<=',$end->toDateString())->where(function($q)use($start){$q->where('recurrence','!=','none')->orWhere('date','>=',$start->toDateString());})->chunkById(100,function($rows)use(&$events,$start){foreach($rows as $o){$original=CarbonImmutable::parse($o->date);if($o->recurrence==='yearly'&&$original->month!==$start->month)continue;$day=min($original->day,$start->daysInMonth);$date=$o->recurrence==='none'?$o->date:$start->day($day)->toDateString();$events[]=['id'=>$o->id,'title'=>$o->title,'date'=>$date,'occasion'=>$o->occasion];}});
  usort($events,fn($a,$b)=>strcmp($a['date'],$b['date']));return ['events'=>$events];
 }
}
