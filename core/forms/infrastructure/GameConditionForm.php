<?php
/**
 * Created by PhpStorm.
 * User: a1
 * Date: 29.05.17
 * Time: 14:37
 */

namespace core\forms\infrastructure;

use core\helpers\GameConditionHelper;
use core\entities\infrastructure\GameCondition;
use yii\base\Model;

/**
 * Class GameConditionForm
 * @package core\forms\manage\User
 * @property array $variants
 */

class GameConditionForm extends Model
{
    public $name;
    public $type;
    public $required;
    public $default;
    public $textVariants;
    public $sort;
    public $slug;
    public $for_fool;
    public $for_poker;
    public $for_seka;
    public $variants;

    private $_condition;

    public function __construct(GameCondition $condition = null, $config = [])
    {
        if ($condition) {
            $this->name = $condition->name;
            $this->type = $condition->type;
            $this->required = $condition->required;
            $this->default = $condition->default;
            $this->textVariants = implode(', ', $condition->variants);
            $this->sort = $condition->sort;
            $this->_condition = $condition;
            $this->slug=$condition->slug;
            $this->for_fool=$condition->for_fool;
            $this->for_poker=$condition->for_poker;
            $this->for_seka=$condition->for_seka;
        } else {
            $this->sort = GameCondition::find()->max('sort') + 1;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'type', 'sort','slug'], 'required'],
            [['required','for_seka','for_fool','for_poker'], 'boolean'],
            [['default'], 'string', 'max' => 255],
            [['textVariants'],'string'],
            [['sort'],'integer'],
            [['slug'],'unique','targetClass' => GameCondition::class,'filter' => $this->_condition ? ['<>', 'id', $this->_condition->id] : null],
            [['name'], 'unique', 'targetClass' => GameCondition::class, 'filter' => $this->_condition ? ['<>', 'id', $this->_condition->id] : null]
        ];
    }

    public function getVariants()
    {
     return preg_split('#[\r\n]+#i', $this->textVariants);
    }

    public function typesList()
    {
        return GameConditionHelper::typeList();
    }
    public function afterValidate()
    {
        if($this->textVariants!='')
        {
            $variants=explode(',',$this->textVariants);
            foreach($variants as &$variant)
            {
                $variant=trim($variant);
            }
        }
        else
        {
            $variants='';
        }
        $this->variants=$variants;

        parent::afterValidate();
    }
}