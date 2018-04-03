<?php
// declare(encoding='UTF-8'); Zend multibyte feature is turned off
declare(strict_types=1);

require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

// echo 'Hello, world!';
// $helloWorld = new \ExampleApp\HelloWorld;
// echo $helloWorld->announce();
// echo '<br />';

	use \DI\ContainerBuilder;
	use \ExampleApp\HelloWorld;

	// FastRoute
	use \FastRoute\RouteCollector;
	use \Middlewares\FastRoute;
	use \Middlewares\RequestHandler;

	// Let's get Relay ready to accept middleware.
	use \Relay\Relay;
	use \Zend\Diactoros\ServerRequestFactory;

	use function \DI\create; // functions.php
	use function \DI\get; // functions.php

	// FastRoute
	use function \FastRoute\simpleDispatcher;

// Dependency injection container
//
	$containerBuilder = new \DI\ContainerBuilder;
	$containerBuilder->useAutowiring(FALSE);
	$containerBuilder->useAnnotations(FALSE);

	$containerBuilder->addDefinitions(array(
			\ExampleApp\HelloWorld::class => \DI\create(\ExampleApp\HelloWorld::class)->constructor(\DI\get('Foo')),
			'Foo'                         => 'bar'
		)
	);

	$container = $containerBuilder->build();

// FastRoute - determines if a request is valid and can actually be handled by the application
//
	$routes = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {
	    $r->get('/hello', HelloWorld::class);
	});

	$middlewareQueue[] = new \Middlewares\FastRoute($routes);
	$middlewareQueue[] = new \Middlewares\RequestHandler($container);

// Diactoros - Let's get Relay ready to accept middleware.
	$requestHandler = new \Relay\Relay($middlewareQueue);
	// the request handler sends Request to the handler configured for that route in the routes definition
	$requestHandler->handle(\Zend\Diactoros\ServerRequestFactory::fromGlobals());

$helloWorld = $container->get(\ExampleApp\HelloWorld::class);
echo $helloWorld->announce();

