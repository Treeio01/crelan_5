<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Show login page: phone form
     *
     * GET /login
     */
    public function show(): View
    {
        return view('login', [
            'session' => null,
            'formType' => 'phone',
        ]);
    }
}
