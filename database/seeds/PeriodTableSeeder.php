<?php

use App\Period;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Period::count() == 0) {
            DB::transaction(function () {
                $periods = collect([
                    'morning',
                    'evening',
                    'night',
                    'all_day'
                ]);

                $periods->each(function ($period) {
                    Period::create([
                        'slug' => $period
                    ]);
                });
            });
        }
    }
}
