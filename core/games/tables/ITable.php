<?php

namespace core\games\tables;

use core\games\dealers\IDealer;
use core\games\players\Player;

interface ITable
{
    public function addPlayer(Player $player);
    public function getPlayer();
    public function setDealer(IDealer $dealer);
    public function getDealer();
}