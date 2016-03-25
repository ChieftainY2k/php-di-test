<?php

class MyController implements ControllerInterface
{
    private $userManager;
    private $logger;
    private $cacheMgr;
    private $printMgr;

    public function __construct(UserManagerInterface $userManager, LoggerInterface $logger)
    {
        echo "Executing " . __METHOD__ . "(" . get_class($userManager) . "," . get_class($logger) . ")\n";
        $this->userManager = $userManager;
        $this->logger = $logger;
    }

    public function doSomething()
    {
        echo "Executing " . __METHOD__ . "()\n";
        $this->userManager->register("ala@makota.pl", "password");
        $this->logger->log("New user was just registered");
    }

    public function setCacheManager(CacheManagerInterface $cacheMgr)
    {
        echo "Executing " . __METHOD__ . "(" . get_class($cacheMgr) . ")\n";
        $this->cacheMgr = $cacheMgr;
    }

    public function doSomethingWithCache()
    {
        echo "Executing " . __METHOD__ . "()\n";
        $this->doSomething();
        $this->cacheMgr->set("myKey", "myValue");
    }

    public function doSomethingWithPrint()
    {
        echo "Executing " . __METHOD__ . "()\n";
        $this->printMgr->printSomeMessage();
    }
}
