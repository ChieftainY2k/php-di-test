<?php

require "../vendor/autoload.php";
require "./classes.php";


$builder = new \DI\ContainerBuilder();
$builder->useAutowiring(false);
$builder->useAnnotations(true);

$builder->addDefinitions([
    "LoggerInterface"=>DI\object(MyLogger::class),
    "annotatedObject"=>DI\object(MyAnnotatedClassWithLogger::class),
]);


$container = $builder->build();

/* @var $myObject MyAnnotatedClassWithLogger */
$myObject= $container->get("annotatedObject");
$myObject->getLogger()->log("some message");

echo "Finished.\n";
