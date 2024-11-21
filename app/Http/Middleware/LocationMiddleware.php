<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class LocationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Application|ResponseFactory|Response|mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        try {
            $userCurrency = (object) [
                'currency' => 'USD',
                'symbol' => '$',
                'is_default' => true
            ];

            $countryCode = $request->headers->get('CF-IPCountry');
            switch ($countryCode) {
                case 'IN':
                    $userCurrency = (object) [
                        'currency' => 'INR',
                        'symbol'   => '₹',
                        'is_default' => true
                    ];
                    break;
                case 'GE':
                    $userCurrency = (object) [
                        'currency' => 'GEL',
                        'symbol'   => 'GEL',
                        'is_default' => true
                    ];
                    break;
            }

            session(['user_currency' => $userCurrency]);

            return $next($request);
        } catch (\Exception $e) {
            Log::error('LocationMiddleware: Error occurred.', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response('Internal Server Error', 500);
        }
    }
}
