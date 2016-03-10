<?php

use Interop\Container\ContainerInterface;

require "../vendor/autoload.php";
require "./classes.php";


$builder = new \DI\ContainerBuilder();
$builder->useAutowiring(false);
$builder->useAnnotations(false);
$builder->addDefinitions([
    "prefix"=>"myprefix",
    "mailer"=>DI\object(MyMailer::class),
    "logger"=>function (ContainerInterface $c)
    {
        return new MyLogger($c->get("prefix"));
    },
    "userManager"=>function (ContainerInterface $c)
    {
        return new MyUserManager($c->get("mailer"));
    },
    "controller"=>function (ContainerInterface $c)
    {
        return new MyController($c->get("userManager"),$c->get("logger"));
    }
]);
$container = $builder->build();

/* @var $controller MyController */
$controller = $container->get("controller");
$controller->doSomething();


echo "Finished.\n";