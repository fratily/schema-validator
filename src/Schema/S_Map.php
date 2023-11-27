<?php

namespace Fratily\SchemaValidator\Schema;

use Fratily\SchemaValidator\Schema\SchemaInterface;
use Fratily\SchemaValidator\SchemaRepository;
use InvalidArgumentException;

class S_Map extends AbstractSchema
{
    /**
     * @var array[]
     * @phpstan-var list<array{SchemaInterface, SchemaInterface}>
     */
    public readonly array $kv_pairs;

    /**
     * @phpstan-param (callable(): array<non-empty-string, SchemaInterface>) $map_generator
     */
    public function __construct(callable $map_generator)
    {
        $kv_pairs = [];
        SchemaRepository::holdRef(function () use ($map_generator, &$kv_pairs) {
            $map = $map_generator();

            foreach ($map as $key => $value_schema) {
                $key_schema = SchemaRepository::getById($key);

                if (!$key_schema instanceof SchemaInterface || !$key_schema->canBeUsedAsArrayKey()) {
                    var_dump($key_schema);
                    throw new InvalidArgumentException();
                }

                if (!$value_schema instanceof SchemaInterface) { // @phpstan-ignore-line will always evaluate to true.
                    throw new InvalidArgumentException();
                }

                $kv_pairs[] = [$key_schema, $value_schema];
            }
        });

        $this->kv_pairs = $kv_pairs;

        parent::__construct();
    }
}
