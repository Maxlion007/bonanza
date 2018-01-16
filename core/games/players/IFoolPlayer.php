<?php

namespace core\games\players;

use core\games\cards\ICard;

interface IFoolPlayer
{
    public function addCards(array $cards);
    public function addStrap(ICard $card);
}