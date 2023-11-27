<?php

namespace Fratily\SchemaValidator;

use Fratily\SchemaValidator\Schema\SchemaInterface;
use WeakMap;
use WeakReference;

class SchemaRepository
{
    private const ID_PREFIX = 's:';

    private static int $auto_increment = 0;

    /**
     * @phpstan-var WeakMap<SchemaInterface, non-empty-string>
     */
    private static WeakMap $schema_to_id;

    /**
     * @var WeakReference[]
     * @phpstan-var array<non-empty-string, WeakReference<SchemaInterface>>
     */
    public static array $id_to_schema = [];

    private static int $hold_ref_count = 0;

    /**
     * @var SchemaInterface[]
     * @phpstan-var list<SchemaInterface>
     */
    private static array $schemas_for_hold_ref = [];


    private static function init(): void
    {
        if (!isset(self::$schema_to_id)) {
            /** @phpstan-var WeakMap<SchemaInterface, non-empty-string> */
            $schema_to_id = new WeakMap();
            self::$schema_to_id = $schema_to_id;
        }
    }

    public static function add(SchemaInterface $schema): void
    {
        self::init();

        $new_id = self::ID_PREFIX . ++self::$auto_increment;
        self::$schema_to_id[$schema] = $new_id;
        self::$id_to_schema[$new_id] = WeakReference::create($schema);

        if (1 <= self::$hold_ref_count) {
            self::$schemas_for_hold_ref[] = $schema;
        }
    }

    /**
     * @phpstan-return non-empty-string|null
     */
    public static function getId(SchemaInterface $schema): string|null
    {
        self::init();

        return self::$schema_to_id[$schema] ?? null;
    }

    /**
     * @phpstan-param non-empty-string $id
     */
    public static function getById(string $id): SchemaInterface|null
    {
        self::init();

        return self::$id_to_schema[$id]->get();
    }

    public static function holdRef(callable $fn): void
    {
        self::$hold_ref_count++;

        $fn();

        self::$hold_ref_count--;

        if (self::$hold_ref_count === 0) {
            self::$schemas_for_hold_ref = [];
        }
    }

    public static function dump(): void
    {
        var_dump([
            'auto_increment' => self::$auto_increment, 'id_to_schema' => self::$id_to_schema,
             'schema_to_id' => self::$schema_to_id, 'schemas_for_hold_ref' => self::$schemas_for_hold_ref, 'hold_ref_count' => self::$hold_ref_count
            ]);
    }
}
