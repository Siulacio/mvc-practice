<?php

namespace Application\Controllers;

use Application\Services\Doctrine;

class HomeController
{
    public function index(Doctrine $doctrine)
    {
        var_dump($doctrine);
    }
    
}
