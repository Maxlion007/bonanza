<?php

namespace core\games\game\fool\rules;

use core\games\cards\ICard;
use core\games\suits\ICardSuit;

interface IFooRule
{
    public function canBit(ICard $forBit, ICard $bit, ICardSuit $leverage):bool;
    public function canAdd(ICard $card, array $tableCards):bool;
}