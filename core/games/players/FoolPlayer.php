<?php

namespace core\games\players;

use core\games\cards\ICard;
use core\games\suits\ICardSuit;

class FoolPlayer extends Player implements IFoolPlayer
{
    public function getMaxCard(ICardSuit $suit)
    {
        $myCards = $this->getCards();

        $leverageCards = [];

        foreach ($myCards as $card) {
            if ($card->getCardSuit()->getSuit() == $suit->getSuit()) {
                $leverageCards[] = $card;
            }
        }

        usort($leverageCards, function ($a, $b) {
            return $b->getCardSuit()->getSuit() <=> $a->getCardSuit()->getSuit();
        });

        return isset($leverageCards[0]) ? $leverageCards[0] : null;
    }

    public function addCards(array $cards)
    {
        foreach ($cards as $card) {
            parent::addCard($card);
        }
    }
}