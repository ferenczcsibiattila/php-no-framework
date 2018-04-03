<?php
declare(strict_types=1);

namespace ExampleApp;

class HelloWorld
{
	public function announce(): string
	{
		return 'Hello autoloaded world!';
	}
}