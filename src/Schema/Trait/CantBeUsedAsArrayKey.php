<?php

declare(strict_types=1);

namespace Fratily\SchemaValidator\Schema\Trait;

trait CantBeUsedAsArrayKey
{
    public function canBeUsedAsArrayKey(): bool
    {
        return false;
    }
}
