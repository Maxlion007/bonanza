<?php

namespace core\entities\documents\behaviors;

use core\entities\documents\Meta;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use core\entities\documents\Shop\Brand;

class MetaBehavior extends Behavior
{
    public $attribute = 'meta';
    public $jsonAttribute = 'meta_json';

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'onAfterFind',
            ActiveRecord::EVENT_BEFORE_INSERT => 'onBeforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'onBeforeSave',
        ];
    }

    public function onAfterFind(Event $event)
    {
        $brand = $event->sender;
        $meta = Json::decode($this->getAttribute($this->jsonAttribute));
        $this->{$this->attribute}=new Meta(ArrayHelper::getValue($meta,'title'),ArrayHelper::getValue($meta,'description'),ArrayHelper::getValue($meta,'keywords'));


//decomment later        $model = $event->sender;
//        $meta = Json::decode($model->getAttribute($this->jsonAttribute));
//        $model->{$this->attribute} = new Meta(
//            ArrayHelper::getValue($meta, 'title'),
//            ArrayHelper::getValue($meta, 'description'),
//            ArrayHelper::getValue($meta, 'keywords')
//        );
    }

    public function onBeforeSave(Event $event)
    {
        $brand=$event->sender;
        $brand->setAttribute($this->jsonAttribute, Json::encode(
            [
                'title'=>$this->meta->title,
                'description'=>$this->meta->description,
                'keywords'=>$this->meta->keywords
            ]
        ));
//decomment later        $model = $event->sender;
//        $model->setAttribute('meta_json', Json::encode([
//            'title' => $model->{$this->attribute}->title,
//            'description' => $model->{$this->attribute}->description,
//            'keywords' => $model->{$this->attribute}->keywords,
//        ]));
    }
}