<?php

namespace App\Factory;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Contact>
 *
 * @method        Contact|Proxy                     create(array|callable $attributes = [])
 * @method static Contact|Proxy                     createOne(array $attributes = [])
 * @method static Contact|Proxy                     find(object|array|mixed $criteria)
 * @method static Contact|Proxy                     findOrCreate(array $attributes)
 * @method static Contact|Proxy                     first(string $sortedField = 'id')
 * @method static Contact|Proxy                     last(string $sortedField = 'id')
 * @method static Contact|Proxy                     random(array $attributes = [])
 * @method static Contact|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ContactRepository|RepositoryProxy repository()
 * @method static Contact[]|Proxy[]                 all()
 * @method static Contact[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Contact[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Contact[]|Proxy[]                 findBy(array $attributes)
 * @method static Contact[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Contact[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ContactFactory extends ModelFactory
{
    private \Transliterator $Translitrator;
    private ?\Transliterator $Transliterator;

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
        $this->Transliterator = \Transliterator::create(1);
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {

        return [
            'firstname' => $this->normalizeName(self::faker()->firstName()),
            'lastname' => $this->normalizeName(self::faker()->lastName()),
            'email' => mb_strtolower(transliterator_transliterate('Any-Latin; Latin-ASCII', 'lastname-firstname@')).self::faker()->domainName(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Contact $contact): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Contact::class;
    }

    protected function normalizeName(string $str): string
    {
        return preg_replace('/[^A-Za-z]/', '-', $str);
    }
}
