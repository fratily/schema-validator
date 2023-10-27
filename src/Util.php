<?php

namespace Fratily\SchemaValidator;

use InvalidArgumentException;
use LogicException;

class Util
{
    public static function assertFloatRange(float|null $gt, float|null $gte, float|null $lt, float|null $lte): void
    {
        if ($gt !== null && $gte !== null) {
            throw new InvalidArgumentException();
        }

        if ($lt !== null && $lte !== null) {
            throw new InvalidArgumentException();
        }

        // MEMO: PHP_FLOAT_MAX PHP_FLOAT_MIN を考慮していないように見えるがどうしたものか
        // 上限と下限のうちどちらかが未指定なら範囲指定が正常化の検証は必要ない。範囲の片方が無いので不整合が起きえない
        if (($gt === null && $gte === null) || ($lt === null && $lte === null)) {
            return;
        }

        if ($gte !== null && $lte !== null && $gte === $lte) {
            // MEMO: このケースはliteralで処理してほしいがどうしたものか
            return;
        }

        $min = $gt ?? $gte ?? throw new LogicException();
        $max = $lt ?? $lte ?? throw new LogicException();
        if (($max - $min) <= 0) {
            throw new InvalidArgumentException();
        }
    }

    public static function assertIntRange(int|null $gt, int|null $gte, int|null $lt, int|null $lte): void
    {
        if ($gt !== null && $gte !== null) {
            throw new InvalidArgumentException();
        }

        if ($lt !== null && $lte !== null) {
            throw new InvalidArgumentException();
        }

        // MEMO: PHP_INT_MAX PHP_INT_MIN を考慮していないように見えるがどうしたものか
        // 上限と下限のうちどちらかが未指定なら範囲指定が正常化の検証は必要ない。範囲の片方が無いので不整合が起きえない
        if (($gt === null && $gte === null) || ($lt === null && $lte === null)) {
            return;
        }

        if ($gte !== null && $lte !== null && $gte === $lte) {
            // MEMO: このケースはliteralで処理してほしいがどうしたものか
            return;
        }

        $min = $gt ?? $gte ?? throw new LogicException();
        $max = $lt ?? $lte ?? throw new LogicException();
        if (($max - $min) <= 0) {
            throw new InvalidArgumentException();
        }
    }
}
