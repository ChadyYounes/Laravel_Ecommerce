<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'login',
        'home',
        'store',
        'register',
        'send-reset-password-otp',
        'verify-otp',
        'password.reset',
        'reset-new-password/*'
    ];
}
