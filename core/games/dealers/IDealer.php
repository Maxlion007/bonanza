<?php

namespace core\games\dealers;

use core\games\cards\ICard;
use core\games\deck\ICardDeck;

interface IDealer
{
    public function getCard();
}