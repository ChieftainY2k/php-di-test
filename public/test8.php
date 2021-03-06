<?php

use Interop\Container\ContainerInterface;

require "../vendor/autoload.php";
require "./classes.php";


$builder = new \DI\ContainerBuilder();
$builder->useAutowiring(true);
$builder->useAnnotations(false);
$builder->addDefinitions([
    "prefix"=>"myprefix",
    "mailer"=>DI\object(MyMailer::class),
    "logger"=>function (\DI\Container $c)
    {
        return new MyLogger($c->get("prefix"));
    },
    "userManager"=>function (\DI\Container $c)
    {
        return new MyUserManager($c->get("mailer"));
    },
    "controller"=>function (\DI\Container $c)
    {
        return new MyController($c->get("userManager"),$c->get("logger"));
    }
]);

//add extra wrapper for controller
$builder->addDefinitions([
    'controller' => DI\decorate(function (ControllerInterface $previous, ContainerInterface $c) {
        return new CachedControllerWrapper($previous);
    }),
]);

$container = $builder->build();

//print_r($container->get("mytable"));
//print_r($container->get("mylogger"));

/* @var $controller MyController */
$controller = $container->get("controller");
$controller->doSomething();


echo "Finished.\n";