<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLoginSecurityToAdminUsers extends Migration
{
    public function up()
    {
        $fields = [

            'login_attempts' => [

                'type'       => 'INT',

                'constraint' => 11,

                'default'    => 0,

                'after'      => 'last_ip'
            ],

            'locked_until' => [

                'type' => 'DATETIME',

                'null' => true,

                'after' => 'login_attempts'
            ]
        ];

        $this->forge->addColumn(
            'admin_users',
            $fields
        );
    }

    public function down()
    {
        $this->forge->dropColumn(
            'admin_users',
            [
                'login_attempts',
                'locked_until'
            ]
        );
    }
}
