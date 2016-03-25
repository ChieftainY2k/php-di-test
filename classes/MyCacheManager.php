<?php

class MyCacheManager implements CacheManagerInterface
{
    public function __construct()
    {
        echo "Executing " . __METHOD__ . "()\n";
    }

    public function set($name, $data)
    {
        echo "Executing " . __METHOD__ . "($name,$data)\n";
    }
}
