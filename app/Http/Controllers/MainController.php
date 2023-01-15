<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function __invoke()
    {
        return view('index');
    }
    public function getUser()
    {
        return Auth::user();
    }
}
