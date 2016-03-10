<?php

interface MailerInterface
{
    public function mail($recipient, $content);
}

class MyMailer implements  MailerInterface
{
    public function mail($recipient, $content)
    {
        // send an email to the recipient
        echo "Executing " . __CLASS__ . "::" . __METHOD__ . "($recipient, $content)\n";
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
        echo "Executing " . __CLASS__ . "::" . __METHOD__ . "($prefix)\n";
        $this->prefix = $prefix;
    }

    public function log($message)
    {
        // send an email to the recipient
        echo "Executing " . __CLASS__ . "::" . __METHOD__ . "($message) with prefix " . $this->prefix . "\n";
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
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        echo "Executing " . __CLASS__ . "::" . __METHOD__ . "(" . get_class($mailer) . ")\n";
        $this->mailer = $mailer;
    }

    public function register($email, $password)
    {
        echo "Executing " . __CLASS__ . "::" . __METHOD__ . "($email,$password)\n";
        $this->mailer->mail($email, 'Hello and welcome!');
    }
}

////////////////////////////////////////////////////////////////////////////////

interface ControllerInterface
{
    public function __construct(UserManagerInterface $userManager, LoggerInterface $logger);

    public function doSomething();
}

class MyController implements ControllerInterface
{
    private $userManager;
    private $logger;

    public function __construct(UserManagerInterface $userManager, LoggerInterface $logger)
    {
        echo "Executing " . __CLASS__ . "::" . __METHOD__ . "(" . get_class($userManager) . "," . get_class($logger) . ")\n";
        $this->userManager = $userManager;
        $this->logger = $logger;
    }

    public function doSomething()
    {
        $this->userManager->register("ala@makota.pl","password");
        $this->logger->log("New user was just registered");
    }
}