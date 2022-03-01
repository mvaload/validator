<?php

declare(strict_types=1);

namespace Hexlet\Code\Schemas;

/**
 * Class StringSchema
 * @package Hexlet\Code\Schemas
 */
class StringSchema extends AbstractSchema
{
    public const NAME = 'string';

    public function __construct()
    {
        $this->validators = collect([
            static fn(mixed $value) => is_string($value)
        ]);
    }

    /**
     * @return $this
     */
    public function required(): self
    {
        $this->allowsNull = false;
        $this->validators->add(static fn(string $value) => $value !== '');
        return $this;
    }

    /**
     * @param int $length
     * @return $this
     */
    public function minLength(int $length): self
    {
        $this->validators->add(static fn(string $value) => mb_strlen($value) >= $length);
        return $this;
    }

    /**
     * @param string $substr
     * @return $this
     */
    public function contains(string $substr): self
    {
        $this->validators->add(static fn(string $value) => str_contains($value, $substr));
        return $this;
    }
}
