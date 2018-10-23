<?php

use DI\ContainerBuilder;
use Topface\Router;

require_once __DIR__ . '/../../vendor/autoload.php';

try {
    $ContainerBuilder = new ContainerBuilder();
    $ContainerBuilder->addDefinitions(__DIR__ . '/di-config.php');
    $Di = $ContainerBuilder->build();
    // TODO Тут нужно получить от DI некий роутер/фронткотроллер и стартовать
    $Router = new Router($Di);
    $Router->run($argv[1]);
} catch (Throwable $Exception) {
    echo sprintf('Huston, we have a problem: %s', $Exception->getMessage());
}
