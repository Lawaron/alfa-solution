<?php

declare(strict_types=1);

namespace Alfa\Interview\Context\Trait;

trait CanTryFromName
{
    public static function tryFromName(string $name): self|null
    {
        $searchName = strtoupper($name);

        foreach (self::cases() as $case) {
            if (strtoupper($case->name) === $searchName) {
                return $case;
            }
        }

        return null;
    }
}
