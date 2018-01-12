<?php

namespace core\games\ranks;

class CardRank implements ICardRank
{
    private $_rank;

    public function __construct(int $rank)
    {
        $this->_rank = $rank;
    }

    public function getRank(): int
    {
        return $this->_rank;
    }
}