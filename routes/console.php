<?php

use App\Address;
use App\Gender;
use App\Phone;
use App\Role;
use App\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('create-admin', function() {
    DB::transaction(function() {
        $address = Address::create(config('auth.admin.address'));
        $phone = Phone::create(config('auth.admin.phone'));
        $user = User::create(array_merge(config('auth.admin.user'), [
            'address_id' => $address->id,
            'phone_id' => $phone->id,
            'gender_id' => Gender::male()->first()->id,
            'role_id' => Role::secretary()->first()->id,
            'password' => bcrypt(config('auth.admin.user.password'))
        ]));

        $this->comment('usuario administrador criado com sucesso');
    });
});
