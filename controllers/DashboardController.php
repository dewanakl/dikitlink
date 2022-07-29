<?php

namespace Controllers;

use Core\Controller;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return $this->view('dashboard');
    }
}
