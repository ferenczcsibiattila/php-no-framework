<?php
declare(strict_types=1);

require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

// echo 'Hello, world!';
$helloWorld = new \ExampleApp\HelloWorld;
echo $helloWorld->announce();