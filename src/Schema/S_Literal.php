<?php

declare(strict_types=1);

namespace Fratily\SchemaValidator\Schema;

class S_Literal implements SchemaInterface
{
    public function __construct(
        public readonly mixed $value,
    ){}

    public function canBeUsedAsArrayKey(): bool
    {
        return false;
    }
}
