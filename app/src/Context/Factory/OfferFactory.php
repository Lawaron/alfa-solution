<?php

declare(strict_types=1);

namespace Alfa\Interview\Context\Factory;

use Alfa\Interview\Context\Entity\Offer;
use Alfa\Interview\Context\Enum\{AdditionalType, InsuranceType};
use Alfa\Interview\Context\ValueObject\{Additional, Id, Insurance};

class OfferFactory
{
    public function create(string $insuranceType, string ...$additionals): Offer
    {
        $insurance = new Insurance(InsuranceType::fromName($insuranceType));

        $offer = new Offer(Id::generate(), $insurance);

        foreach (array_unique($additionals) as $additional) {
            $type = AdditionalType::fromName($additional);
            $offer->addAdditional($type);
        }

        return $offer;
    }
}
