<?php

namespace app\models;

use Yii;
use yii\base\BaseObject;
use yii\data\Pagination;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string|null $title
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    public static function getArticlesByCategory($id)
    {
        $query = Article::find()->where(['category_id' => $id]);
        $countQuery = clone $query;
        $pagination = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return ['articles' => $articles, 'pagination' => $pagination];
    }

    public function getArticlesCount()
    {
        return $this->getArticles()->count();
    }

    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['category_id' => 'id']);
    }
}
