<?php

namespace Fratily\SchemaValidator;

use Fratily\SchemaValidator\Schema\S_Bool;
use Fratily\SchemaValidator\Schema\S_Float;
use Fratily\SchemaValidator\Schema\S_Int;
use Fratily\SchemaValidator\Schema\S_List;
use Fratily\SchemaValidator\Schema\S_Literal;
use Fratily\SchemaValidator\Schema\S_Map;
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

    public static function null(): S_Literal
    {
        return new S_Literal(null);
    }

    public static function literal(bool|int|float|string|null $value): S_Literal
    {
        return new S_Literal($value);
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

    public static function tuple(SchemaInterface $value, SchemaInterface ...$values): S_Tuple
    {
        return new S_Tuple($value, ...array_values($values));
    }

    /**
     * @phpstan-param (callable(): array<non-empty-string, SchemaInterface>) $map_generator
     */
    public static function map(callable $map_generator): S_Map
    {
        return new S_Map($map_generator);
    }

    public static function record(SchemaInterface $value, SchemaInterface $key = new S_String()): S_Record
    {
        return new S_Record($key, $value);
    }

    public static function union(SchemaInterface $value, SchemaInterface ...$values): S_Union
    {
        return new S_Union(...[$value], ...array_values($values));
    }
}
