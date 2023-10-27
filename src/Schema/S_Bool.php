<?php

declare(strict_types=1);

namespace Fratily\SchemaValidator\Schema;

use Fratily\SchemaValidator\Schema\Trait\CantBeUsedAsArrayKey;
use Fratily\SchemaValidator\Schema\Trait\CloneSchemaWithNewProps;

final class S_Bool implements SchemaInterface
{
    use CantBeUsedAsArrayKey, CloneSchemaWithNewProps;

    public bool $nullable = true;

    public function __construct(
        bool $nullable,
    ) {
        $this->nullable = $nullable;
    }

    public function nullable(): self
    {
        return $this->clone(['nullable' => true]);
    }
}
