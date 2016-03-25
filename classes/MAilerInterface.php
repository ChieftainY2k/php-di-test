<?php

interface MailerInterface
{
    public function mail($recipient, $content);
}