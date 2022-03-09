<?php

declare(strict_types=1);

namespace Hexlet\Validator;

use Hexlet\Validator\Schemas\AbstractSchema;
use Hexlet\Validator\Schemas\NumberSchema;
use Hexlet\Validator\Schemas\StringSchema;
use Hexlet\Validator\Schemas\ArraySchema;

/**
 * Class Validator
 * @package Hexlet\Validator
 */
class Validator
{
    private array $schemas;

    public function __construct()
    {
        $this->schemas = [
            StringSchema::NAME => new StringSchema(),
            NumberSchema::NAME => new NumberSchema(),
            ArraySchema::NAME  => new ArraySchema()
        ];
    }

    /**
     * @param string $schema
     * @param string $name
     * @param callable $fn
     * @return void
     */
    public function addValidator(string $schema, string $name, callable $fn): void
    {
        $this->schemas[$schema]->addValidator($name, $fn);
    }

    /**
     * @param string $schema
     * @param array $arguments
     * @return AbstractSchema
     */
    public function __call(string $schema, array $arguments): AbstractSchema
    {
        return $this->schemas[$schema];
    }
}
