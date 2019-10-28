<?php


use App\Weekday;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeekdayTableSeeder extends Seeder
{
    public function run()
    {
        if (Weekday::count() == 0) {
            DB::transaction(function () {
                $days = collect([
                    "monday",
                    "tuesday",
                    "wednesday",
                    "thursday",
                    "friday",
                    "saturday",
                    "sunday",
                ]);

                $days->each(function($day) {
                   Weekday::create(['slug' => $day]);
                });
            });
        }
    }
}
