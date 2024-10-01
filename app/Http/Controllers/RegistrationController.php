<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivationRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\Interfaces\UserRegistrationInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RegistrationController extends Controller
{
    protected UserRegistrationInterface $userRegistration;

    public function __construct(UserRegistrationInterface $userRegistration)
    {
        $this->userRegistration = $userRegistration;
    }

    public function registration(RegisterRequest $request): JsonResponse
    {
        $this->userRegistration->registration($request);

        return response()->json(['message' => 'Registration is success! Please check your mail to activate your user.']);
    }

    public function activation(ActivationRequest $request): JsonResponse
    {

        $status = $this->userRegistration->activation($request->token);

        $message = 'User activated successfully!';

        if (!$status) {
            throw new NotFoundHttpException('Invalid token');
        }

        return response()->json(['message' => $message]);
    }
}
