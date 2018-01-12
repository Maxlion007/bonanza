<?php

namespace core\games\cards;

use core\games\ranks\ICardRank;
use core\games\suits\ICardSuit;

class Card implements ICard
{
    private $_cardRank;
    private $_cardSuit;

    public function __construct(ICardRank $cardRank, ICardSuit $cardSuit)
    {
        $this->_cardRank = $cardRank;
        $this->_cardSuit = $cardSuit;
    }

    public function getCardRank() : ICardRank
    {
        return $this->_cardRank;
    }

    public function getCardSuit(): ICardSuit
    {
        return $this->_cardSuit;
    }
}