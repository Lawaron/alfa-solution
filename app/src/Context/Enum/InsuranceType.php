<?php

declare(strict_types=1);

namespace Alfa\Interview\Context\Enum;

use Alfa\Interview\Context\Trait\CanTryFromName;

enum InsuranceType: int
{
    use CanTryFromName;

    case Flat = 100;
    case Casco = 200;
    case Unknown = 0;

    public static function fromName(string $name): self
    {
        return self::tryFromName($name) ?? self::Unknown;
    }
}
