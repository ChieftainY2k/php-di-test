<?php

class MyPrintManager implements PrintManagerInterface
{
    public function __construct()
    {
        echo "Executing " . __METHOD__ . "()\n";
    }

    public function printSomeMessage()
    {
        echo "Executing " . __METHOD__ . "()\n";
    }
}
