<?php

declare(strict_types=1);

namespace Tests\Integration\Context\Service;

use Alfa\Interview\Context\Factory\OfferFactory;
use Alfa\Interview\Context\Service\Calculator;
use Alfa\Interview\InsuranceCalculator;
use Alfa\Interview\OfferClient;
use PHPUnit\Framework\Attributes\{TestDox, TestWith};
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

final class CalculatorTest extends TestCase
{
    private Calculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new Calculator(new OfferFactory());
    }

    /**
     * @param array<int, string> $additionals
     */
    #[
        TestDox('It calculates the same as the original calculator with $insuranceType'),
        TestWith([
            InsuranceCalculator::TYPE_FLAT,
            [
                InsuranceCalculator::ADDITIONAL_DOG,
                InsuranceCalculator::ADDITIONAL_TRAVEL
            ]
        ]),
        TestWith([
            InsuranceCalculator::TYPE_CASCO,
            [
                InsuranceCalculator::ADDITIONAL_TRAVEL
            ]
        ]),
        TestWith([
            "dummy_type",
            [
                "dummy_additional"
            ]
        ]),
    ]
    public function testCalculate(string $insuranceType, array $additionals): void
    {
        $originalCalculator = new InsuranceCalculator(
            $insuranceType,
            $additionals,
            new OfferClient()
        );

        $this->assertEquals(
            $originalCalculator->calculate(),
            $this->calculator->calculate($insuranceType, $additionals)
        );
    }
}
