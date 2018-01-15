<?php

namespace core\games\tables;

use core\games\cards\ICard;
use core\games\game\fool\rules\IFooRule;
use core\games\suits\ICardSuit;

class TableForFool extends Table
{
    private $_playerIndex = 0;
    private $_leverage;
    private $_rule;


    public function removeCards(): array
    {
        $cards = parent::getCards();

        parent::setCards([]);

        return $cards;
    }

    public function setRule(IFooRule $rule)
    {
        $this->_rule = $rule;
    }

    public function getRule()
    {
        return $this->_rule;
    }

    public function setLeverage(ICardSuit $suit)
    {
        $this->_leverage = $suit;
    }

    public function getLeverage()
    {
        return $this->_leverage;
    }

    public function addCard(ICard $card, $cardIndex = null)
    {
        if ($cardIndex === null) {
            // Выбросить карту на стол
            if ($this->_rule->canAdd($card, parent::getCards())) {
                parent::addCard($card);

                return true;
            }
        } else {
            $cards = parent::getCards();

            if (isset($cards[$cardIndex]) && $this->_rule->canBit($cards[$cardIndex], $card, $this->getLeverage())) {
                // Отбить карту
                if (isset($cards[$cardIndex])) {
                    $cards[$cardIndex] = [$card, $cards[$cardIndex]];
                    parent::setCards($cards);

                    // Карта отбита
                    return true;
                }
            }
        }

        // Карта не отбита или не добавлена
        return false;
    }

    public function setCursorToStartPlayer()
    {
        $cards = [];

        foreach ($this->getPlayers() as $index => $player) {
            $card = $player->getMaxCard($this->getLeverage());

            if ($card != null) {
                $cards[$index] = $card;
            }
        }

        asort($cards);

        $this->_playerIndex = isset($cards[0]) ? key($cards) : rand(0, count($this->getPlayers()) - 1);
    }

    public function getCurrent()
    {
        return $this->getPlayers()[$this->_playerIndex];
    }

    public function getNext()
    {
        if (isset($this->getPlayers()[$this->_playerIndex - 1])) {
            return $this->getPlayers()[$this->_playerIndex = $this->_playerIndex - 1];
        } else {
            return $this->getPlayers()[$this->_playerIndex = count($this->getPlayers()) - 1];
        }
    }

    public function getPrev()
    {
        if (isset($this->getPlayers()[$this->_playerIndex + 1])) {
            return $this->getPlayers()[$this->_playerIndex = $this->_playerIndex + 1];
        } else {
            return $this->getPlayers()[$this->_playerIndex = count($this->getPlayers()) + 1];
        }
    }

    public function cursorReset()
    {
        $this->_playerIndex = 0;
    }
}