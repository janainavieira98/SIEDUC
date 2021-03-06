<?php


namespace App\Observers;


use App\Mail\WelcomeEmail;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserObserver
{
    public function creating(User $user)
    {
        $user->api_token = Str::random(60);
        $user->uuid = Str::uuid()->toString();
    }

    public function created(User $user)
    {
        try {
            Mail::to($user)->sendNow(new WelcomeEmail());
        } catch(\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
