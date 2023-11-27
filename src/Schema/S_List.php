<?php

namespace Fratily\SchemaValidator\Schema;

class S_List extends AbstractSchema
{
    public function __construct(
        public readonly SchemaInterface $value
    ) {

        parent::__construct();
    }
}
