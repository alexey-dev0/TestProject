<?php
/**
 * Created by PhpStorm.
 * User: AleksM
 * Date: 15.12.2018
 * Time: 16:46
 */

namespace app\models;

use yii\db\ActiveRecord;


class Article extends ActiveRecord
{
    public static function tableName()
    {
        return 'article';
    }
}