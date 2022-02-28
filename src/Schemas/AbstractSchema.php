<?php
declare(strict_types=1);

namespace Hexlet\Code\Schemas;

use Illuminate\Support\Collection;

/**
 * Class AbstractSchema
 * @package Hexlet\Code\Schemas
 */
class AbstractSchema
{
    /**
     * @var bool
     */
    protected bool $allowsNull = true;

    /**
     * @var Collection
     */
    protected Collection $validators;

    /**
     * @var array
     */
    protected array $customValidators;

    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid(mixed $value): bool
    {
        if ($this->allowsNull && is_null($value)) {
            return true;
        }
        return $this->validators->every(static fn(callable $fn) => $fn($value));
    }

    /**
     * @return $this
     */
    public function required(): self
    {
        $this->allowsNull = false;
        return $this;
    }

    /**
     * @param string $name
     * @param callable $fn
     * @return void
     */
    public function addValidator(string $name, callable $fn): void
    {
        $this->customValidators[$name] = $fn;
    }
}