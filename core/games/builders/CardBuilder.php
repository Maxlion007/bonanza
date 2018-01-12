<?php

namespace core\games\builders;

use core\games\cards\Card;
use core\games\ranks\CardRank;
use core\games\suits\CardSuit;

class CardBuilder implements ICardBuilder
{
    private $_rank;
    private $_suit;
    private $_card;

    public function buildCardRank(int $rank)
    {
        $this->_rank = new CardRank($rank);
    }

    public function buildCardSuit(int $suit)
    {
        $this->_suit = new CardSuit($suit);
    }

    public function buildCard()
    {
        $this->_card = new Card($this->_rank, $this->_suit);
    }

    public function getResult(): Card
    {
        return $this->_card;
    }

    public function reset()
    {
        $this->_card = null;
        $this->_suit = null;
        $this->_rank = null;
    }
}