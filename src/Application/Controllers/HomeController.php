<?php

namespace Application\Controllers;

use Application\Entities\Post;
use Application\Entities\User;
use Application\Services\Doctrine;

class HomeController
{
    public function index(Doctrine $doctrine)
    {
        var_dump($doctrine);
    }

    public function insert(Doctrine $doctrine): void
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

    public function all(Doctrine $doctrine): void
    {
        $users = $doctrine->em->getRepository('Application\Entities\User')->findAll();

        foreach ($users as $user) {
            echo $this->formatUser($user);
        }
    }

    public function findOne(Doctrine $doctrine, int $id): void
    {
        $user = $doctrine->em->find(User::class, $id);

        if ($user) {
            echo $this->formatUser($user);
        } else {
            echo "El usuario con id {$id} no existe";
        }
    }

    public function update(Doctrine $doctrine, int $id): void
    {
        $user = $doctrine->em->find(User::class, $id);
        $user->setUsername("test@example.com");

        $doctrine->em->persist($user);
        $doctrine->em->flush();

        echo "Se ha actualizado el Usuario con id {$user->getId()} en base de datos!";
    }

    public function remove(Doctrine $doctrine, int $id): void
    {
        $user = $doctrine->em->find(User::class, $id);

        if (!$user) {
            echo "El usuario con id {$id} no existe";
            exit;
        }

        $doctrine->em->remove($user);
        $doctrine->em->flush();
        echo "El usuario con id {$id} ha sido eliminado de base de datos";
    }

    public function findByUsername(Doctrine $doctrine, string $username)
    {
        $user = $doctrine->em
            ->getRepository(User::class)
            ->getUserByUsername($username);

        if ($user) {
            echo $this->formatUser($user);
        } else {
            echo "El usuario con username {$username} no existe";
        }
    }

    public function insertPost(Doctrine $doctrine, int $user_id)
    {
        try {
            $user = $doctrine->em->find(User::class, $user_id);
            var_dump($user_id);

            $post = new Post;
            $post->setUser($user);
            $post->setTitle('Nuevo post 1');
            $post->setBody('Contenido del post 1');

            $doctrine->em->persist($post);
            $doctrine->em->flush();

            echo "Nuevo post vinculado al usuario con id {$user_id}";
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function findUserWithPosts(Doctrine $doctrine, int $user_id)
    {
        $user = $doctrine->em->find(User::class, $user_id);

        if ($user) {
            echo $this->formatUser($user);

            foreach ($user->getPosts() as $post) {
                echo sprintf(
                    "%d, %s, %s, %s <br />",
                    $post->getId(),
                    $post->getTitle(),
                    $post->getBody(),
                    $post->getCreated()->format('d/m/Y H:i:s'),
                );
            }

        }
    }

    protected function formatUser(User $user): string
    {
        return sprintf(
            "%d, %s, %s, %s, %s <br />",
            $user->getId(),
            $user->getUsername(),
            $user->getPassword(),
            $user->getEmail(),
            $user->getCreated()->format("d/m/Y H:i:s")
        );
    }
}
