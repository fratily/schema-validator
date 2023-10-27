<?php

declare(strict_types=1);

namespace Fratily\SchemaValidator\Schema;

use Fratily\SchemaValidator\Schema\Trait\CantBeUsedAsArrayKey;
use InvalidArgumentException;

class S_Tuple implements SchemaInterface
{
    use CantBeUsedAsArrayKey;

    public function __construct(
        /**
         * @var SchemaInterface[]
         * @phpstan-var non-empty-list<SchemaInterface>
         */
        public readonly array $values,
    )
    {
        if (!array_is_list($values) || count($values) === 0) {
            throw new InvalidArgumentException();
        }
        foreach ($values as $value) {
            if (!$value instanceof SchemaInterface) {
                throw new InvalidArgumentException();
            }
        }
    }
}
