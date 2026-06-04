<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddVerificationFieldsToAdminUsers extends Migration
{
    public function up()
    {
        $fields = [
            'email_verified' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'after'      => 'status'
            ],

            'email_verification_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 6,
                'null'       => true,
                'after'      => 'email_verified'
            ],

            'email_verification_expires' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'email_verification_code'
            ],

            'login_verification_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 6,
                'null'       => true,
                'after'      => 'email_verification_expires'
            ],

            'login_verification_expires' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'login_verification_code'
            ],

            'is_first_login' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
                'after'      => 'login_verification_expires'
            ],
        ];

        $this->forge->addColumn('admin_users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('admin_users', [
            'email_verified',
            'email_verification_code',
            'email_verification_expires',
            'login_verification_code',
            'login_verification_expires',
            'is_first_login'
        ]);
    }
}
