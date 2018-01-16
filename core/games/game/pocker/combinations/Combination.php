<?php

namespace core\games\game\pocker\combinations;

use core\games\traits\CardableTrait;

abstract class Combination
{
    use CardableTrait;

    private $_rank;
    private $_cards = [];


    public function __construct(array $cards)
    {
        $this->_cards = $cards;
    }

    public function setRank(int $rank)
    {
        $this->_rank = $rank;
    }

    public function getRank()
    {
        return $this->_rank;
    }
}