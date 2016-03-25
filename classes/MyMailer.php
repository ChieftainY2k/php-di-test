<?php

class MyMailer implements MailerInterface
{
    public function mail($recipient, $content)
    {
        // send an email to the recipient
        echo "Executing " . __METHOD__. "($recipient, $content)\n";
    }
}
