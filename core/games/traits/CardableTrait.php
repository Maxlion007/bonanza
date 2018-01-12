<?php

namespace core\games\traits;

use core\games\cards\ICard;

trait CardableTrait
{
    public function addCard(ICard $card)
    {
        $this->_cards[] = $card;
    }

    public function getCards()
    {
        return $this->_cards;
    }

    public function setCards(array $cards)
    {
        $this->_cards = $cards;
    }

    public function getCardsCount()
    {
        return count($this->getCards());
    }

    public function getCard($index = null)
    {
        if ($index == null) {
            return $this->getRandom();
        } else {
            if (isset($this->_cards[$index])) {
                // remove card from deck
                $card = $this->_cards[$index];

                $this->removeCard($index);

                return $card;
            }
        }
    }

    protected function getRandomIndex()
    {
        return rand(0, count($this->_cards) - 1);
    }

    protected function getRandom(): ICard
    {
        $index = $this->getRandomIndex();

        if (isset($this->_cards[$index])) {
            // remove card from deck
            $card = $this->_cards[$index];
            $this->removeCard($index);
            return $card;
        }
    }

    protected function removeCard($index)
    {
        $length = count($this->_cards);

        if (isset($this->_cards[$index])) {
            if ($length == 1) {
                unset($this->_cards[0]);
            } else {
                array_splice($this->_cards, $index, 1);
            }
        }
    }
}