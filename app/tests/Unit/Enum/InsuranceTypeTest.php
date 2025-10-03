<?php

declare(strict_types=1);

namespace Tests\Unit\Enum;

use Alfa\Interview\Context\Enum\InsuranceType;
use PHPUnit\Framework\Attributes\{DataProvider, TestDox, TestWith};
use PHPUnit\Framework\TestCase;

class InsuranceTypeTest extends TestCase
{
    public static function valuesProvider(): array
    {
        $reducer = fn(array $carry, InsuranceType $type) =>
            array_merge($carry + [$type->name => [$type, $type->value]]);

        return array_reduce(InsuranceType::cases(), $reducer, []);
    }

    #[
        TestDox('InsuranceType has correct values'),
        DataProvider('valuesProvider')
    ]
    public function testValues(InsuranceType $type, int $expected): void
    {
        $this->assertSame($expected, $type->value);
    }

    #[
        TestDox('FromName returns correct enum case or Unknown with $name'),
        TestWith(['Flat', InsuranceType::Flat]),
        TestWith(['Casco', InsuranceType::Casco]),
        TestWith(['Unknown', InsuranceType::Unknown]),
        TestWith(['Dummy', InsuranceType::Unknown]),
    ]
    public function testFromName(string $name, InsuranceType $expected): void
    {
        $this->assertSame($expected, InsuranceType::fromName($name));
    }


    #[
        TestDox('TryFromName returns correct enum case or null with $name'),
        TestWith(['Flat', InsuranceType::Flat]),
        TestWith(['Casco', InsuranceType::Casco]),
        TestWith(['Unknown', InsuranceType::Unknown]),
        TestWith(['Dummy', null]),
    ]
    public function testTryFromName(string $name, InsuranceType|null $expected): void
    {
        $this->assertSame($expected, InsuranceType::tryFromName($name));
    }
}
