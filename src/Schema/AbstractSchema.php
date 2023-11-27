<?php

namespace Fratily\SchemaValidator\Schema;

use Fratily\SchemaValidator\SchemaRepository;
use InvalidArgumentException;
use LogicException;

use function Fratily\CloneWith\clone_with_new_props;

abstract class AbstractSchema implements SchemaInterface
{
    public function __construct()
    {
        SchemaRepository::add($this);
    }

    public function canBeUsedAsArrayKey(): bool
    {
        return false;
    }

    final public function getRef(): string
    {
        return SchemaRepository::getId($this) ?? throw new LogicException();
    }


    /**
     * @phpstan-param mixed ...$new_props
     */
    final protected function with(...$new_props): static
    {
        $filtered_new_props = array_filter($new_props, fn($k) => is_string($k) && $k !== '', ARRAY_FILTER_USE_KEY);
        if ($new_props !== $filtered_new_props) {
            throw new InvalidArgumentException();
        }

        $new_schema = clone_with_new_props($this, $filtered_new_props);
        SchemaRepository::add($new_schema);
        return $new_schema;
    }
}
