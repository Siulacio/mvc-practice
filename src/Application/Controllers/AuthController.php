<?php

namespace Application\Controllers;

use Application\Entities\User;
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
        $errors = [];

        if (isset($_POST['submit'])) {

            if (empty($_POST['email'])) {
                $errors[] = 'El correo electrónico es requerido';
            }

            if (empty($_POST['password'])) {
                $errors[] = 'La contraseña es requerida';
            }

            if (empty($errors)) {
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $password = filter_input(INPUT_POST, 'password');

                $user = $this->doctrine->em->getRepository(User::class)->findOneBy([
                   'email' => $email,
                ]);

                if ($user) {
                    if (password_verify($password, $user->getPassword())) {
                        setUserSession($user);
                        redirect('dashboard');
                    }
                }

                $errors[] = 'Las credenciales son incorrectas';
            }
        }
        echo $this->twig->render('login.twig', [
            'errors' => $errors,
            'post' => $_POST,
        ]);
    }

    public function registro()
    {
        $errors = [];

        if (isset($_POST['submit'])) {
            if (empty($_POST['username'])) {
                $errors[] = 'El nombre de usuario es requerido';
            }

            if (empty($_POST['email'])) {
                $errors[] = 'El correo electrónico es requerido';
            }

            if (empty($_POST['password'])) {
                $errors[] = 'La contraseña es requerida';
            }

            if (empty($errors)) {
                $username = filter_input(INPUT_POST, 'username');
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $password = filter_input(INPUT_POST, 'password');

                $user = new User;
                $user->setEmail($email);
                $user->setUsername($username);
                $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $this->doctrine->em->persist($user);
                $this->doctrine->em->flush();

                setUserSession($user);
                redirect('dashboard');
                exit;
            }
        }
        echo $this->twig->render('registro.twig', [
            'errors' => $errors,
            'post' => $_POST,
        ]);
    }

}
