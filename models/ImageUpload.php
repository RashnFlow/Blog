<?php


namespace app\models;

use yii\web\UploadedFile;
use Yii;

class ImageUpload extends \yii\base\Model
{

    public $image;

    public function uploadImage(UploadedFile $file, $currentImage)
    {
        $this->image = $file;

        unlink(Yii::getAlias('@webroot') . '/uploads/' . $currentImage);

        $fileName = strtolower(md5(uniqid($file->baseName)) . '.' . $file->extension);

        $file->saveAs(Yii::getAlias('@webroot') . '/uploads/' . $fileName);

        return $fileName;
    }

}