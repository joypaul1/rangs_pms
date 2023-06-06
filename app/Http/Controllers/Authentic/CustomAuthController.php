<?php

namespace App\Http\Controllers\Authentic;

use App\Http\Controllers\Controller;

use App\Providers\RouteServiceProvider;

class CustomAuthController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
