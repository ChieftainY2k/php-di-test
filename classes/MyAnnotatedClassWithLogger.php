<?php

class MyAnnotatedClassWithLogger
{
    /**
     * @Inject
     * @var LoggerInterface
     */
    private $logger;

    public function __construct()
    {
        echo "Executing " . __METHOD__. "()\n";
    }


    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        echo "Executing " . __METHOD__. "()\n";
        return $this->logger;
    }
}