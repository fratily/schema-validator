<?php

namespace Fratily\SchemaValidator\Schema;

use InvalidArgumentException;

class S_Float extends AbstractSchema
{
    public function __construct(
        public readonly float|null $min = null,
        public readonly float|null $max = null,
    ) {
        if ($min !== null && $max !== null && $max < $min) {
            throw new InvalidArgumentException();
        }

        parent::__construct();
    }

    public function min(float|null $min): self
    {
        if ($min !== null && $this->max !== null && $this->max < $min) {
            throw new InvalidArgumentException();
        }

        return $this->with(min: $min);
    }

    public function max(float|null $max): self
    {
        if ($this->min !== null && $max !== null && $max < $this->min) {
            throw new InvalidArgumentException();
        }

        return $this->max(max: $max);
    }
}
