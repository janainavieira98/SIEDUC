<?php

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'teacher' => 'professor',
            'secretary' => 'secretario',
            'director' => 'diretor'
        ];

        DB::transaction(function () use ($roles) {
            foreach ($roles as $slug => $name) {
                if (!Role::where('slug', $slug)->exists()) {
                    Role::create([
                        'slug' => $slug,
                        'name' => $name
                    ]);
                }
            }
        });
    }
}
