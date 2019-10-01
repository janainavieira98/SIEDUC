<?php


namespace App\Auth;


use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class InstitutionUserProvider extends EloquentUserProvider implements UserProvider
{
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) ||
            (count($credentials) === 1 &&
                array_key_exists('password', $credentials))) {
            return;
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = $this->newModelQuery();

        foreach ($credentials as $key => $value) {
            if (Str::contains($key, 'password')) {
                continue;
            }

            if (is_array($value) || $value instanceof Arrayable) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        Log::info('tried to retrieve user');

        return $query->first();
    }
}
