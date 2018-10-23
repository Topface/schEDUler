<?php

namespace Topface;

use InvalidArgumentException;

class Arg {
    /**
     * @var array
     */
    private $params = [];

    /**
     * Arg constructor.
     *
     * @param array $argv
     */
    public function __construct(array $argv) {
        \array_shift($argv);
        foreach ($argv as $arg) {
            $a = \explode('=', $arg);
            if (2 !== \count($a)) {
                throw new InvalidArgumentException('');
            }
            $this->params[$a[0]] = $a[1];
        }
    }

    /**
     * @return string
     */
    public function getAction(): string {
        return $this->getParam('-a');
    }

    /**
     * @param string $key
     * @param string $default
     *
     * @return string
     */
    public function getParam(string $key, $default = ''): string {
        return $this->params[$key] ?? $default;
    }
}
