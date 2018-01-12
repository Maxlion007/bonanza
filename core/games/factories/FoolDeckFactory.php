<?php

namespace core\games\factories;

use core\games\builders\CardBuilder;
use core\games\deck\CardDeck;
use core\games\deck\ICardDeck;

class FoolDeckFactory extends DeckFactory
{
    const START_RANK = 6;
    const START_SUIT = 1;
    const RANKS_COUNT = 14;
    const SUITS_COUNT = 4;

    public function createDeck(): ICardDeck
    {
        $cardDeck = new CardDeck();
        $cardBuilder = new CardBuilder();

        for ($cardRank = self::START_RANK; $cardRank < self::RANKS_COUNT + 1; $cardRank++) {
            $cardBuilder->buildCardRank($cardRank);

            for ($cardSuit = self::START_SUIT; $cardSuit < self::SUITS_COUNT + 1; $cardSuit++) {
                $cardBuilder->buildCardSuit($cardSuit);
                $cardBuilder->buildCard();

                $cardDeck->addCard($cardBuilder->getResult());
            }

            $cardBuilder->reset();
        }

        return $cardDeck;
    }
}