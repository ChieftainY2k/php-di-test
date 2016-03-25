<?php

class CachedControllerWrapper
{
    private $originalController;

    public function __construct(ControllerInterface $originalController)
    {
        echo "Executing " . __METHOD__ . "(" . get_class($originalController) . ")\n";
        $this->originalController = $originalController;
    }

    public function doSomething()
    {
        echo "Executing " . __METHOD__ . "()\n";
        $this->originalController->doSomething();
    }
}
