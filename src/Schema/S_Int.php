<?php

namespace Fratily\SchemaValidator\Schema;

use InvalidArgumentException;

final class S_Int extends AbstractSchema
{
    public function __construct(
        public readonly int|null $min = null,
        public readonly int|null $max = null,
    ) {
        if ($min !== null && $max !== null && $max < $min) {
            throw new InvalidArgumentException();
        }

        parent::__construct();
    }

    public function canBeUsedAsArrayKey(): bool
    {
        return true;
    }


    public function min(int|null $min): self
    {
        if ($min !== null && $this->max !== null && $this->max < $min) {
            throw new InvalidArgumentException();
        }

        return $this->with(min: $min);
    }

    public function max(int|null $max): self
    {
        if ($this->min !== null && $max !== null && $max < $this->min) {
            throw new InvalidArgumentException();
        }

        return $this->with(max: $max);
    }
}
