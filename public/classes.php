<?php

class Mailer
{
    public function mail($recipient, $content)
    {
        // send an email to the recipient
        echo "Executing ".__CLASS__."::".__METHOD__."($recipient, $content)\n";
    }
}

////////////////////////////////////////////////////////////////////////////////

interface LoggerInterface
{
    public function log($message);
}

class Logger implements LoggerInterface
{
    public function log($message)
    {
        // send an email to the recipient
        echo "Executing ".__CLASS__."::".__METHOD__."($message)\n";
    }
}


////////////////////////////////////////////////////////////////////////////////

class UserManager
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        echo "Executing ".__CLASS__."::".__METHOD__."\n";
        $this->mailer = $mailer;
    }

    public function register($email, $password)
    {
        echo "Executing ".__CLASS__."::".__METHOD__."($email,$password)\n";
        $this->mailer->mail($email, 'Hello and welcome!');
    }
}

////////////////////////////////////////////////////////////////////////////////

class MyController
{
    private $userManager;

    public function __construct(UserManager $userManager, LoggerInterface $logger)
    {
        echo "Executing ".__CLASS__."::".__METHOD__."\n";
        $this->userManager = $userManager;
    }
}