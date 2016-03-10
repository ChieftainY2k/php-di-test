<?php

require "../vendor/autoload.php";



$builder = new \DI\ContainerBuilder();
//$builder->useAutowiring(false);
//$builder->useAnnotations(false);
$builder->addDefinitions([

]);
$container = $builder->build();

$userManager = $container->get(UserManager::class);
$userManager->register("ala@makota.pl","abcd");
//print_r($userManager);

echo "Finished.\n";