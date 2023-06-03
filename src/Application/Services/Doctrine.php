<?php

namespace Application\Services;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class Doctrine
{
    public $em = null;

    public function __construct(array $connectionOptions)
    {
        $paths = [
            rtrim(__DIR__ . '/../Models'),
            rtrim(__DIR__ . '/../Entities'),
        ];

        $isDevMode = true;

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        $this->em = EntityManager::create($connectionOptions, $config);
    }
}
