<?php

require_once __DIR__ . '/vendor/autoload.php';

use Alfa\Interview\OfferClient;
use Alfa\Interview\InsuranceCalculator;

$offerClient = new OfferClient();

$calculator = new InsuranceCalculator(
    InsuranceCalculator::TYPE_FLAT,
    [InsuranceCalculator::ADDITIONAL_DOG, InsuranceCalculator::ADDITIONAL_TRAVEL],
    $offerClient
);

echo $calculator->calculate();
