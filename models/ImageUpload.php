<?php


namespace app\models;

use yii\web\UploadedFile;
use Yii;

class ImageUpload extends \yii\base\Model
{
    public $image;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'png,jpg']
        ];
    }

    public function uploadImage(UploadedFile $file, $currentImage)
    {
        $this->image = $file;

        if (file_exists(Yii::getAlias('@webroot') . '/uploads/' . $currentImage))
            unlink(Yii::getAlias('@webroot') . '/uploads/' . $currentImage);

        $fileName = strtolower(md5(uniqid($file->baseName)) . '.' . $file->extension);

        $file->saveAs(Yii::getAlias('@webroot') . '/uploads/' . $fileName);

        return $fileName;
    }

}