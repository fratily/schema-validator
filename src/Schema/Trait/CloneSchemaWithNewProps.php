<?php

declare(strict_types=1);

namespace Fratily\SchemaValidator\Schema\Trait;

trait CloneSchemaWithNewProps
{
    /**
     * @phpstan-param array<non-empty-string, mixed> $new_props
     */
    private function clone(array $new_props): self
    {
        return new self(
            ...array_filter(get_object_vars($this), fn($k) => !isset($new_props[$k]), ARRAY_FILTER_USE_KEY),
            ...$new_props,
        );
    }
}
