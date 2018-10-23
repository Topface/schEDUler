<?php

use DI\ContainerBuilder;
use Topface\Arg;
use Topface\Router;

require_once __DIR__ . '/../../vendor/autoload.php';

try {
    $ContainerBuilder = new ContainerBuilder();
    $ContainerBuilder->addDefinitions(__DIR__ . '/di-config.php');
    $Di = $ContainerBuilder->build();

    $Arg = new Arg($_SERVER['argv']);

    /** @var Router $router */
    $router = $Di->get(Router::class);
    $router->run($Arg);
} catch (Throwable $Exception) {
    echo sprintf('Huston, we have a problem: %s', $Exception->getMessage());
}
