<?php

require "../vendor/autoload.php";
require "./classes.php";

$container = DI\ContainerBuilder::buildDevContainer();

$userManager = $container->get(MyUserManagerWithoutDeps::class);
$userManager->register("ala@makota.pl","abcd");
//print_r($userManager);

echo "Finished.\n";