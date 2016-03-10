<?php

require "../vendor/autoload.php";
require "./classes.php";


$builder = new \DI\ContainerBuilder();
$builder->useAutowiring(true);
$builder->useAnnotations(false);
$builder->addDefinitions([
    "prefix"=>"myprefix",
    "logger"=>function (\DI\Container $c)
    {
        return new Logger($c->get("prefix"));
    },
    "userManager"=>DI\object(UserManager::class),
    "controller"=>function (\DI\Container $c)
    {
        return new MyController($c->get("userManager"),$c->get("logger"));
    }
]);
$container = $builder->build();

//print_r($container->get("mytable"));
//print_r($container->get("mylogger"));

/* @var $controller MyController */
$controller = $container->get("controller");
$controller->doSomething();


echo "Finished.\n";