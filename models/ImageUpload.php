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

        $this->deleteCurrentImage($currentImage);

        return $this->saveImage();
    }

    public function saveImage()
    {
        $fileName = $this->generateFilename();

        $this->image->saveAs($this->getFolder() . $fileName);

        return $fileName;
    }

    public function generateFilename()
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
    }

    private function deleteCurrentImage($currentImage)
    {
        if (!empty($currentImage) && file_exists($this->getFolder() . $currentImage))
            unlink($this->getFolder() . $currentImage);
    }

    public function getFolder()
    {
        return Yii::getAlias('@webroot') . '/uploads/';
    }

}