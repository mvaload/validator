<?php

declare(strict_types=1);

namespace Hexlet\Code\Schemas;

/**
 * Class NumberSchema
 * @package Hexlet\Code\Schemas
 */
class NumberSchema extends AbstractSchema
{
    public const NAME = 'number';

    public function __construct()
    {
        $this->validators = collect([
            static fn (mixed $value) => is_numeric($value)
        ]);
    }

    /**
     * @return $this
     */
    public function positive(): self
    {
        $this->validators->add(static fn (int | float $value) => $value > 0);
        return $this;
    }

    /**
     * @param int|float $min
     * @param int|float $max
     * @return $this
     */
    public function range(int | float $min, int | float $max): self
    {
        $this->validators->add(static fn (int | float $value) => $value >= $min && $value <= $max);
        return $this;
    }
}
