<?php

class CardSuitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getSuitProvider
     */
    public function testGetSuit($setSuit)
    {
        $suit = new \core\games\suits\CardSuit($setSuit);

        $this->assertEquals($suit->getSuit(), $setSuit);
        $this->assertNotEmpty($suit->getSuit());
    }

    /**
     * @return array
     */
    public function getSuitProvider()
    {
        return [
            [\core\games\suits\Suit::HEART],
            [\core\games\suits\Suit::DIAMOND],
            [\core\games\suits\Suit::CLUB],
            [\core\games\suits\Suit::SPADE],
        ];
    }
}