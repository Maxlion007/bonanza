<?php

namespace console\controllers;

use core\games\dealers\FoolDealer;
use core\games\factories\FoolDeckFactory;
use core\games\game\fool\FoolGame;
use core\games\players\FoolPlayer;
use core\games\tables\TableForFool;
use yii\console\Controller;

class CardController extends Controller
{
    public function actionIndex()
    {
        $foolGame = new FoolGame();
        $table = new TableForFool();
        $table->setDealer(new FoolDealer(new FoolDeckFactory()));
        // player 1 join game
        $table->addPlayer(new FoolPlayer());
        // player 2 join game
        $table->addPlayer(new FoolPlayer());

        $foolGame->setTable($table);
        $foolGame->start();
    }

    public function actionTest()
    {

    }
}