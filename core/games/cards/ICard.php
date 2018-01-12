<?php

namespace core\games\cards;

use core\games\ranks\ICardRank;
use core\games\suits\ICardSuit;

interface ICard
{
    public function getCardRank(): ICardRank;
    public function getCardSuit(): ICardSuit;
}