<?php

declare(strict_types=1);

namespace Hexlet\Code;

use Hexlet\Code\Schemas\AbstractSchema;
use Hexlet\Code\Schemas\NumberSchema;
use Hexlet\Code\Schemas\StringSchema;
use Hexlet\Code\Schemas\ArraySchema;

/**
 * Class Validator
 * @package Hexlet\Code
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
