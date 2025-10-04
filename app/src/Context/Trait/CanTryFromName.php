<?php

declare(strict_types=1);

namespace Alfa\Interview\Context\Trait;

trait CanTryFromName
{
    public static function tryFromName(string $name): self|null
    {
        foreach (self::cases() as $case) {
            if (strtolower($case->name) === strtolower($name)) {
                return $case;
            }
        }

        return null;
    }
}
