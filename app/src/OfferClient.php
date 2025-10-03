<?php

namespace Alfa\Interview;

class OfferClient
{
    public function getOffer(string $insuranceType): int
    {
        // Dummy response
        return match ($insuranceType) {
            InsuranceCalculator::TYPE_FLAT => 100,
            InsuranceCalculator::TYPE_CASCO => 200,
            default => 0,
        };
    }
}