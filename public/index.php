<?php
declare(strict_types=1);

require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

// echo 'Hello, world!';
$helloWorld = new \ExampleApp\HelloWorld;
echo $helloWorld->announce();

// Dependency injection container
//
$containerBuilder = new \DI\ContainerBuilder;
$containerBuilder->useAutowiring(false);
$containerBuilder->useAnnotations(false);
$containerBuilder->addDefinitions(array(
		\ExampleApp\HelloWorld::class => \DI\create(\ExampleApp\HelloWorld::class)
	)
);

$container = $containerBuilder->build();

$helloWorld = $container->get(\ExampleApp\HelloWorld::class);
echo $helloWorld->announce();