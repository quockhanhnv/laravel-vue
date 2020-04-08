<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login()
    {
        try {
            $credentials = request()->only(['email', 'password']);

            $token = auth()->attempt($credentials);

            if (!$token) {
                return response()->json([
                    'errors' => [
                        'status'  => false,
                        'code'    => Response::HTTP_UNAUTHORIZED,
                        'message' => 'Unauthorized',
                    ]
                ]);
            }

            return $this->respondWithToken($token);

        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'status'  => false,
                    'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                ]
            ]);
        }
    }

    public function logout()
    {
        try {
            auth()->logout();

            return response()->json([
                'status'  => true,
                'code'    => Response::HTTP_OK,
                'message' => 'Logout successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'status'  => false,
                    'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                ]
            ]);
        }
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
