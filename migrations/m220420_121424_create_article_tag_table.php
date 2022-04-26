<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article_tag}}`.
 */
class m220420_121424_create_article_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article_tag}}', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer(),
            'tag_id' => $this->integer()
        ]);

        $this->createIndex (
            'tag-article-article_id',
            'article_tag',
            'article_id'
        );

        $this->addForeignKey(
            'fk-article-article_id',
            'article_tag',
            'article_id',
            'article',
            'id',
            'CASCADE'
        );

        $this->createIndex (
            'idx-tag_id',
            'article_tag',
            'tag_id'
        );

        $this->addForeignKey(
            'fk-tag_id',
            'article_tag',
            'tag_id',
            'tag',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'tag-article-article_id',
            'article_tag'
        );

        $this->dropForeignKey(
            'fk-article_id',
            'article_tag'
        );

        $this->dropIndex(
            'idx-tag_id',
            'article_tag'
        );

        $this->dropForeignKey(
            'fk-tag_id',
            'article_tag'
        );

        $this->dropTable('{{%article_tag}}');
    }
}
