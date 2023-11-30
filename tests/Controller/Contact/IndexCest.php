<?php

namespace App\Tests\Controller\Contact;

use App\Factory\ContactFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function seeAllContacts(ControllerTester $I): void
    {
        ContactFactory::createMany(5);
        $I->amOnPage('/contact');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle('Liste des contacts');
        $I->see('Liste des contacts', 'h1');
        $I->seeNumberOfElements('.contact', 5);
    }

    public function checkRoadLink(ControllerTester $I): void
    {
        ContactFactory::createOne(['firstname' => 'Joe', 'lastname' => 'Aaaaaaaaaaaaaaa']);
        ContactFactory::createMany(5);
        $I->amOnPage('/contact');
        $I->seeResponseCodeIsSuccessful();
        $I->click('Aaaaaaaaaaaaaaa, Joe');
        $I->seeResponseCodeIsSuccessful();
        $I->seeCurrentRouteIs('app_contact_show');
    }

    public function ckeckValuesOrder(ControllerTester $I): void
    {
        ContactFactory::createSequence([
            ['firstname' => 'Joe', 'lastname' => 'A'],
            ['firstname' => 'Arthur', 'lastname' => 'B'],
            ['firstname' => 'Erwan', 'lastname' => 'W'],
            ['firstname' => 'Louise', 'lastname' => 'C'],
        ]);
        $I->amOnPage('/contact');
        $contacts = $I->grabMultiple('.name');
        $I->assertEquals(['A, Joe', 'B, Arthur', 'C, Louise', 'W, Erwan'], $contacts);
    }

    public function testSearchFromIndex(ControllerTester $I): void
    {
        ContactFactory::createSequence([
            ['firstname' => 'Bing', 'lastname' => 'A'],
            ['firstname' => 'Arthur', 'lastname' => 'Bing'],
            ['firstname' => 'Erwan', 'lastname' => 'W'],
            ['firstname' => 'Louise', 'lastname' => 'C'],
        ]);
        $I->amOnPage('/contact');
        $I->fillField('search', 'Bing');
        $I->click('Chercher');
        $contacts = $I->grabMultiple('.name');
        $I->seeResponseCodeIsSuccessful();
        $I->assertEquals(['A, Bing', 'Bing, Arthur'], $contacts);
    }

    public function testSearchFromContactInfo(ControllerTester $I): void
    {
        ContactFactory::createSequence([
            ['firstname' => 'Bing', 'lastname' => 'A'],
            ['firstname' => 'Arthur', 'lastname' => 'Bing'],
            ['firstname' => 'Erwan', 'lastname' => 'W'],
            ['firstname' => 'Louise', 'lastname' => 'C'],
        ]);
        $I->amOnPage('/contact/2');
        $I->fillField('search', 'Bing');
        $I->click('Chercher');
        $contacts = $I->grabMultiple('.name');
        $I->seeResponseCodeIsSuccessful();
        $I->assertEquals(['A, Bing', 'Bing, Arthur'], $contacts);
    }
}
