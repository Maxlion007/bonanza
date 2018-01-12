<?php

namespace core\games\players;

interface IPlayerIterator
{
    public function current(): Player;
    public function prev(): Player;
    public function next(): Player;
    public function reset();
}