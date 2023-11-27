<?php

namespace Fratily\SchemaValidator\Schema;

class S_String extends AbstractSchema
{
    public function __construct(
        public readonly string|null $regex = null,
        public readonly bool $non_empty = false,
    ) {

        parent::__construct();
    }


    public function nonEmpty(): static
    {
        return $this->with(non_empty: true);
    }

    public function allowEmpty(): static
    {
        return $this->with(non_empty: false);
    }

    public function regex(string|null $regex): static
    {
        return $this->with(regex: $regex);
    }
}
