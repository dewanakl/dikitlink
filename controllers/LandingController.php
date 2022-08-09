<?php

namespace Controllers;

use Core\Routing\Controller;

class LandingController extends Controller
{
    public function __invoke()
    {
        return $this->view('welcome');
    }
}
