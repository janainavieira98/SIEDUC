<?php

use App\Gender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Gender::count() === 0) {
            DB::transaction(function() {
                Gender::create([
                    'name' => __('gender.male'),
                    'slug' => 'male'
                ]);

                Gender::create([
                    'name' => __('gender.female'),
                    'slug' => 'female'
                ]);
            });
        }
    }
}
