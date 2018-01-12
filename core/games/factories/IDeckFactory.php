<?php

namespace core\games\factories;

use core\games\deck\ICardDeck;

interface IDeckFactory
{
    public function createDeck():ICardDeck;
}