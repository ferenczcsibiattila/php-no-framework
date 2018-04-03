<?php
declare(strict_types=1);

require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

// echo 'Hello, world!';
$helloWorld = new \ExampleApp\HelloWorld;
echo $helloWorld->announce();
echo '<br />';

use \DI\ContainerBuilder;
use \ExampleApp\HelloWorld;
use function DI\create; // functions.php

// Dependency injection container
//
$containerBuilder = new \DI\ContainerBuilder;
$containerBuilder->useAutowiring(FALSE);
$containerBuilder->useAnnotations(FALSE);

$containerBuilder->addDefinitions(array(
		\ExampleApp\HelloWorld::class => \DI\create(\ExampleApp\HelloWorld::class)
	)
);

$container = $containerBuilder->build();

$helloWorld = $container->get(\ExampleApp\HelloWorld::class);
echo $helloWorld->announce();