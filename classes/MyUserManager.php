<?php

class MyUserManager implements UserManagerInterface
{
    protected $mailer;

    public function __construct(MailerInterface $mailer)
    {
        echo "Executing " . __METHOD__ . "(" . get_class($mailer) . ")\n";
        $this->mailer = $mailer;
    }

    public function register($email, $password)
    {
        echo "Executing " . __METHOD__ . "($email,$password)\n";
        $this->mailer->mail($email, 'Hello and welcome!');
    }
}
