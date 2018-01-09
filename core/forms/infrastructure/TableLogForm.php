<?php

namespace core\forms\infrastructure;

use core\entities\infrastructure\TableLog;
use Yii;
use core\entities\infrastructure\Table;
/**
 * @property integer $id
 * @property integer $table_id
 * @property integer $text
 * @property string $datetime
 *
 * @property TableForm $tableForm
 */
class TableLogForm extends \yii\base\Model
{

    public $table_id;
    public $datetime;
    public $text;

    public function __construct(TableLog $log=null)
    {
        if($log)
        {
            $this->table_id=$log->table_id;
            $this->datetime=$log->datetime;
            $this->text=$log->text;

        }
        return parent::__construct();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['table_id', 'text'], 'required'],
            [['table_id'], 'integer'],
            [['text'],'string'],
            [['datetime'], 'safe'],
            [['table_id'], 'exist', 'skipOnError' => true, 'targetClass' => Table::className(), 'targetAttribute' => ['table_id' => 'id']],
        ];
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
}
