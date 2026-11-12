<?php
namespace App\Services;
use Carbon\CarbonImmutable;
class NextOccasion {
 public static function date(string $date, string $recurrence, string $timezone): string {
  $d=CarbonImmutable::parse($date,$timezone); $today=CarbonImmutable::today($timezone);
  if ($recurrence==='none' || $d->gte($today)) return $d->toDateString();
  $candidate=$recurrence==='yearly' ? $d->setDate($today->year,$d->month,1)->day(min($d->day,$d->setDate($today->year,$d->month,1)->daysInMonth)) : $today->startOfMonth()->day(min($d->day,$today->daysInMonth));
  if ($candidate->lt($today)) {
   $base=$recurrence==='yearly' ? $candidate->startOfMonth()->addYear() : $candidate->startOfMonth()->addMonth();
   $candidate=$base->day(min($d->day,$base->daysInMonth));
  }
  return $candidate->toDateString();
 }
}
