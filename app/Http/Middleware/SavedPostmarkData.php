<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SavedPostmarkData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $settings = setting('postmark');
        // config([
        //     'mail.mailers.postmark' => [
        //         'transport' => 'postmark',
        //         'token' => $settings['token'],
        //     ],
        //     'mail.from.address' => $settings['address'],
        //     'mail.from.name' => $settings['sender'],
        // ]);

        return $next($request);
    }
}
