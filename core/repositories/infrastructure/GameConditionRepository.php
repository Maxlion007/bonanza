<?php
/**
 * Created by PhpStorm.
 * User: a1
 * Date: 29.05.17
 * Time: 15:00
 */

namespace core\repositories\infrastructure;

use core\entities\infrastructure\GameCondition;
use core\repositories\NotFoundExeption;
use core\repositories\ObjectRepository;
class GameConditionRepository extends ObjectRepository
{
    public $subjectClass;

    public function __construct()
    {
        $this->subjectClass=GameCondition::class;
        return parent::__construct($this->subjectClass);
    }

    public function getByGameName($game_name)
    {
        $game='for_'.$game_name;
        return $this->getAll([$game=>1]);
    }
}