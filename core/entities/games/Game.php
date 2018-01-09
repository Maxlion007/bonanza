<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 22.12.2017
 * Time: 12:49
 */

namespace core\entities\games;

use Yii;
use core\forms\transactions\GameTransactionForm;
use core\managers\transactions\GameTransactionManager;
use core\repositories\infrastructure\TableRepository;

abstract class Game
{
    private $players;
    private $winners;
    private $table_id;

    public function __construct($players,$table_id)
    {
        $this->players=$players;
        $this->table_id=$table_id;
    }
    public function getTable()
    {
        return Yii::$container->get(TableRepository::class)->get($this->table_id);
    }

    public function getBank(): int
    {
        return $this->getTable()->bank;
    }

    protected function addToBank($player_id,$amount)
    {
        Yii::$container->get(GameTransactionManager::class)->quickCreate($player_id,$this->table_id,$amount);
    }

    abstract protected function start();

    abstract protected function finish();

    protected function awardWinners()
    {
        $bank=-$this->getBank();
        $part=$bank/count($this->getWinners());
        foreach($this->getWinners() as $winner)
        {
            Yii::$container->get(GameTransactionManager::class)->quickCreate($winner,$this->table_id,$part);
        }
    }

    public function getPlayers(): array
    {
        return $this->players;
    }

    public function setPlayers(array $players)
    {
        $this->players=$players;
    }

    public function getWinners(): array
    {
        return $this->winners;
    }

    public function setWinners(array $winners)
    {
        $this->winners=$winners;
    }

}