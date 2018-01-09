<?php

namespace core\forms\infrastructure;

use core\entities\infrastructure\GameCondition;
use core\forms\CompositeForm;
use core\helpers\GameHelper;
use core\repositories\infrastructure\GameConditionRepository;
use Yii;
use core\entities\infrastructure\Table;
use core\entities\User\User;
use core\helpers\UserHelper;
use core\forms\infrastructure\AllGameConditionsForm;
/**
 * This is the model class for table "bnz_table".
 *
 * @property integer $id
 * @property string $datetime_start
 * @property string $datetime_end
 * @property integer $game_name
 * @property integer $min_balance
 * @property integer $started
 * @property integer $closed
 * @property integer $owner_id
 * @property integer $bet
 * @property integer $turn_time
 * @property integer $max_player_number
 * @property string $additional_conditions
 * @property integer $winner_id
 * @property integer $bank
 *
 * @property User $winner
 * @property User $owner
 * @property TableConnection[] $TableConnections
 * @property TableLog[] $TableLogs
 */
class TableForm extends CompositeForm
{
    public $datetime_start;
    public $datetime_end;
    public $game_name;
    public $started;
    public $closed;
    public $owner_id;
    public $winner_id;
    public $bank;

    /**
     * @inheritdoc
    */

public function __construct(string $game_name,Table $table=null)
{
    GameHelper::checkGameName($game_name);
    $this->game_name=$game_name;
    if($table)
    {
        $this->datetime_start=$table->datetime_start;
        $this->datetime_end=$table->datetime_end;
        $this->started=$table->started;
        $this->closed=$table->closed;
        $this->owner_id=$table->owner_id;
        $this->winner_id=$table->winner_id;
        $this->bank=$table->bank;
    }

    $this->values = array_map(function (GameCondition $characteristic) {
        return new ConditionValueForm($characteristic);
    }, $this->prepareConditions());

    return parent::__construct();
}

    public function rules()
    {
        return [
            [['datetime_start', 'datetime_end'], 'safe'],
            [['game_name', 'datetime_start','owner_id'], 'required'],
            [['game_name', 'started', 'closed', 'owner_id', 'winner_id','bank'], 'integer'],
            [['winner_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['winner_id' => 'id']],
            [['owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['owner_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'datetime_start' => 'Datetime Start',
            'datetime_end' => 'Datetime End',
            'game_name' => 'Game Type',
            'started' => 'Started',
            'closed' => 'Closed',
            'owner_id' => 'Owner ID',
            'winner_id' => 'Winner ID',
            'bank'=>'Current Bank'
        ];
    }

    public function prepareUsers()
    {
        return UserHelper::prepareBothNamesList();
    }

    public function prepareConditions()
    {
        return Yii::$container->get(GameConditionRepository::class)->getByGameName($this->game_name);
    }
    public function internalForms()
    {
        return ['values'];
    }
}
