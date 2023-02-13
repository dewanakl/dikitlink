<?php

namespace App\Controllers;

use Core\Routing\Controller;
use Core\Http\Request;

class TestController extends Controller
{
    public function __invoke(Request $request)
    {
        dd($request, session()->getName(), $request->except([session()->getName()]));
    }
}
