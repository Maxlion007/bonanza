<?php

namespace core\forms\User;
use yii\base\Model;
/**
 * This is the model class for table "bnz_countries".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 */
class CountryForm extends Model
{
    public $name;
    public $code;

    public static function create($name,$code)
    {
        $new = new static();
        $new->name=$name;
        $new->code=$code;
        return $new;
    }

    public function edit($name,$code)
    {
        $this->name=$name;
        $this->code=$code;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            [['name','code'],'string','max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Country Name',
            'code' => 'Country Code'
        ];
    }

}
