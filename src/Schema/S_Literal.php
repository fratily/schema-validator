<?php

namespace Fratily\SchemaValidator\Schema;

class S_Literal extends AbstractSchema
{
    public function __construct(
        public readonly bool|int|float|string|null $value,
    ) {

        parent::__construct();
    }

    public function canBeUsedAsArrayKey(): bool
    {
        return in_array(gettype($this->value), ['string', 'integer'], true);
    }
}
