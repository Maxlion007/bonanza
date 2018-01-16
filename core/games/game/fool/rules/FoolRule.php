<?php

namespace core\games\game\fool\rules;

use core\games\cards\ICard;
use core\games\suits\ICardSuit;

class FoolRule implements IFooRule
{
    public function canBit(ICard $forBit, ICard $bit, ICardSuit $leverage):bool
    {
        // Проверка мастей, иначе проверка карты на козырь
        if ($bit->getCardSuit()->getSuit() == $forBit->getCardSuit()->getSuit()) {
            // проверка ранга карт
            return $bit->getCardRank()->getRank() > $forBit->getCardRank()->getRank();
        } elseif ($bit->getCardSuit()->getSuit() == $leverage->getSuit()) {
            // получена козырная карта для боя
            if ($forBit->getCardSuit()->getSuit() != $leverage->getSuit()) {
                return true;
            } else {
                return $bit->getCardRank()->getRank() > $forBit->getCardRank()->getRank();
            }
        }

        return false;
    }

    public function canAdd(ICard $card, array $tableCards):bool
    {
        // Первый ход
        if (empty($tableCards)) {
            echo "Пустой стол......\n";
            return true;
        }

        foreach ($tableCards as $tableCard) {
            if (is_array($tableCard)) {
                foreach ($tableCard as $subCard) {
                    if ($subCard->getCardRank()->getRank() == $card->getCardRank()->getRank()) {
                        return true;
                    }
                }
            } else {
                if ($tableCard->getCardRank()->getRank() == $card->getCardRank()->getRank()) {
                    return true;
                }
            }
        }

        return false;
    }

    // Проверка на добавление погонов
    public function canAddStrap(ICard $card): bool
    {
        return false;
    }
}