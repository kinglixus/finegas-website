<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAboutSectionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'section_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'section_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => 'section',
            ],

            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],

            'subtitle' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],

            'description' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],

            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],

            'icon' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],

            'button_text' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],

            'button_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],

            'extra_data' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],

            'sort_order' => [
                'type'    => 'INT',
                'default' => 0,
            ],

            'status' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('section_name');
        $this->forge->addKey('section_type');
        $this->forge->addKey('status');

        $this->forge->createTable('about_pages');
    }

    public function down()
    {
        $this->forge->dropTable('about_pages', true);
    }
}
