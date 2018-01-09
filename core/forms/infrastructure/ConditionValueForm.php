<?php
/**
 * Created by PhpStorm.
 * User: a1
 * Date: 29.05.17
 * Time: 16:46
 */

namespace core\forms\infrastructure;

use core\entities\infrastructure\GameCondition;
use yii\base\Model;
use core\entities\infrastructure\ConditionValue;

/**
 * Class ConditionValueForm
 * @package core\forms\manage\User
 * @property integer $id
 */
class ConditionValueForm extends Model
{
    public $value;

    private $_condition;

    public function __construct(GameCondition $condition, ConditionValue $value = null, $config = [])
    {
        if ($value) {
            $this->value = $value->value;
        }
        $this->_condition = $condition;
        parent::__construct($config);
    }

    public function rules()
    {
        return array_filter([
            $this->_condition->required ? ['value', 'required'] : false,
            $this->_condition->isString() ? ['value', 'string', 'max' => 255] : false,
            $this->_condition->isInteger() ? ['value', 'integer'] : false,
            $this->_condition->isFloat() ? ['value', 'number'] : false,
            ['value', 'safe'],
        ]);
    }

    public function attributeLabels()
    {
        return [
            'value' => $this->_condition->name,
        ];
    }

    public function variantsList()
    {
        return $this->_condition->variants ? array_combine($this->_condition->variants, $this->_condition->variants) : [];
    }

    public function getId()
    {
        return $this->_condition->id;
    }
    public function getType()
    {
        return $this->_condition->type;
    }
}