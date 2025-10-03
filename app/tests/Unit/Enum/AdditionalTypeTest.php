<?php

declare(strict_types=1);

namespace Tests\Unit\Enum;

use Alfa\Interview\Context\Enum\AdditionalType;
use PHPUnit\Framework\Attributes\{DataProvider, TestDox, TestWith};
use PHPUnit\Framework\TestCase;

class AdditionalTypeTest extends TestCase
{
    public static function valuesProvider(): array
    {
        $reducer = fn(array $carry, AdditionalType $type) =>
            array_merge($carry + [$type->name => [$type, $type->value]]);

        return array_reduce(AdditionalType::cases(), $reducer, []);
    }

    #[
        TestDox('AdditionalType has correct value'),
        DataProvider('valuesProvider')
    ]
    public function testValues(AdditionalType $type, int $expected): void
    {
        $this->assertSame($expected, $type->value);
    }

    #[
        TestDox('FromName returns correct enum case or Unknown with $name'),
        TestWith(['Dog', AdditionalType::Dog]),
        TestWith(['Travel', AdditionalType::Travel]),
        TestWith(['Unknown', AdditionalType::Unknown]),
        TestWith(['Dummy', AdditionalType::Unknown]),
    ]
    public function testFromName(string $name, AdditionalType $expected): void
    {
        $this->assertSame($expected, AdditionalType::fromName($name));
    }


    #[
        TestDox('TryFromName returns correct enum case or null with $name'),
        TestWith(['Dog', AdditionalType::Dog]),
        TestWith(['Travel', AdditionalType::Travel]),
        TestWith(['Unknown', AdditionalType::Unknown]),
        TestWith(['Dummy', null]),
    ]
    public function testTryFromName(string $name, AdditionalType|null $expected): void
    {
        $this->assertSame($expected, AdditionalType::tryFromName($name));
    }
}
