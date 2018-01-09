<?php

namespace core\entities\User;

use core\forms\User\CountryForm;
/**
 * This is the model class for table "bnz_countries".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 */
class Country extends \yii\db\ActiveRecord
{

    public static function create(CountryForm $form)
    {
        $new = new static();
        $new->name=$form->name;
        $new->code=$form->code;
        return $new;
    }

    public function edit(CountryForm $form)
    {
        $this->name=$form->name;
        $this->code=$form->code;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bnz_countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            [['id'], 'integer'],
            [['name','code'],'string','max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Country Name',
            'code' => 'Country Code'
        ];
    }

}
