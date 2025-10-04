<?php

declare(strict_types=1);

namespace Alfa\Interview\Context\Entity;

use Alfa\Interview\Context\Enum\AdditionalType;
use Alfa\Interview\Context\Interface\HasPrice;
use Alfa\Interview\Context\ValueObject\{Additional, Id, Insurance, Price};

class Offer
{
    /**
     * @var array<string, Additional>
     */
    private array $additionals = [];

    private HasPrice $item;

    public function __construct(
        private readonly Id $id,
        Insurance $insurance
    ) {
        $this->item = $insurance;
    }

    public function addAdditional(AdditionalType $additional): self
    {
        $this->item = new Additional($additional, $this->item);

        return $this;
    }

    public function getTotalPrice(): Price
    {
        return $this->item->getPrice();
    }
}
