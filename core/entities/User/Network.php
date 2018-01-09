<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 20.09.2017
 * Time: 19:32
 */

namespace core\entities\User;


use yii\db\ActiveRecord;
use Webmozart\Assert\Assert;

class Network extends ActiveRecord
{

    public static function create($network,$identity)
    {
        Assert::notEmpty($network);
        Assert::notEMpty($identity);

        $item = new static();

        $item->network = $network;
        $item->identity = $identity;
        return $item;
    }

    public function isFor($network, $identity)
    {
        return $this->network === $network && $this->identity === $identity;
    }

    public static function tableName()
    {
        return '{{%user_networks}}';
    }
}