<?php

namespace App\Repositories;

use App\Http\Requests\RegisterRequest;
use App\Mail\ActivationEmail;
use App\Models\User;
use App\Repositories\Interfaces\UserRegistrationInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserRegistrationRepository implements UserRegistrationInterface
{
    public function registration(RegisterRequest $data): User
    {
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
            'activation_token' => Str::random(60),
        ]);

        Mail::to($user->email)->send(new ActivationEmail($user));
        return $user;
    }

    public function activation(string $token): bool
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return false;
        }

        $user->is_activated = true;
        $user->activation_token = null;
        $user->save();

        return true;
    }
}
