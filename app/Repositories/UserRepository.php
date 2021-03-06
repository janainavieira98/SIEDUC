<?php


namespace App\Repositories;


use App\Address;
use App\Phone;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository
{
    public static $model = User::class;

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
                    'cpf'
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

    public function update(User $user, $data = [])
    {
        $data = collect($data);

        return DB::transaction(function () use ($data, $user) {
            $phoneData = $data->only(['mobile_number', 'home_number'])->toArray();
            $addressData = $data->only([
                'neighborhood',
                'address',
                'cep',
                'city'
            ])->toArray();

            $user->phone()->update($phoneData);
            $user->address()->update($addressData);
            $user->update(array_merge(
                $data->only([
                    'name',
                    'email',
                    'birthday',
                    'rg',
                    'cpf',
                    'status'
                ])->toArray(),
                [
                    'gender_id' => $data->get('gender'),
                    'role_id' => $data->get('role'),
                ]
            ));

            return $user->fresh();
        });
    }

    public function searchable(): array
    {
        return ['name', 'email', 'cpf', 'rg'];
    }
}
