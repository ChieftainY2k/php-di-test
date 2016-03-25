<?php

require "../vendor/autoload.php";
require "./classes.php";


$builder = new \DI\ContainerBuilder();
//$builder->useAutowiring(false);
//$builder->useAnnotations(false);
$builder->addDefinitions([
    "mystring" => "ala ma kota",
    "mytable" => [
        "entry1" => "value1",
        "entry2" => "value2"
    ],
    "mylogger" => function (\DI\Container $c) {
        //echo "Executing closure ".__CLASS__."::".__METHOD__."()\n";
        return new MyLogger();
    }
]);
$container = $builder->build();

print_r($container->get("mytable"));
print_r($container->get("mylogger"));


echo "Finished.\n";