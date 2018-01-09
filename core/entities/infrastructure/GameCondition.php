<?php
/**
 * Created by PhpStorm.
 * User: a1
 * Date: 29.05.17
 * Time: 14:26
 */

namespace core\entities\infrastructure;

use core\forms\infrastructure\GameConditionForm;
use yii\db\ActiveRecord;
use yii\helpers\Json;

/**
 * Class GameCondition
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $slug
 * @property string $required
 * @property string $default
 * @property array $variants
 * @property integer $sort
 * @property integer $for_fool
 * @property integer $for_poker
 * @property integer $for_seka
 */
class GameCondition extends ActiveRecord
{

    const TYPE_STRING = 'string';
    const TYPE_INTEGER = 'integer';
    const TYPE_FLOAT = 'float';
    const TYPE_MULTIPLE='multiple';
    const TYPE_BOOLEAN='boolean';

    public $variants;

    public static function create(GameConditionForm $form)
    {
        $object = new static();
        $object->name = $form->name;
        $object->type = $form->type;
        $object->required = $form->required;
        $object->default = $form->default;
        $object->variants = $form->variants;
        $object->sort = $form->sort;
        $object->slug = $form->slug;
        $object->for_fool=$form->for_fool;
        $object->for_poker=$form->for_poker;
        $object->for_seka=$form->for_seka;
        return $object;
    }

    public function edit(GameConditionForm $form)
    {
        $this->name = $form->name;
        $this->type = $form->type;
        $this->required = $form->required;
        $this->default = $form->default;
        $this->variants = $form->variants;
        $this->sort = $form->sort;
        $this->slug = $form->slug;
        $this->for_fool=$form->for_fool;
        $this->for_poker=$form->for_poker;
        $this->for_seka=$form->for_seka;
    }

    public function isString()
    {
        return $this->type === self::TYPE_STRING;
    }

    public function isInteger()
    {
        return $this->type === self::TYPE_INTEGER;
    }

    public function isFloat()
    {
        return $this->type === self::TYPE_FLOAT;
    }

    public function isBoolean()
    {
        return $this->type === self::TYPE_BOOLEAN;
    }

    public function isMultiple()
    {
        return $this->type === self::TYPE_MULTIPLE;
    }


    public function isSelect()
    {
        return count($this->variants) > 0;
    }

    public static function tableName()
    {
        return '{{%bnz_game_conditions}}';
    }

    public function afterFind()
    {
        if($this->variants_json!='' && $this->variants_json!='[]')
        {
            $this->variants = array_filter(Json::decode($this->getAttribute('variants_json')));
        }
        else
        {
            $this->variants=[];
        }

        parent::afterFind();
    }

    public function beforeSave($insert)
    {
        if($this->variants!='')
        {
            $this->setAttribute('variants_json', Json::encode(array_filter($this->variants)));
        }
        else
        {
            $this->variants='[]';
        }

        return parent::beforeSave($insert);
    }
}