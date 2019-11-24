<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(GendersTableSeeder::class);
        $this->call(WeekdayTableSeeder::class);
        $this->call(PeriodTableSeeder::class);
        $this->call(EnrollmentTypeSeeder::class);
    }
}
