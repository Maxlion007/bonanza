<?php

class CardTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getCardSuitDataProvider
     */
    public function testGetCardSuit($setSuit)
    {
        $cardSuit = new \core\games\suits\CardSuit(['suit', $setSuit]);
        $suit = new \core\games\cards\Card(
            new \core\games\ranks\CardRank(\core\games\ranks\Rank::TWO),
            $cardSuit
        );

        $this->assertEquals(['suit', $suit->getCardSuit()], $cardSuit);
        $this->assertNotEmpty($suit->getCardSuit());
    }

    /**
     * @return array
     */
    public function getCardSuitDataProvider()
    {
        return [
            [\core\games\suits\Suit::HEART],
            [\core\games\suits\Suit::DIAMOND],
            [\core\games\suits\Suit::CLUB],
            [\core\games\suits\Suit::SPADE],
        ];
    }

    /**
     * @dataProvider cardDataProvider
     */
    public function testGetCardRank($setRank)
    {
        $cardRank = new \core\games\ranks\CardRank($setRank);
        $card = new \core\games\cards\Card(
            $cardRank,
            new \core\games\suits\CardSuit(\core\games\suits\Suit::DIAMOND)
        );

        $this->assertEquals($card->getCardRank(), $cardRank);
        $this->assertNotEmpty($card->getCardRank());
    }

    /**
     * @return array
     */
    public function cardDataProvider()
    {
        return [
            [\core\games\ranks\Rank::TWO]
            [\core\games\ranks\Rank::THREE]
            [\core\games\ranks\Rank::FOUR]
            [\core\games\ranks\Rank::FIVE]
            [\core\games\ranks\Rank::SIX]
            [\core\games\ranks\Rank::SEVEN]
            [\core\games\ranks\Rank::EIGHT]
            [\core\games\ranks\Rank::NINE]
            [\core\games\ranks\Rank::TEN]
            [\core\games\ranks\Rank::JACK]
            [\core\games\ranks\Rank::QUEEN]
            [\core\games\ranks\Rank::KING]
            [\core\games\ranks\Rank::ACE]
            [\core\games\ranks\Rank::JOKER]
        ];
    }
}