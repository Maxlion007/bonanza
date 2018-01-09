<?php

namespace core\services;

//use core\dispatchers\DeferredEventDispatcher;

class DbTransactionManager
{
    private $dispatcher;

//    public function __construct(DeferredEventDispatcher $dispatcher)
//    {
//        $this->dispatcher = $dispatcher;
//    }

    public function wrap(callable $function)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
          //  $this->dispatcher->defer();
            $function();
            $transaction->commit();
           // $this->dispatcher->release();
        } catch (\Exception $e) {
            $transaction->rollBack();
         //   $this->dispatcher->clean();
            throw $e;
        }
    }
}