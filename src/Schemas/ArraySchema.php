<?php

declare(strict_types=1);

namespace Hexlet\Validator\Schemas;

/**
 * Class ArraySchema
 * @package Hexlet\Validator\Schemas
 */
class ArraySchema extends AbstractSchema
{
    public const NAME = 'array';

    public function __construct()
    {
        $this->validators = collect([
            static fn (mixed $value) => is_array($value)
        ]);
    }

    /**
     * @param int $len
     * @return $this
     */
    public function sizeof(int $len): self
    {
        $this->validators->add(static fn (array $items) => count($items) >= $len);
        return $this;
    }

    /**
     * @param array $validators
     * @return $this
     */
    public function shape(array $validators): self
    {
        $shapeValidators = collect($validators);
        $this->validators->add(static fn (array $items) => $shapeValidators->every(
            static fn (AbstractSchema $validator, $key) => $validator->isValid($items[$key] ?? null)
        ));

        return $this;
    }
}
