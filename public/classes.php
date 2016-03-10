<?php

class Mailer
{
    public function mail($recipient, $content)
    {
        // send an email to the recipient
        echo "Executing ".__CLASS__."::".__METHOD__."\n";
    }
}


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
        echo "Executing ".__CLASS__."::".__METHOD__."\n";
        $this->mailer->mail($email, 'Hello and welcome!');
    }
}
