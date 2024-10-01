<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserAuthenticationInterface;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthRepository implements UserAuthenticationInterface
{
    public function login(array $credentials): mixed
    {

        if (! $token = JWTAuth::attempt($credentials)) {
            throw new NotFoundHttpException('Invalid credentials');
        }

        return $token;
    }

    public function logout(string $token): bool
    {
        try {
            JWTAuth::setToken($token)->invalidate();
            return true;
        } catch (JWTException $e) {
            return false;
        }
    }

    public function getAuthenticatedUser(): void
    {
    }
}
