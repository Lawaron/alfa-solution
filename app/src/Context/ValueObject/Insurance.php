<?php

declare(strict_types=1);

namespace Alfa\Interview\Context\ValueObject;

use Alfa\Interview\Context\Enum\InsuranceType;
use Alfa\Interview\Context\Interface\HasPrice;

class Insurance implements HasPrice
{
    public function __construct(
        private readonly InsuranceType $type
    ) {
    }

    public function getPrice(): Price
    {
        return new Price($this->type->value);
    }
}
