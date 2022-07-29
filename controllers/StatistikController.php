<?php

namespace Controllers;

use Core\Controller;

class StatistikController extends Controller
{
    public function __invoke()
    {
        return $this->view('statistik');
    }
}
