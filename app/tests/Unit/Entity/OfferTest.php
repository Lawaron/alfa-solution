<?php

declare(strict_types=1);

namespace Tests\Unit\Context\Entity;

use Alfa\Interview\Context\Entity\Offer;
use Alfa\Interview\Context\Enum\{AdditionalType, InsuranceType};
use Alfa\Interview\Context\ValueObject\{Id, Insurance, Price};
use PHPUnit\Framework\Attributes\{DataProvider, TestDox, TestWith};
use PHPUnit\Framework\TestCase;

final class OfferTest extends TestCase
{
    public static function offerProvider(): array
    {
        $id = Id::generate();

        $insuranceFlat = new Insurance(InsuranceType::Flat);
        $insuranceCasco = new Insurance(InsuranceType::Casco);
        $insuranceUnknown = new Insurance(InsuranceType::Unknown);

        return [
            "no additionals" => [
                new Price(100),
                new Offer($id, $insuranceFlat)
            ],
            "a single additional" => [
                new Price(150),
                (new Offer($id, $insuranceFlat))
                    ->addAdditional(AdditionalType::Dog)
            ],
            "more additionals" => [
                new Price(350),
                (new Offer($id, $insuranceCasco))
                    ->addAdditional(AdditionalType::Dog)
                    ->addAdditional(AdditionalType::Travel)
            ],
            "unknown insurance and additional" => [
                new Price(0),
                (new Offer($id, $insuranceUnknown))
                    ->addAdditional(AdditionalType::Unknown)
            ],
        ];
    }

    #[
        TestDox('Get total price of offer is correct'),
        DataProvider('offerProvider')
    ]
    public function testGetTotalPrice(Price $expected, Offer $offer): void
    {
        $this->assertEquals($expected, $offer->getTotalPrice());
    }
}
