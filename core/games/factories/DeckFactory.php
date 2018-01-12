<?php

namespace core\games\factories;

use core\games\deck\ICardDeck;

abstract class DeckFactory implements IDeckFactory
{
    abstract function createDeck(): ICardDeck;
}