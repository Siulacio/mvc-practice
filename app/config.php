<?php

use Application\Services\Doctrine;
use Blog\Interfaces\IArticle;
use Blog\Persistences\InMemoryArticle;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use function DI\create;
use function DI\get;

return [
    IArticle::class => create(InMemoryArticle::class),
    Environment::class => function () {
        $loader = new FilesystemLoader([__DIR__ . "/../src/Blog/Views", __DIR__ . "/../src/Application/Views"]);
        $twig = new Environment($loader, ['debug' => true]);
        $twig->addExtension(new DebugExtension());

        return $twig;
    },
    Doctrine::class => create(Doctrine::class)
        ->constructor(get('db.connectionOptions')),
    'db.connectionOptions' => [
        'driver' => 'pdo_mysql',
        'host' => 'localhost',
        'user' => 'root',
        'password' => '1234',
        'port' => 3306,
        'dbname' => 'doctrinedb',
        'unix_socket' => '/var/run/mysqld/mysqld.sock',
    ]
];
