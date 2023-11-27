<?php

namespace Fratily\SchemaValidator\Schema;

use InvalidArgumentException;

class S_Record extends AbstractSchema
{
    public function __construct(
        public readonly SchemaInterface $key,
        public readonly SchemaInterface $value,
    ) {
        if (!$key->canBeUsedAsArrayKey()) {
            throw new InvalidArgumentException();
        }


        parent::__construct();
    }

    public function key(SchemaInterface $key): static
    {
        if (!$key->canBeUsedAsArrayKey()) {
            throw new InvalidArgumentException();
        }

        return $this->with(key: $key);
    }

    public function value(SchemaInterface $value): static
    {
        return $this->with(value: $value);
    }
}
