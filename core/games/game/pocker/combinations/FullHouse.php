<?php

namespace core\games\game\pocker\combinations;

class FullHouse implements ICombination
{
    public function isActive(): bool
    {
        return false;
    }
}