<?php

use DI\ContainerBuilder;
use Topface\Controller\ControllerArgument;
use Topface\Controller\ControllerFactoryInterface;

require_once __DIR__ . '/../../vendor/autoload.php';

try {
    $ContainerBuilder = new ContainerBuilder();
    $ContainerBuilder->addDefinitions(__DIR__ . '/di-config.php');
    $Di = $ContainerBuilder->build();
    // TODO Тут нужно получить от DI некий роутер/фронткотроллер и стартовать

    $ControllerArgument = new ControllerArgument($argv[2]);
    $Factory = $Di->get(ControllerFactoryInterface::class);
    $Controller = $Factory->getController($ControllerArgument);
    $Controller->start();

    echo PHP_EOL;
} catch (Throwable $Exception) {
    echo sprintf('Huston, we have a problem: %s', $Exception->getMessage());
}
