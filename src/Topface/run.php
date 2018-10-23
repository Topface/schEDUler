<?php

use DI\ContainerBuilder;

require_once __DIR__ . '/../../vendor/autoload.php';

try {
    $ContainerBuilder = new ContainerBuilder();
    $ContainerBuilder->addDefinitions(__DIR__ . '/config.php');
    $Di = $ContainerBuilder->build();
    // TODO Тут нужно получить от DI некий роутер/фронткотроллер и стартовать
} catch (Throwable $Exception) {
    echo sprintf('Huston, we have a problem: %s', $Exception->getMessage());
}
