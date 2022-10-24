<?php

namespace Controllers;

use Core\Routing\Controller;
use Core\Http\Request;

class ServerController extends Controller
{
    public function index()
    {
        return opcache_get_status();
    }
}
