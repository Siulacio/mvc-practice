<?php

namespace Application\Controllers;

use Twig\Environment;

class DashboardController
{
    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('registro');
            exit;
        }
    }

    public function index(Environment $twig)
    {
        echo $twig->render('dashboard.twig', [
            'session' => $_SESSION
        ]);
    }

    public function logout()
    {
        if (isset($_POST['submit'])) {
            session_destroy();

            redirect('login');
            exit;
        }

    }

}
