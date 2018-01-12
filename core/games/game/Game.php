<?php

namespace core\games\game;

use core\games\tables\ITable;

abstract class Game
{
    private $_table;

    public function setTable(ITable $table)
    {
        $this->_table = $table;
    }

    public function getTable()
    {
        return $this->_table;
    }

    abstract public function start();
}