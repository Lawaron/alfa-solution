<?php

declare(strict_types=1);

use Alfa\Interview\Context\Factory\OfferFactory;
use Alfa\Interview\Context\Service\Calculator;

require dirname(__DIR__) . "/vendor/autoload.php";

$calculator = new Calculator(new OfferFactory());

echo sprintf("%s\n", $calculator->calculate("flat", ["dog", "travel"]));
