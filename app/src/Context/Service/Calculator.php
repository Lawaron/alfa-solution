<?php

declare(strict_types=1);

namespace Alfa\Interview\Context\Service;

use Alfa\Interview\Context\Entity\Offer;
use Alfa\Interview\Context\Factory\OfferFactory;

class Calculator
{
    public function __construct(
        private readonly OfferFactory $offerFactory
    ) {
    }

    /**
     * @param array<int, string> $additionals
     */
    public function calculate(string $insuranceType, array $additionals): int
    {
        $offer = $this->offerFactory->create($insuranceType, ...$additionals);

        return $offer->getTotalPrice()->ammount;
    }
}
