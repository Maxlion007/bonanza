<?php

namespace core\games\traits;

use core\games\dealers\IDealer;
use core\games\players\Player;

trait TableableTrait
{
    public function setDealer(IDealer $dealer)
    {
        $this->_dealer = $dealer;
    }

    public function getDealer()
    {
        return $this->_dealer;
    }

    public function addPlayer(Player $player)
    {
        echo "Player join table\n";
        $this->_players[] = $player;
    }

    public function getPlayers()
    {
        return $this->_players;
    }

    public function getPlayer($index = null)
    {
        if ($index == null) {
            return $this->getRandomPlayer();
        } else if (isset($this->_players[$index])) {
            $player = $this->_players[$index];
            unset($this->_players[$index]);

            return $player;
        }
    }

    protected function getRandomPlayer()
    {
        $length = count($this->_players);

        $index = rand(0, $length - 1);

        if (isset($this->_players[$index])) {
            $player = $this->_players[$index];
            unset($this->_players[$index]);

            return $player;
        }
    }
}