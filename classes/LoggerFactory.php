<?php

class LoggerFactory
{
    public function create()
    {
        return new MyLogger();
    }
}
