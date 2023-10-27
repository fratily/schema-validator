<?php

declare(strict_types=1);

namespace Fratily\SchemaValidator\Schema;

use Fratily\SchemaValidator\Schema\Trait\CantBeUsedAsArrayKey;

class S_Union implements SchemaInterface
{
    use CantBeUsedAsArrayKey;

    public function __construct(
        /**
         * @var SchemaInterface[]
         * @phpstan-var non-empty-list<SchemaInterface>
         */
        public readonly array $values,
    )
    {}
}
