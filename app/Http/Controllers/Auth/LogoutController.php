<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store()
    {
        auth()->logout();

        return redirect()->route('home');



    }
}
