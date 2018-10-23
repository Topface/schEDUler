<?php

namespace Topface;

use InvalidArgumentException;

class Arg {
    private $params = [];

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

    public function getAction(): string {
        return $this->getParam('-a');
    }

    public function getParam(string $key, $default = ''): string {
        return $this->params[$key] ?? $default;
    }
}
