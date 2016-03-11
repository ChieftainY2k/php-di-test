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
    "cacheManager"=>DI\object(MyCacheManager::class),
    "logger"=>function (\DI\Container $c)
    {
        return new MyLogger($c->get("prefix"));
    },
    "userManager"=>function (\DI\Container $c)
    {
        return new MyUserManager($c->get("mailer"));
    },
    //invoke constructor and then setter
    "controller"=>DI\object(MyController::class)
        ->constructor(DI\get('userManager'), DI\get('logger'))
        ->method("setCacheManager",DI\get("cacheManager"))
]);

$container = $builder->build();

/* @var $controller MyController */
$controller = $container->get("controller");
$controller->doSomethingWithCache();


echo "Finished.\n";