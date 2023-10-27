<?php

declare(strict_types=1);

namespace Fratily\SchemaValidator\Schema;

use Fratily\SchemaValidator\Schema\Trait\CantBeUsedAsArrayKey;

class S_Map implements SchemaInterface
{
    use CantBeUsedAsArrayKey;

    public function __construct(
    )
    {

    }
}
