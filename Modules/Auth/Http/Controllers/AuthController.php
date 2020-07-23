<?php

namespace Modules\Auth\Http\Controllers;

use Tymon\JWTAuth\JWTAuth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\Auth\Http\Requests\AuthRequest;
use Modules\Common\Exceptions\AuthenticationFailedException;

/**
 * Class AuthController
 *
 * @package Modules\Auth\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * @var JWTAuth
     */
    private $jwtAuth;

    /**
     * AuthController constructor.
     * @param JWTAuth $jwtAuth
     */
    public function __construct(JWTAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }

    /**
     * @param AuthRequest $request
     * @return mixed
     * @throws AuthenticationFailedException
     */
    public function login(AuthRequest $request)
    {
        if (!$token = $this->jwtAuth->attempt($request->only('username', 'password'))) {
            
            Log::error('Failed authentication attempt',[$request->only('username', 'password')]);

            throw new AuthenticationFailedException('Invalid Credentials !!', 401);
        }

        return response()->jsend(['access_token' => $token], 'User authenticated successfully');
    }
}
