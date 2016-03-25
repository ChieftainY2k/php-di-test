<?php

interface ControllerInterface
{
    public function __construct(UserManagerInterface $userManager, LoggerInterface $logger);

    public function doSomething();

    public function setCacheManager(CacheManagerInterface $cacheMgr);

    public function doSomethingWithCache();

    public function doSomethingWithPrint();
}
