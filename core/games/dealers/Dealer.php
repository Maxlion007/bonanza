<?php

namespace core\games\dealers;

use core\games\cards\ICard;
use core\games\cards\ICardable;
use core\games\factories\IDeckFactory;
use core\games\traits\CardableTrait;

abstract class Dealer implements IDealer, ICardable
{
    use CardableTrait;
    private $_deck;

    public function __construct(IDeckFactory $deck)
    {
        $this->_deck = $deck->createDeck();
    }

    public function getCard($index = null): ICard
    {
        return $this->_deck->getCard($index);
    }

    public function getCards()
    {
        return $this->_deck->getCards();
    }

    public function getLeverage()
    {
        $card = $this->_deck->getCard();

        $leverage = $card->getCardSuit();
        $this->_deck->addCard($card);

        return $leverage;
    }
}