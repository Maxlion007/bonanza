<?php

namespace core\games\game\fool;

use core\games\cards\Card;
use core\games\dealers\IDealer;
use core\games\game\fool\rules\FoolRule;
use core\games\game\Game;
use core\games\ranks\CardRank;
use core\games\suits\CardSuit;
use core\games\suits\Suit;

class FoolGame extends Game
{
    protected function giveCards(array &$players, IDealer $dealer)
    {
        foreach ($players as $player) {
            foreach ($dealer->getCardsForPlayer() as $card) {
                $player->addCard($card);
            }
        }
    }

    public function start()
    {
        echo "Starting game\n";

        echo "Get table players\n";
        $players = $this->getTable()->getPlayers();
        $dealer = $this->getTable()->getDealer();
        // Задать козырь для стола
        $this->getTable()->setLeverage($leverage = $dealer->getLeverage());
        $this->getTable()->setRule(new FoolRule());

        // Раздать карты
        $this->giveCards($players, $dealer);
        $this->getTable()->setCursorToStartPlayer();
        $player1 = $this->getTable()->getCurrent();
        $player2 = $this->getTable()->getNext();

        // get first user card
        $card1 = $player1->getCard();
        $card2 = new Card(new CardRank($card1->getCardRank()->getRank()), new CardSuit(Suit::DIAMOND));
        $enemyCard = $player2->getCard();
        $this->getTable()->addCard($card1);
        $this->getTable()->addCard($card1);
        $this->getTable()->addCard($card1);
        $isSecondAdded = $this->getTable()->addCard($card2);
        $isSecondAdded = $this->getTable()->addCard($card2);
        $isSecondAdded = $this->getTable()->addCard($card2);
        $isSecondAdded = $this->getTable()->addCard($card2);
        echo "Вторая карта:\n";
        var_dump($isSecondAdded);
        var_dump($this->getTable()->getCards());

        // убить карту 0

        if ($this->getTable()->getCardsCount() > 0) {
            echo "Козырь {$leverage->getSuit()}\n";
            echo "-----------На столе-------------------------\n";
            echo "Масть: {$card1->getCardSuit()->getSuit()} Ранг {$card1->getCardRank()->getRank()}\n";
            echo "\n";
            echo "---------------Карта противника----------------------\n";
            echo "Масть: {$enemyCard->getCardSuit()->getSuit()} Ранг {$enemyCard->getCardRank()->getRank()}\n";

            if ($this->getTable()->addCard($enemyCard, 0)) {
                echo "Карта отбита\n";
            } else {
                echo "Карта не отбита\n";
            }
        }
    }
}