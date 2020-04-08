<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        try {
            $user = auth()->user();

            if (!$user) {
                return response()->json([
                    'errors' => [
                        'status'  => false,
                        'code'    => Response::HTTP_UNAUTHORIZED,
                        'message' => 'Unauthorized',
                    ]
                ]);
            }

            return $next($request);

        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json([
                'errors' => [
                    'status'  => false,
                    'code'    => Response::HTTP_UNAUTHORIZED,
                    'message' => $e->getMessage(),
                ]
            ]);
        }
    }
}
