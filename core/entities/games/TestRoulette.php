<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 22.12.2017
 * Time: 18:23
 */

namespace core\entities\games;


class TestRoulette extends Game
{

    private $bet=50;

    public function __construct($players,$table_id)
    {
        parent::__construct($players,$table_id);
        $this->start();
        $this->finish();
    }

    protected function start()
    {
        $this->getBets();
    }


    protected function finish()
    {
        $this->setWinners($this->getPlayers()[rand(0,count($this->getPlayers())-1)]);
    }


    private function getBets()
    {
        foreach($this->getPlayers() as $player)
        {
            $this->addToBank($player,$this->bet);
        }
    }

}