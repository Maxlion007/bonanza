<?php

namespace core\games\suits;

class CardSuit implements ICardSuit
{
    private $_suit;

    public function __construct(int $suit)
    {
        $this->_suit = $suit;
    }

    public function getSuit(): int
    {
        return $this->_suit;
    }
}