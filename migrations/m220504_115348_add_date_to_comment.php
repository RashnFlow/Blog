<?php

use yii\db\Migration;

/**
 * Class m220504_115348_add_date_to_comment
 */
class m220504_115348_add_date_to_comment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('comment', 'date', $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('comment', 'date');
    }
}
