<?php

namespace Application\Controllers;

use Twig\Environment;

class DashboardController
{
    public function index(Environment $twig)
    {
        echo $twig->render('dashboard.twig', [
            'session' => $_SESSION
        ]);
    }

}
