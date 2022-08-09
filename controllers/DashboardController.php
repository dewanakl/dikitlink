<?php

namespace Controllers;

use Core\Routing\Controller;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return $this->view('dashboard');
    }
}
