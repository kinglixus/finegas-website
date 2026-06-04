<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLocationToContactMessagesTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('contact_messages', [
            'location' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'email',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('contact_messages', 'location');
    }
}
