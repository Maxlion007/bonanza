<?php

namespace core\games\cards;

interface ICardable
{
    public function addCard(ICard $card);
    public function getCard($index);
}