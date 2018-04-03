<?php
declare(strict_types=1);

namespace ExampleApp;

use \Psr\Http\Message\ResponseInterface;

class HelloWorld
{
    private $foo;

    public function __construct(string $foo, ResponseInterface $response)
    {
        $this->foo      = $foo;
        $this->response = $response;
    }

    public function __invoke(): ResponseInterface
    {
        $response = $this->response->withHeader('Content-Type', 'text/html');
        $response->getBody()->write("<html><head></head><body>Hello, {$this->foo} in an invoked world!</body></html>");

        return $response;
    }

	public function announce(): string
	{
		return "Hello, {$this->foo} in a front controller world!";
	}
}