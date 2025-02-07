<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRegistrationInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Response;

class UserRepository implements UserRepositoryInterface
{
    public function getUser(): mixed
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], Response::HTTP_NOT_FOUND);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }

        return $user;
    }
}
