<?php

namespace Fratily\SchemaValidator\Schema;

use InvalidArgumentException;

class S_Tuple extends AbstractSchema
{
    /**
     * @var SchemaInterface[]
     * @phpstan-var non-empty-list<SchemaInterface>
     */
    public readonly array $values;

    public function __construct(SchemaInterface $value, SchemaInterface ...$values)
    {
        $values = [$value, ...$values];
        if (!array_is_list($values)) {
            throw new InvalidArgumentException();
        }

        $this->values = $values;


        parent::__construct();
    }
}
