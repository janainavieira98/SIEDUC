<?php


namespace App\Repositories;


use App\Address;
use App\Phone;
use App\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function store($data = [])
    {
        $data = collect($data);

        return DB::transaction(function () use ($data) {
            $address = Address::create($data->only([
                'neighborhood',
                'address',
                'cep',
                'city'
            ])->toArray());

            $phone = Phone::create($data->only([
                'mobile_number',
                'home_number'
            ])->toArray());

            return User::create(array_merge(
                $data->only([
                    'name',
                    'email',
                    'birthday',
                    'rg',
                    'cpf',
                ])->toArray(),
                [
                    'password' => bcrypt($data->get('password')),
                    'gender_id' => $data->get('gender'),
                    'role_id' => $data->get('role'),
                    'address_id' => $address->id,
                    'phone_id' => $phone->id
                ]
            ));
        });
    }
}
