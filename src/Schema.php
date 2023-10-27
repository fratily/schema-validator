<?php

namespace Fratily\SchemaValidator;

use Fratily\SchemaValidator\Schema\S_Bool;
use Fratily\SchemaValidator\Schema\S_Float;
use Fratily\SchemaValidator\Schema\S_Int;
use Fratily\SchemaValidator\Schema\S_List;
use Fratily\SchemaValidator\Schema\S_Literal;
use Fratily\SchemaValidator\Schema\S_Map;
use Fratily\SchemaValidator\Schema\S_Null;
use Fratily\SchemaValidator\Schema\S_Record;
use Fratily\SchemaValidator\Schema\S_String;
use Fratily\SchemaValidator\Schema\S_Tuple;
use Fratily\SchemaValidator\Schema\S_Union;
use Fratily\SchemaValidator\Schema\SchemaInterface;

class Schema
{
    public static function true(): S_Literal
    {
        return new S_Literal(true);
    }

    public static function false(): S_Literal
    {
        return new S_Literal(false);
    }

    public static function null(): S_Null
    {
        return new S_Null();
    }

    public static function bool(): S_Bool
    {
        return new S_Bool();
    }

    public static function int(): S_Int
    {
        return new S_Int();
    }

    public static function float(): S_Float
    {
        return new S_Float();
    }

    public static function string(): S_String
    {
        return new S_String();
    }

    public static function list(SchemaInterface $value): S_List
    {
        return new S_List($value);
    }

    /**
     * @param SchemaInterface[] $values
     * @phpstan-param non-empty-list<SchemaInterface> $values
     */
    public static function tuple(array $values): S_Tuple
    {
        return new S_Tuple($values);
    }

    /**
     * @param SchemaInterface[] $map
     * @phpstan-param array<string|int, SchemaInterface> $map
     */
    public static function map(array $map): S_Map {
        return new S_Map();
    }

    public static function record(SchemaInterface $value, SchemaInterface $key = new S_String()): S_Record {
        return new S_Record();
    }

    public static function union(SchemaInterface $value, SchemaInterface ...$values): S_Union
    {
        return new S_Union([...[$value], ...array_values($values)]);
    }
}
