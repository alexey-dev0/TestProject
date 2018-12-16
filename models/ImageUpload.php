<?php
/**
 * Created by PhpStorm.
 * User: AleksM
 * Date: 15.12.2018
 * Time: 23:31
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;


class ImageUpload extends Model
{
    public $image;

    public function upload(UploadedFile $file)
    {
        $file->saveAs(Yii::getAlias('@web') . 'img/' . $file->name);
        return $file->name;
    }
}