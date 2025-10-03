<?php

namespace Alfa\Interview;

class InsuranceCalculator
{
    public const TYPE_FLAT = 'flat';
    public const TYPE_CASCO = 'casco';

    public const ADDITIONAL_DOG = 'dog';
    public const ADDITIONAL_TRAVEL = 'travel';

    private const ADDITIONAL_PRICES = [
        self::ADDITIONAL_DOG => 50,
        self::ADDITIONAL_TRAVEL => 100,
    ];

    public function __construct(
        private readonly string      $insuranceType,
        private readonly array       $additionals,
        private readonly OfferClient $client
    )
    {
    }

    public function calculate(): int
    {
        $basePrice = $this->client->getOffer($this->insuranceType);

        foreach ($this->additionals as $additional) {
            $basePrice += self::ADDITIONAL_PRICES[$additional] ?? 0;
        }

        return $basePrice;
    }
}