<?php

interface MailerInterface
{
    public function mail($recipient, $content);
}

class MyMailer implements MailerInterface
{
    public function mail($recipient, $content)
    {
        // send an email to the recipient
        echo "Executing " . __METHOD__. "($recipient, $content)\n";
    }
}

////////////////////////////////////////////////////////////////////////////////

interface LoggerInterface
{
    public function __construct($prefix = null);

    public function log($message);
}

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

class TheirLogger extends MyLogger
{

}

class LoggerFactory
{
    public function create()
    {
        return new MyLogger();
    }
}

////////////////////////////////////////////////////////////////////////////////

interface UserManagerInterface
{
    public function __construct(MailerInterface $mailer);

    public function register($email, $password);
}


class MyUserManager implements UserManagerInterface
{
    protected $mailer;

    public function __construct(MailerInterface $mailer)
    {
        echo "Executing " . __METHOD__. "(" . get_class($mailer) . ")\n";
        $this->mailer = $mailer;
    }

    public function register($email, $password)
    {
        echo "Executing " . __METHOD__. "($email,$password)\n";
        $this->mailer->mail($email, 'Hello and welcome!');
    }
}

////////////////////////////////////////////////////////////////////////////////
interface CacheManagerInterface
{
    public function set($name, $data);
}

class MyCacheManager implements CacheManagerInterface
{
    public function __construct()
    {
        echo "Executing " . __METHOD__. "()\n";
    }

    public function set($name, $data)
    {
        echo "Executing " . __METHOD__. "($name,$data)\n";
    }
}

////////////////////////////////////////////////////////////////////////////////
interface PrintManagerInterface
{
    public function printSomeMessage();
}

class MyPrintManager implements PrintManagerInterface
{
    public function __construct()
    {
        echo "Executing " . __METHOD__. "()\n";
    }

    public function printSomeMessage()
    {
        echo "Executing " . __METHOD__. "()\n";
    }
}


////////////////////////////////////////////////////////////////////////////////

interface ControllerInterface
{
    public function __construct(UserManagerInterface $userManager, LoggerInterface $logger);

    public function doSomething();

    public function setCacheManager(CacheManagerInterface $cacheMgr);

    public function doSomethingWithCache();

    public function doSomethingWithPrint();
}

class MyController implements ControllerInterface
{
    private $userManager;
    private $logger;
    private $cacheMgr;
    private $printMgr;

    public function __construct(UserManagerInterface $userManager, LoggerInterface $logger)
    {
        echo "Executing " . __METHOD__. "(" . get_class($userManager) . "," . get_class($logger) . ")\n";
        $this->userManager = $userManager;
        $this->logger = $logger;
    }

    public function doSomething()
    {
        echo "Executing " . __METHOD__. "()\n";
        $this->userManager->register("ala@makota.pl", "password");
        $this->logger->log("New user was just registered");
    }

    public function setCacheManager(CacheManagerInterface $cacheMgr)
    {
        echo "Executing " . __METHOD__. "(" . get_class($cacheMgr) . ")\n";
        $this->cacheMgr = $cacheMgr;
    }

    public function doSomethingWithCache()
    {
        echo "Executing " . __METHOD__. "()\n";
        $this->doSomething();
        $this->cacheMgr->set("myKey", "myValue");
    }

    public function doSomethingWithPrint()
    {
        echo "Executing " . __METHOD__. "()\n";
        $this->printMgr->printSomeMessage();
    }
}

class CachedControllerWrapper
{
    private $originalController;

    public function __construct(ControllerInterface $originalController)
    {
        echo "Executing " . __METHOD__. "(" . get_class($originalController) . ")\n";
        $this->originalController = $originalController;
    }

    public function doSomething()
    {
        echo "Executing " . __METHOD__. "()\n";
        $this->originalController->doSomething();
    }
}
///////////////////////////////////////////////////////////////////////////

