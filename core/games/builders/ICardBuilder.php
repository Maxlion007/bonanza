<?php

namespace core\games\builders;

interface ICardBuilder
{
    public function buildCardRank(int $rank);
    public function buildCardSuit(int $suit);
    public function buildCard();
}