<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddVerificationSecurityToAdminUsers extends Migration
{
    public function up()
    {
        $fields = [

            'verification_attempts' => [

                'type'       => 'INT',

                'constraint' => 11,

                'default'    => 0,

                'after'      => 'locked_until'
            ],

            'verification_locked_until' => [

                'type' => 'DATETIME',

                'null' => true,

                'after' => 'verification_attempts'
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
                'verification_attempts',
                'verification_locked_until'
            ]
        );
    }
}
