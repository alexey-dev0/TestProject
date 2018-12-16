<?php
/**
 * Created by PhpStorm.
 * User: AleksM
 * Date: 15.12.2018
 * Time: 23:24
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class ProfileForm extends Model
{
    public $first_name;
    public $second_name;
    public $photo;

    public function rules()
    {
        return [
            ['first_name', 'trim'],
            ['first_name', 'required'],
            ['first_name', 'string', 'min' => 3, 'max' => 20],
            ['second_name', 'trim'],
            ['second_name', 'required'],
            ['second_name', 'string', 'min' => 3, 'max' => 20],
            ['photo', 'required'],
            ['photo', 'file', 'extensions' => ['jpg', 'gif', 'png']],
        ];
    }

    public function profile($profile)
    {
        $profile->first_name = $this->first_name;
        $profile->second_name = $this->second_name;

        $currentImage = Yii::getAlias('@webroot') . '/img/' . $profile->photo;
        if (file_exists($currentImage))
        {
            unlink($currentImage);
        }
        $file = UploadedFile::getInstance($this, 'photo');
        $filename = strtolower(md5(uniqid($file->baseName)) . '.' . $file->extension);
        $file->saveAs(Yii::getAlias('@webroot') . '/img/' . $filename);

        $profile->photo = $filename;
        return $profile->update() ? $profile : null;
    }
}