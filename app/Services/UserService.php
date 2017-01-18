<?php
namespace App\Services;

use App\Mail\UserRegistration;
use App\User;
use Illuminate\Support\Facades\Mail;

class UserService
{
    public function sendRegistrationEmail(User $user)
    {
        Mail::to($user->email)->send(new UserRegistration($user));
    }
}
