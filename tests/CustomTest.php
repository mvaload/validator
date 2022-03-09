<?php

declare(strict_types=1);

namespace Hexlet\Validator\Tests;

use Hexlet\Validator\Validator;
use PHPUnit\Framework\TestCase;

class CustomTest extends TestCase
{
    private Validator $validator;

    public function setUp(): void
    {
        $this->validator = new Validator();
    }

    public function testCustom(): void
    {
        $fn = fn($value, $start) => str_starts_with($value, $start);
        $this->validator->addValidator('string', 'startWith', $fn);

        $schema = $this->validator->string()->test('startWith', 'H');
        $this->assertFalse($schema->isValid('exlet'));
        $this->assertTrue($schema->isValid('Hexlet'));

        $fn = fn($value, $min) => $value >= $min;
        $this->validator->addValidator('number', 'min', $fn);

        $schema = $this->validator->number()->test('min', 5);
        $this->assertFalse($schema->isValid(4));
        $this->assertTrue($schema->isValid(6));
    }
}
