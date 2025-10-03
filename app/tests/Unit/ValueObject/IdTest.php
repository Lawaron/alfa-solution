<?php

declare(strict_types=1);

namespace Tests\Unit\ValueObject;

use Alfa\Interview\Context\ValueObject\Id;
use PHPUnit\Framework\TestCase;

class IdTest extends TestCase
{
    public function testIdValueLength(): void
    {
        $id = Id::generate();
        $expectedLength = 32;

        $this->assertEquals($expectedLength, strlen($id->value));
    }
}
