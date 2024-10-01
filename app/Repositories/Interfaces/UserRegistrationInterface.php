<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\RegisterRequest;
use App\Models\User;

interface UserRegistrationInterface
{
    public function registration(RegisterRequest $data): User;
    public function activation(string $token): bool;
}
