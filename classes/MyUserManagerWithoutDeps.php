<?php

class MyUserManagerWithoutDeps
{
    public function __construct()
    {
        echo "Executing " . __METHOD__ . "()\n";
    }

    public function register($email, $password)
    {
        echo "Executing " . __METHOD__ . "($email,$password)\n";
    }
}
