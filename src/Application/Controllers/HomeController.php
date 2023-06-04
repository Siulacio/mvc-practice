<?php

namespace Application\Controllers;

use Application\Entities\User;
use Application\Services\Doctrine;

class HomeController
{
    public function index(Doctrine $doctrine)
    {
        var_dump($doctrine);
    }

    public function insert(Doctrine $doctrine)
    {
        try {

            $user = new User();
            $user->setEmail('example@example.com');
            $user->setUsername('siulacio');
            $user->setPassword(password_hash('password', PASSWORD_DEFAULT));

            $doctrine->em->persist($user);
            $doctrine->em->flush();

            echo "Se ha creado el Usuario con id {$user->getId()} en base de datos!";

        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }

    }

    public function all(Doctrine $doctrine)
    {
        $users = $doctrine->em->getRepository('Application\Entities\User')->findAll();

        foreach ($users as $user) {
            echo sprintf("%d, %s, %s, %s, %s <br />",
                $user->getId(),
                $user->getUsername(),
                $user->getPassword(),
                $user->getEmail(),
                $user->getCreated()->format("d/m/Y H:i:s")
            );
        }
    }
    
}
