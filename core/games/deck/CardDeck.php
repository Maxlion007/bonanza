<?php

namespace core\games\deck;

use core\games\cards\ICardable;
use core\games\traits\CardableTrait;

class CardDeck implements ICardDeck, ICardable
{
    use CardableTrait;

    private $_cards = [];
}