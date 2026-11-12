<?php
use Illuminate\Support\Facades\Schedule;
Schedule::command('occasions:refresh')->hourly()->withoutOverlapping();
// Bounded refresh of products already admitted by an operator.
Schedule::command('catalog:refresh --limit=20')->dailyAt('04:00')->withoutOverlapping();
