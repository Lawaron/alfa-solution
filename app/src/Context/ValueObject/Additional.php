<?php

declare(strict_types=1);

namespace Alfa\Interview\Context\ValueObject;

use Alfa\Interview\Context\Enum\AdditionalType;

class Additional
{
    public readonly string $name;
    public readonly Price $price;

    public function __construct(AdditionalType $type)
    {
        $this->name = strtolower($type->name);
        $this->price = new Price($type->value);
    }
}
