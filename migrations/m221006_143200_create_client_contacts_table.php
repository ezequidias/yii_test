<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client_contacts}}`.
 */
class m221006_143200_create_client_contacts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%client_contacts}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),
            'country_code' => $this->string()->notNull(),
            'number' => $this->integer()->notNull(),
            'is_deleted' => $this->boolean()->defaultValue(0),
            'deleted_at' => $this->dateTime(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

         // creates index for column `author_id`
        $this->createIndex(
            'idx-client_contacts-client_id',
            'client_contacts',
            'client_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-client_contacts-client_id',
            'client_contacts',
            'client_id',
            'clients',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%client_contacts}}');
    }
}
