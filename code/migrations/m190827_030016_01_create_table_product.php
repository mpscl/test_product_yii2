<?php

use yii\db\Migration;

class m190827_030016_01_create_table_product extends Migration
{
    public function up()
    {


        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey()->unsigned(),
            'part_number' => $this->string()->notNull(),
            'type_id' => $this->integer()->unsigned()->notNull(),
            'display_image' => $this->string(),
            'reference_id' => $this->integer()->unsigned()->notNull(),
            'description' => $this->string(),
            'slug' => $this->string()->notNull(),
        ]);

        $this->createTable('{{%ad}}', [
            'id' => $this->primaryKey()->unsigned(),
            'part_number' => $this->string()->notNull(),
            'type_id' => $this->integer()->unsigned()->notNull(),
            'display_image' => $this->string(),
            'quantity' => $this->integer(),
            'seller' => $this->string(),
            'condition' => $this->string(),
            'price' => $this->integer(),
            'slug' => $this->string()->notNull(),
        ]);

        $this->createTable('{{%reference}}', [
            'id' => $this->primaryKey()->unsigned(),
            'reference' => $this->string()->notNull(),
        ]);        

        $this->createTable('{{%type}}', [
            'id' => $this->primaryKey()->unsigned(),
            'type' => $this->string()->notNull(),
        ]);

        $this->createTable('{{%ad_type}}', [
            'id' => $this->primaryKey()->unsigned(),
            'type' => $this->string()->notNull(),
        ]);

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey()->unsigned(),
            'category' => $this->string()->notNull(),
        ]);

        $this->createTable('{{%manufacturer}}', [
            'id' => $this->primaryKey()->unsigned(),
            'manufacturer' => $this->string()->notNull(),
        ]);

        
        $this->batchInsert('{{%reference}}', ['id', 'reference'], [
            [1, 'Aliases'],
            [2, 'Model Number'],
            [3, 'Configuration Number'],
            [4, 'Build Number'],
             
        ]);
        

        $this->batchInsert('{{%type}}', ['id', 'type'], [
            [1, 'Orderable'],
            [2, 'Non-orderable'],
        ]);

        $this->batchInsert('{{%ad_type}}', ['id', 'type'], [
            [1, 'Sell'],
            [2, 'Buy'],
        ]);

        $this->batchInsert('{{%category}}', ['id', 'category'], [
            [1, 'Category 1'],
            [2, 'Category 2'],
        ]);

        $this->batchInsert('{{%manufacturer}}', ['id', 'manufacturer'], [
            [1, 'Man 1'],
            [2, 'Man 2'],
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%product}}');        
        $this->dropTable('{{%reference}}');
        $this->dropTable('{{%ad}}');
        $this->dropTable('{{%category}}');
        $this->dropTable('{{%type}}');
        $this->dropTable('{{%manufacturer}}');

    }
}
