<?php

namespace Application\Controllers;

use Application\Services\Doctrine;
use Twig\Environment;

class AuthController
{
    protected Environment $twig;
    protected Doctrine $doctrine;

    public function __construct(Environment $twig, Doctrine $doctrine)
    {
        $this->twig = $twig;
        $this->doctrine = $doctrine;
    }

    public function login()
    {
        echo $this->twig->render('login.twig');
    }

    public function registro()
    {
        if (isset($_POST['submit'])) {
            echo 'Hemos recibido el formulario de registro';
            exit;
        }
        echo $this->twig->render('registro.twig');
    }

}
