<?php

namespace core\games\dealers;

class FoolDealer extends Dealer
{
    public function getCardsForPlayer()
    {
        // need six cards
        $cards = [];

        for ($i = 0; $i < 6; $i++) {
            $cards[] = $this->getCard();
        }

        return $cards;
    }
}