<?php

interface LoggerInterface
{
    public function __construct($prefix = null);

    public function log($message);
}
