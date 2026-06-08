<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSafetySectionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'section_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'section_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'section',
                'comment'    => 'section or item',
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
                'type' => 'TEXT',
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
                'type' => 'TEXT',
                'null' => true,
                'comment' => 'JSON data for breadcrumbs, emergency numbers, colors, etc.',
            ],

            'sort_order' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
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

            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('section_name');
        $this->forge->addKey('section_type');
        $this->forge->addKey('status');
        $this->forge->createTable('safety_sections');
    }

    public function down()
    {
        $this->forge->dropTable('safety_pages');
    }
}
