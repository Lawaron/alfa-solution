<?php

declare(strict_types=1);

namespace Alfa\Interview\Context\Interface;

use Alfa\Interview\Context\ValueObject\Price;

interface HasPrice
{
    public function getPrice(): Price;
}
