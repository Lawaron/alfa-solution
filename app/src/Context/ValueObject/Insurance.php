<?php

declare(strict_types=1);

namespace Alfa\Interview\Context\ValueObject;

use Alfa\Interview\Context\Enum\InsuranceType;

class Insurance
{
    public readonly string $type;
    public readonly Price $price;

    public function __construct(InsuranceType $type)
    {
        $this->type = strtolower($type->name);
        $this->price = new Price($type->value);
    }
}
