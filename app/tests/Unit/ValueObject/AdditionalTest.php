<?php

declare(strict_types=1);

namespace Tests\Unit\ValueObject;

use Alfa\Interview\Context\Enum\AdditionalType;
use Alfa\Interview\Context\ValueObject\Additional;
use PHPUnit\Framework\Attributes\{TestDox, TestWith};
use PHPUnit\Framework\TestCase;

class AdditionalTest extends TestCase
{
    #[
        TestDox('Name is converted to lowercase in Additional with $name'),
        TestWith(['dog', AdditionalType::Dog]),
        TestWith(['travel', AdditionalType::Travel]),
        TestWith(['unknown', AdditionalType::Unknown]),
    ]
    public function testNameIsLowercase(string $expected, AdditionalType $type): void
    {
        $additional = new Additional($type);
        $this->assertSame($expected, $additional->name);
    }
}
