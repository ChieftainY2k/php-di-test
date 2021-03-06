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
    "loggerFactory"=>DI\object(LoggerFactory::class),
    "logger"=>DI\factory(["loggerFactory","create"]), //alternative syntax
    //"logger"=>DI\factory("LoggerFactory::create"), //alternative syntax
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