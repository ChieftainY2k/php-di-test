<?php

class MyLogger implements LoggerInterface
{

    private $prefix;

    public function __construct($prefix = null)
    {
        echo "Executing " . __METHOD__. "($prefix)\n";
        $this->prefix = $prefix;
    }

    public function log($message)
    {
        // send an email to the recipient
        echo "Executing " . __METHOD__. "($message) with prefix " . $this->prefix . "\n";
    }
}
