<?php

declare(strict_types=1);

namespace Fratily\SchemaValidator\Schema;

class S_String implements SchemaInterface
{
    public function __construct(

    ){}

    public function canBeUsedAsArrayKey(): bool
    {
        return true;
    }
}
