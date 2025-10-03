<?php

declare(strict_types=1);

use Alfa\Interview\Context\Factory\OfferFactory;
use Alfa\Interview\Context\Service\Calculator;

chdir(dirname(__DIR__));

require 'vendor/autoload.php';

$calculator = new Calculator(new OfferFactory());

echo sprintf("%s\n", $calculator->calculate("flat", ["dog", "travel"]));
