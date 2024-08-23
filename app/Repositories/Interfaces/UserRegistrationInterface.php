<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRegistrationInterface
{
    public function register(array $data): User;
}
