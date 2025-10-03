<?php

declare(strict_types=1);

namespace Alfa\Interview\Context\Entity;

use Alfa\Interview\Context\ValueObject\{Additional, Id, Insurance, Price};

class Offer
{
    /**
     * @var array<string, Additional>
     */
    private array $additionals = [];

    public function __construct(
        private readonly Id $id,
        private readonly Insurance $insurance,
    ) {
    }

    public function getType(): string
    {
        return $this->insurance->type;
    }

    /**
     * @return array<int, string>
     */
    public function getAdditionalNames(): array
    {
        return array_keys($this->additionals);
    }

    public function addAdditional(Additional $additional): self
    {
        $this->additionals[$additional->name] = $additional;

        return $this;
    }

    public function getTotalPrice(): Price
    {
        $reducer = fn (Price $carry, Additional $item): Price => $carry->add($item->price);

        return array_reduce($this->additionals, $reducer, $this->insurance->price);
    }
}
