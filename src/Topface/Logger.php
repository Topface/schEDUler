<?php

namespace Topface;

use Psr\Log\LoggerInterface;

class Logger implements LoggerInterface {
    /**
     * {@inheritdoc}
     */
    public function emergency($message, array $context = []) {
        print_r($message);
    }

    /**
     * {@inheritdoc}
     */
    public function alert($message, array $context = []) {
        print_r($message);
    }

    /**
     * {@inheritdoc}
     */
    public function critical($message, array $context = []) {
        print_r($message);
    }

    /**
     * {@inheritdoc}
     */
    public function error($message, array $context = []) {
        print_r($message);
    }

    /**
     * {@inheritdoc}
     */
    public function warning($message, array $context = []) {
        print_r($message);
    }

    /**
     * {@inheritdoc}
     */
    public function notice($message, array $context = []) {
        print_r($message);
    }

    /**
     * {@inheritdoc}
     */
    public function info($message, array $context = []) {
        print_r($message);
    }

    /**
     * {@inheritdoc}
     */
    public function debug($message, array $context = []) {
        print_r($message);
    }

    /**
     * {@inheritdoc}
     */
    public function log($level, $message, array $context = []) {
        print_r($message);
    }
}
