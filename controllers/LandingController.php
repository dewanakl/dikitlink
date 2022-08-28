<?php

namespace Controllers;

use Core\Routing\Controller;

class LandingController extends Controller
{
    public function __invoke()
    {
        phpinfo();
        //return $this->view('welcome');
    }
}
