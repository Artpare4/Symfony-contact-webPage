<?php


namespace App\Tests\Controller\Contact;

use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function seeAllContacts(ControllerTester $I): void
    {
        $I->amOnPage('/contact');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle('Liste des contacts');
        $I->see('Liste des contacts', 'h1');
        $I->seeNumberOfElements('li', 195);
    }
}
