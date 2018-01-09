<?php

namespace core\entities\infrastructure;

use core\forms\infrastructure\TableLogForm;
use Yii;

/**
 * This is the model class for table "bnz_table_log".
 *
 * @property integer $id
 * @property integer $table_id
 * @property integer $text
 * @property string $datetime
 *
 * @property Table $table
 */
class TableLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function create(TableLogForm $form)
    {
        $new=new static();
        $new->table_id=$form->table_id;
        $new->text=$form->text;
        $new->datetime=date('Y-m-d H:i:s');
        return $new;
    }

    public function edit(TableLogForm $form)
    {
        $this->text=$form->text;
    }

    public static function tableName()
    {
        return 'bnz_table_log';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table_id' => 'Table ID',
            'text' => 'Text',
            'datetime' => 'Datetime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTable()
    {
        return $this->hasOne(Table::className(), ['id' => 'table_id']);
    }
}
