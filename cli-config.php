<?php

use Application\Services\Doctrine;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$container = require __DIR__ . '/app/bootstrap.php';
$entityManager = $container->get(Doctrine::class)->em;

return ConsoleRunner::createHelperSet($entityManager);
