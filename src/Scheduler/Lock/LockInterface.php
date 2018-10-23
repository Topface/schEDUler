<?php

namespace Scheduler\Lock;

/**
 * Интерфейс лока
 */
interface LockInterface {
    /**
     * Ставим лок
     *
     * @param string $key
     *
     * @return mixed
     */
    public function lock(string $key);

    /**
     * Снимаем лок
     *
     * @param string $key
     *
     * @return mixed
     */
    public function unlock(string $key);
}