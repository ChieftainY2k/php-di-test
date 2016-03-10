<?php

use DI\Factory\RequestedEntry;

require "../vendor/autoload.php";
require "./classes.php";


$builder = new \DI\ContainerBuilder();
$builder->useAutowiring(false);
$builder->useAnnotations(false);
$builder->addDefinitions([
    "logger" => function (RequestedEntry $entry) {
        $className = $entry->getName();
        echo "Creating class " . $className . "\n";
    }
]);
$container = $builder->build();

print_r($container->get("logger"));
//print_r($container->get("logger2"));
//$controller = $container->get("logger2");
//$controller->doSomething();


echo "Finished.\n";