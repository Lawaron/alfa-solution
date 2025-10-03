<?php

declare(strict_types=1);

namespace Alfa\Interview\Context\ValueObject;

class Price
{
    public function __construct(public readonly int $ammount)
    {
    }

    public function add(self $toAdd): self
    {
        return new self($this->ammount + $toAdd->ammount);
    }
}
