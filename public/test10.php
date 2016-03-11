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
    "cacheManager"=>DI\object(MyCacheManager::class),
    "printManager"=>DI\object(MyPrintManager::class),
    "logger"=>function (\DI\Container $c)
    {
        return new MyLogger($c->get("prefix"));
    },
    "userManager"=>function (\DI\Container $c)
    {
        return new MyUserManager($c->get("mailer"));
    },
    //invoke constructor and then set the property
    "controller"=>DI\object(MyController::class)
        ->constructor(DI\get('userManager'), DI\get('logger'))
        ->method("setCacheManager",DI\get("cacheManager"))
        ->property('printMgr', DI\get('printManager'))
    ,
    //alias
    "controllerAlias"=>DI\get("controller")
]);

$container = $builder->build();

/* @var $controller MyController */
$controller = $container->get("controllerAlias");
//$controller->doSomethingWithCache();
$controller->doSomethingWithPrint();


echo "Finished.\n";