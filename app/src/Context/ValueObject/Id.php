<?php

declare(strict_types=1);

namespace Alfa\Interview\Context\ValueObject;

class Id
{
    public static function generate(): self
    {
        return new self(bin2hex(random_bytes(16)));
    }

    public function __construct(public readonly string $value)
    {
    }
}
