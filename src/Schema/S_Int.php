<?php

declare(strict_types=1);

namespace Fratily\SchemaValidator\Schema;

use Fratily\SchemaValidator\Schema\Trait\CloneSchemaWithNewProps;
use InvalidArgumentException;

final class S_Int implements SchemaInterface
{
    use CloneSchemaWithNewProps;

    public function __construct(
        public readonly int|null $gt = null,
        public readonly int|null $gte = null,
        public readonly int|null $lt = null,
        public readonly int|null $lte = null,
        public readonly bool $nullable = false,
    ) {
    }

    public function nullable(): self
    {
        return $this->clone(['nullable' => true]);
    }

    public function gt(float|null $gt): self
    {
        if ($gt === null) {
            return $this->clone(['gt' => null]);
        }

        if ($this->lt !== null && ($this->lt - $gt) <= 0) {
            throw new InvalidArgumentException();
        }

        if ($this->lte !== null && ($this->lte - $gt) <= 0) {
            throw new InvalidArgumentException();
        }

        return $this->clone(['gt' => $gt, 'gte' => null]);
    }

    public function gte(float|null $gte): self
    {
        if ($gte === null) {
            return $this->clone(['lte' => null]);
        }

        if ($this->lt !== null && ($this->lt - $gte) <= 0) {
            throw new InvalidArgumentException();
        }

        if ($this->lte !== null && ($this->lte - $gte) < 0) {
            throw new InvalidArgumentException();
        }

        return $this->clone(['lt' => null, 'gte' => $gte]);
    }

    public function lt(float|null $lt): self
    {
        if ($lt === null) {
            return $this->clone(['lt' => null]);
        }

        if ($this->gt !== null && ($lt - $this->gt) <= 0) {
            throw new InvalidArgumentException();
        }

        if ($this->gte !== null && ($lt - $this->gte) <= 0) {
            throw new InvalidArgumentException();
        }

        return $this->clone(['lt' => $lt, 'lte' => null]);
    }

    public function lte(float|null $lte): self
    {
        if ($lte === null) {
            return $this->clone(['lte' => null]);
        }

        if ($this->gt !== null && ($lte - $this->gt) <= 0) {
            throw new InvalidArgumentException();
        }

        if ($this->gte !== null && ($lte - $this->gte) < 0) {
            throw new InvalidArgumentException();
        }

        return $this->clone(['lt' => null, 'lte' => $lte]);
    }

    public function min(float|null $min): self
    {
        return $this->gte($min);
    }

    public function max(float|null $max): self
    {
        return $this->lte($max);
    }
}
