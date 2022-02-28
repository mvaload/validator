<?php
declare(strict_types=1);

namespace Hexlet\Code\Tests;

use Hexlet\Code\Validator;
use PHPUnit\Framework\TestCase;

class StringTest extends TestCase
{
    private Validator $validator;

    public function setUp(): void
    {
        $this->validator = new Validator();
    }

    public function testBase(): void
    {
        $schema = $this->validator->string();

        $this->assertTrue($schema->isValid(''));
        $this->assertTrue($schema->isValid('what does the fox say'));
        $this->assertTrue($schema->isValid('hexlet'));
    }

    public function testRequired(): void
    {
        $schema = $this->validator->string();

        $this->assertTrue($schema->isValid(null));
        $this->assertTrue($schema->isValid(''));

        $schema->required();

        $this->assertFalse($schema->isValid(null));
        $this->assertFalse($schema->isValid(''));
    }

    public function testContains(): void
    {
        $schema = $this->validator->string();

        $schema->contains('what');
        $this->assertTrue($schema->isValid('what does the fox say'));

        $schema->contains('whatthe');
        $this->assertFalse($schema->isValid('what does the fox say'));
    }

    public function testMinLength(): void
    {
        $schema = $this->validator->string();

        $this->assertTrue($schema->isValid('test'));

        $schema->minLength(10);
        $this->assertFalse($schema->isValid('test'));
    }
}