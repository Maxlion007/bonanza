<?php

namespace core\games\players;

use core\games\cards\ICardable;
use core\games\traits\CardableTrait;

abstract class Player implements ICardable
{
    use CardableTrait;

    private $_cards = [];
}