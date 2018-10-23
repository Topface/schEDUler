<?php

namespace Scheduler\Lock;

/**
 * Реализуем лок на редисе
 */
class RedisLock implements LockInterface {
    /**
     * Ставим лок
     *
     * @param string $key
     *
     * @return mixed
     */
    public function lock(string $key) {
        if ($this->RedisClient->setnx($Key, 1)) {
            $this->RedisClient->expire($Key, 10);
            return true;
        }
        return false;
    }

    /**
     * Снимаем лок
     *
     * @param string $key
     *
     * @return mixed
     */
    public function unlock(string $key) {
        // TODO: Implement unlock() method.
    }
}
