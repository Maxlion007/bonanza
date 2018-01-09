<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26.12.2017
 * Time: 18:43
 */

namespace core\forms\infrastructure;

use \Yii;
use core\repositories\infrastructure\GameConditionRepository;
use yii\base\Model;
use core\helpers\GameHelper;
use yii\helpers\ArrayHelper;

class AllGameConditionsForm extends Model
{

    public $conditions;
    public function __construct(string $game_type)
    {
        if(GameHelper::checkGameType($game_type))
        {
            $this->conditions=$this->getConditions($game_type);
        }
        return parent::__construct();
    }


    public function getConditions($game_type)
    {
        $data= ArrayHelper::index(Yii::$container->get(GameConditionRepository::class)->getByGame($game_type),'slug');
        return $data;
    }

    public function rules()
    {

//        $data=[            [['name', 'type', 'sort','slug'], 'required'],
//            [['required','for_seka','for_fool','for_poker'], 'boolean'],
//            [['default'], 'string', 'max' => 255],
//            [['textVariants'],'string'],
//            [['sort'],'integer']
//        ];
//        var_dump($data)
//        die();
        $rules=[];

        $required=[[],'required'];
        foreach($this->conditions as $condition)
        {
            if($condition->required)
            {
                $required[0][]=$condition->slug;
            }

            $rule=[];
            $data=                array_merge([$condition->slug],array_filter([
//                $condition->isString() ? ['string', 'max' => 255] : false,
                $condition->isInteger() ? ['integer'] : false,
                $condition->isFloat() ? ['number'] : false,
                ['safe'],
            ]));
            array_walk_recursive(
                $data,
                function($value) use (&$rule) {
                    $rule[] = $value;
                }
            );
            $rules[]=$rule;
        }
        if(count($required[0])>0)
        {
            array_unshift($rules,$required);

        }
//        var_dump($rules);
//        die();
        return $rules;
    }

//    public function rules()
//    {
//        return [['test','required'],
//            ['test','string']];
//    }




}