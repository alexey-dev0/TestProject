<?php
/**
 * Created by PhpStorm.
 * User: AleksM
 * Date: 15.12.2018
 * Time: 17:37
 */

namespace app\models;

use yii\db\ActiveRecord;


class Profile extends ActiveRecord
{
    public static function tableName()
    {
        return 'profile';
    }
}