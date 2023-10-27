<?php

declare(strict_types=1);

namespace Fratily\SchemaValidator\Schema;

use Fratily\SchemaValidator\Schema\Trait\CantBeUsedAsArrayKey;

class S_Null implements SchemaInterface
{
    use CantBeUsedAsArrayKey;
}
