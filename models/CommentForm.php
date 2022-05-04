<?php


namespace app\models;


class CommentForm extends \yii\base\Model
{
    public $comment;

    public function rules()
    {
        return [
            [['comment'], 'unique'],
            [['comment'], 'string', 'length' => [3,250]]
        ];
    }

    public function saveComment($article_id)
    {
        $comment = new Comment();
        $comment->text = $this->comment;
        $comment->user_id = \Yii::$app->user->id;
        $comment->article_id = $article_id;
        $comment->status = 0;
        return $comment->save();
    }
}