<?php
declare(strict_types=1);

namespace ExampleApp;

class HelloWorld
{
    private $foo;

    public function __construct(string $foo)
    {
        $this->foo = $foo;
    }

    public function __invoke(): void
    {
        echo "Hello, {$this->foo} in an invoked world!";
        exit;
    }

	public function announce(): string
	{
		return "Hello, {$this->foo} in a front controller world!";
	}
}