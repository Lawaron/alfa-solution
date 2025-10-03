<?php

declare(strict_types=1);

namespace Tests\Unit\Context\Factory;

use Alfa\Interview\Context\Entity\Offer;
use Alfa\Interview\Context\Enum\{AdditionalType, InsuranceType};
use Alfa\Interview\Context\Factory\OfferFactory;
use Alfa\Interview\Context\ValueObject\{Additional, Id, Insurance};
use PHPUnit\Framework\Attributes\{DataProvider, TestDox};
use PHPUnit\Framework\Constraint\Callback;
use PHPUnit\Framework\TestCase;

final class OfferFactoryTest extends TestCase
{
    private OfferFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new OfferFactory();
    }

    public static function offerProvider(): array
    {
        return [
            'no additionals' => [
                new Offer(
                    Id::generate(),
                    new Insurance(InsuranceType::Flat)
                ),
                ['flat']
            ],
            'a single additional' => [
                (new Offer(
                    Id::generate(),
                    new Insurance(InsuranceType::Flat)
                ))->addAdditional(new Additional(AdditionalType::Dog)),
                ['flat', 'dog']
            ],
            'more additionals' => [
                (new Offer(
                    Id::generate(),
                    new Insurance(InsuranceType::Casco)
                ))->addAdditional(new Additional(AdditionalType::Dog))
                  ->addAdditional(new Additional(AdditionalType::Travel)),
                ['casco', 'dog', 'travel']
            ],
            'repetitive additionals' => [
                (new Offer(
                    Id::generate(),
                    new Insurance(InsuranceType::Casco)
                ))->addAdditional(new Additional(AdditionalType::Dog))
                  ->addAdditional(new Additional(AdditionalType::Dog)),
                ['casco', 'dog', 'dog']
            ],
            'unknown insurance and additional' => [
                (new Offer(
                    Id::generate(),
                    new Insurance(InsuranceType::Unknown)
                ))->addAdditional(new Additional(AdditionalType::Unknown)),
                ['unknown', 'unknown']
            ],
        ];
    }

    /**
     * @param array<int, string> $parameters
     */
    #[
        TestDox('It creates an offer with given insurance type and additionals'),
        DataProvider('offerProvider')
    ]
    public function testCreate(Offer $expected, array $parameters): void
    {
        $this->assertThat(
            $this->factory->create(...$parameters),
            $this->getComparator($expected)
        );
    }

    private function getComparator(Offer $expected): Callback
    {
        $callback = fn (Offer $actual): bool => $actual->getType() === $expected->getType()
            && $actual->getAdditionalNames() === $expected->getAdditionalNames();

        return new Callback($callback);
    }
}
