<?php

require "../vendor/autoload.php";
require "./classes.php";


$builder = new \DI\ContainerBuilder();
$builder->useAutowiring(false);
$builder->useAnnotations(false);
$builder->addDefinitions([
    "prefix"=>"myprefix",
    "mailer"=>DI\object(MyMailer::class),

    //SCOPE TEST
    "cacheManager"=>DI\object(MyCacheManager::class)
        ->scope(DI\Scope::PROTOTYPE),

    "printManager"=>DI\object(MyPrintManager::class),
    "logger"=>function (\DI\Container $c)
    {
        return new MyLogger($c->get("prefix"));
    },
    "userManager"=>function (\DI\Container $c)
    {
        return new MyUserManager($c->get("mailer"));
    },

    //SCOPE TEST
    "controller"=>DI\object(MyController::class)
        ->scope(DI\Scope::PROTOTYPE)
        ->constructor(DI\get('userManager'), DI\get('logger'))
        ->method("setCacheManager",DI\get("cacheManager"))
        ->property('printMgr', DI\get('printManager'))


]);

$container = $builder->build();

/* @var $controller MyController */
$controller = $container->get("controller");
$controller = $container->get("controller"); //this will be created again


echo "Finished.\n";