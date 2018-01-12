<?php

namespace core\games\players;

use core\games\cards\ICard;

interface IFoolPlayer
{
    public function move(ICard $myCard, ICard $enemyCard = null);
}