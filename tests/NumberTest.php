<?php

declare(strict_types=1);

namespace Hexlet\Validator\Tests;

use Hexlet\Validator\Validator;
use PHPUnit\Framework\TestCase;

class NumberTest extends TestCase
{
    private Validator $validator;

    public function setUp(): void
    {
        $this->validator = new Validator();
    }

    public function testBase(): void
    {
        $schema = $this->validator->number();

        $this->assertTrue($schema->isValid(null));
        $this->assertTrue($schema->isValid(0));
        $this->assertTrue($schema->isValid(PHP_INT_MAX));
        $this->assertTrue($schema->isValid(PHP_INT_MIN));
        $this->assertTrue($schema->isValid(INF));
        $this->assertTrue($schema->isValid(-INF));
        $this->assertFalse($schema->isValid('hexlet'));
    }

    public function testRequired(): void
    {
        $schema = $this->validator->number();

        $this->assertTrue($schema->isValid(null));

        $schema->required();

        $this->assertFalse($schema->isValid(null));
    }

    public function testPositive(): void
    {
        $schema = $this->validator->number();

        $this->assertTrue($schema->isValid(-999));

        $schema->positive();
        $this->assertFalse($schema->isValid(0));
        $this->assertFalse($schema->isValid(-999));
    }

    public function testRange(): void
    {
        $schema = $this->validator->number();

        $this->assertTrue($schema->isValid(-10));
        $this->assertTrue($schema->isValid(10));

        $schema->range(-5, 5);

        $this->assertFalse($schema->isValid(-10));
        $this->assertFalse($schema->isValid(10));

        $this->assertTrue($schema->isValid(-5));
        $this->assertTrue($schema->isValid(5));

        $this->assertTrue($schema->isValid(-4));
        $this->assertTrue($schema->isValid(4));
    }
}
