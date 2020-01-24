<?php

namespace App\Services;
use Illuminate\Support\Facades\Redis as RedisManager;

class RedisService
{
    protected string $keyName = "productsTracking";

    /**
     * getVisitorCounter
     * @return string
     */
    public function getVisitorCounter() : string {
        if(RedisManager::exists($this->keyName)) {
            $response = "Products Endpoint was called ". RedisManager::get($this->keyName) . ' times';
        } else {
            $response = "Counter is not set.";
        }
        return $response;
    }

    /**
     * incrVisitorCounter
     */
    public function incrVisitorCounter() : void {
        if(RedisManager::exists($this->keyName)) {
            RedisManager::incr($this->keyName);
        } else {
            RedisManager::set($this->keyName, 1);
        }
    }
}
