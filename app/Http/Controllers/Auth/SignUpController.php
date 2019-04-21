<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\SignUpRequest;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class SignUpController extends Controller
{
    protected $jwt;

    public function __construct(AuthController $auth)
    {
        $this->jwt = $auth;
    }

    /**
     * @param RegistersUsers $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(SignUpRequest $request)
    {
        User::create($request->all());

        return $this->jwt->login();
    }
}
