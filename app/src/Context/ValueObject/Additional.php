<?php

declare(strict_types=1);

namespace Alfa\Interview\Context\ValueObject;

use Alfa\Interview\Context\Enum\AdditionalType;
use Alfa\Interview\Context\Interface\HasPrice;

class Additional implements HasPrice
{
    public function __construct(
        private readonly AdditionalType $type,
        private readonly HasPrice $previous
    ) {
    }

    public function getPrice(): Price
    {
        return $this->previous->getPrice()
            ->add(new Price($this->type->value));
    }
}
