<?php

use App\EnrollmentType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnrollmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $enrolmentTypes = [
                'transference',
                'initial enrollment',
                'renew'
            ];

            foreach ($enrolmentTypes as $enrolmentType) {
                if (!EnrollmentType::where('description', $enrolmentType)->exists()) {
                    EnrollmentType::create([
                        'description' => $enrolmentType
                    ]);
                }
            }
        });
    }
}
