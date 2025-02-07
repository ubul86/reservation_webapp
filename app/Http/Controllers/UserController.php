<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUser(): JsonResponse
    {
        $user = $this->userRepository->getUser();

        return response()->json(compact('user'));
    }
}
