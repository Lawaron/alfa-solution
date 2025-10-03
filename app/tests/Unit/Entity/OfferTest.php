<?php

declare(strict_types=1);

namespace Tests\Unit\Context\Entity;

use Alfa\Interview\Context\Entity\Offer;
use Alfa\Interview\Context\Enum\{AdditionalType, InsuranceType};
use Alfa\Interview\Context\ValueObject\{Additional, Id, Insurance};
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

        $additionalDog = new Additional(AdditionalType::Dog);
        $additionalTravel = new Additional(AdditionalType::Travel);
        $additionalUnknown = new Additional(AdditionalType::Unknown);

        return [
            "no additionals" => [
                "expectedAdditionalNames" => [],
                "expectedTotalPrice" => $insuranceFlat->price->ammount,
                "offer" => new Offer($id, $insuranceFlat)
            ],
            "a single additional" => [
                "expectedAdditionalNames" => ["dog"],
                "expectedTotalPrice" => $insuranceFlat->price->ammount
                    + $additionalDog->price->ammount,
                "offer" => (new Offer($id, $insuranceFlat))
                    ->addAdditional($additionalDog)
            ],
            "more additionals" => [
                "expectedAdditionalNames" => ["dog", "travel"],
                "expectedTotalPrice" => $insuranceCasco->price->ammount
                    + $additionalDog->price->ammount
                    + $additionalTravel->price->ammount,
                "offer" => (new Offer($id, $insuranceCasco))
                    ->addAdditional($additionalDog)
                    ->addAdditional($additionalTravel)
            ],
            "repetitive additionals" => [
                "expectedAdditionalNames" => ["dog"],
                "expectedTotalPrice" => $insuranceCasco->price->ammount
                    + $additionalDog->price->ammount,
                "offer" => (new Offer($id, $insuranceCasco))
                    ->addAdditional($additionalDog)
                    ->addAdditional($additionalDog)
            ],
            "unknown insurance and additional" => [
                "expectedAdditionalNames" => ["unknown"],
                "expectedTotalPrice" => 0,
                "offer" => (new Offer($id, $insuranceUnknown))
                    ->addAdditional($additionalUnknown)
            ],
        ];
    }

    public static function additionalNamesProvider(): array
    {
        return array_map(
            fn (array $data): array => [$data["expectedAdditionalNames"], $data["offer"]],
            self::offerProvider()
        );
    }

    #[
        TestDox('Get additional names of offer is correct'),
        DataProvider('additionalNamesProvider')
    ]
    public function testGetAdditionalNames(array $expected, Offer $offer): void
    {
        $this->assertEquals($expected, $offer->getAdditionalNames());
    }

    public static function totalPriceProvider(): array
    {
        return array_map(
            fn (array $data): array => [$data["expectedTotalPrice"], $data["offer"]],
            self::offerProvider()
        );
    }

    #[
        TestDox('Get total price of offer is correct'),
        DataProvider('totalPriceProvider')
    ]
    public function testGetTotalPrice(int $expected, Offer $offer): void
    {
        $this->assertEquals($expected, $offer->getTotalPrice()->ammount);
    }

    #[
        TestDox('Get type of offer is correct with type $expected'),
        TestWith(['flat', InsuranceType::Flat]),
        TestWith(['casco', InsuranceType::Casco]),
        TestWith(['unknown', InsuranceType::Unknown]),
    ]
    public function testGetType(string $expected, InsuranceType $type): void
    {
        $offer = new Offer(Id::generate(), new Insurance($type));

        $this->assertEquals($expected, $offer->getType());
    }
}
