<?php

declare(strict_types=1);

namespace Alfa\Interview\Context\Enum;

use Alfa\Interview\Context\Trait\CanTryFromName;

enum AdditionalType: int
{
    use CanTryFromName;

    case Dog = 50;
    case Travel = 100;
    case Unknown = 0;

    public static function fromName(string $name): self
    {
        return self::tryFromName($name) ?? self::Unknown;
    }
}
