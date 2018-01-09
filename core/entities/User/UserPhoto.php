<?php

namespace core\entities\User;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * @property integer $id
 * @property string $file
 * @property integer $sort
 *
 * @mixin ImageUploadBehavior
 */
class UserPhoto extends ActiveRecord
{
    public static function create(UploadedFile $file)
    {
        $photo = new static();
        $photo->file = $file;
        return $photo;
    }

    public function setSort($sort)
    {
        $this->sort = $sort;
    }

    public function isIdEqualTo($id)
    {
        return $this->id == $id;
    }

    public static function tableName()
    {
        return 'bnz_user_photos';
    }

    public function behaviors()
    {
        return [
            [
                'class' => ImageUploadBehavior::className(),
                'attribute' => 'file',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/users/[[attribute_user_id]]/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/users/[[attribute_user_id]]/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/users/[[attribute_user_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/users/[[attribute_user_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'thumb' => ['width' => 640, 'height' => 480],
                ],
            ],
        ];
    }
}