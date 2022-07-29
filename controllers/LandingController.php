<?php

namespace Controllers;

use Core\Controller;

class LandingController extends Controller
{
    public function __invoke()
    {
        return $this->view('welcome');
    }
}
