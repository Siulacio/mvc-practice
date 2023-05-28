<?php

require_once __DIR__ . '/../vendor/autoload.php';
$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/config.php');

return $containerBuilder->build();
