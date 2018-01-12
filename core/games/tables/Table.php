<?php

namespace core\games\tables;

use core\games\traits\CardableTrait;
use core\games\traits\TableableTrait;

abstract class Table implements ITable
{
    use CardableTrait;
    use TableableTrait;
    private $_cards = [];
    private $_players = [];
    private $_dealer;
}