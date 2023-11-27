<?php

namespace Fratily\SchemaValidator\Schema;

use Stringable;

interface SchemaInterface
{
    public function canBeUsedAsArrayKey(): bool;

    /**
     * @phpstan-return non-empty-string
     */
    public function getRef(): string;
}
