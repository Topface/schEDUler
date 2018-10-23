<?php

use DI\ContainerBuilder;
use Topface\Controller\ControllerArgument;
use Topface\Controller\RunControllerInterface;

require_once __DIR__ . '/../../vendor/autoload.php';

try {
    $ContainerBuilder = new ContainerBuilder();
    $ContainerBuilder->addDefinitions(__DIR__ . '/config.php');
    $Di = $ContainerBuilder->build();
    // TODO Тут нужно получить от DI некий роутер/фронткотроллер и стартовать

    $ControllerArgument = new ControllerArgument($argv[2]);
    $Controller = $Di->get(RunControllerInterface::class);
    $Controller->setArgument($ControllerArgument);
    $Controller->start();

    echo PHP_EOL;
} catch (Throwable $Exception) {
    echo sprintf('Huston, we have a problem: %s', $Exception->getMessage());
}
