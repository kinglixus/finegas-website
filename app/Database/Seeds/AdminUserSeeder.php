<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        /*
        |--------------------------------------------------------------------------
        | CLEAR EXISTING USERS (OPTIONAL)
        |--------------------------------------------------------------------------
        */

        // Uncomment during testing if needed
        // $this->db->table('admin_users')->truncate();

        $users = [

            /*
            |--------------------------------------------------------------------------
            | SUPER ADMIN
            |--------------------------------------------------------------------------
            */

            [

                'email' => 'admin@finegas.com',

                'password' => password_hash(
                    'Admin@123',
                    PASSWORD_DEFAULT
                ),

                'first_name' => 'Super',

                'last_name' => 'Admin',

                'role_id' => 1,

                'permissions' => json_encode([
                    'all'
                ]),

                'avatar' => null,

                'phone' => '0240000001',

                'status' => 'active',

                'email_verified' => 1,

                'email_verification_code' => null,

                'email_verification_expires' => null,

                'login_verification_code' => null,

                'login_verification_expires' => null,

                'is_first_login' => 0,

                'two_factor_enabled' => 0,

                'two_factor_secret' => null,

                'reset_token' => null,

                'reset_expired' => null,

                'last_login' => null,

                'last_ip' => null,

                'created_at' => date('Y-m-d H:i:s'),

                'updated_at' => date('Y-m-d H:i:s'),
            ],

            /*
            |--------------------------------------------------------------------------
            | MANAGER
            |--------------------------------------------------------------------------
            */

            [

                'email' => 'manager@finegas.com',

                'password' => password_hash(
                    'Manager@123',
                    PASSWORD_DEFAULT
                ),

                'first_name' => 'Operations',

                'last_name' => 'Manager',

                'role_id' => 3,

                'permissions' => json_encode([

                    'dashboard',

                    'customers',

                    'products',

                    'reports'
                ]),

                'avatar' => null,

                'phone' => '0240000002',

                'status' => 'active',

                'email_verified' => 1,

                'email_verification_code' => null,

                'email_verification_expires' => null,

                'login_verification_code' => null,

                'login_verification_expires' => null,

                'is_first_login' => 0,

                'two_factor_enabled' => 0,

                'two_factor_secret' => null,

                'reset_token' => null,

                'reset_expired' => null,

                'last_login' => null,

                'last_ip' => null,

                'created_at' => date('Y-m-d H:i:s'),

                'updated_at' => date('Y-m-d H:i:s'),
            ],

            /*
            |--------------------------------------------------------------------------
            | STAFF USER
            |--------------------------------------------------------------------------
            */

            [

                'email' => 'staff@finegas.com',

                'password' => password_hash(
                    'Staff@123',
                    PASSWORD_DEFAULT
                ),

                'first_name' => 'Staff',

                'last_name' => 'User',

                'role_id' => 2,

                'permissions' => json_encode([

                    'dashboard',

                    'customers'
                ]),

                'avatar' => null,

                'phone' => '0240000003',

                'status' => 'active',

                'email_verified' => 1,

                'email_verification_code' => null,

                'email_verification_expires' => null,

                'login_verification_code' => null,

                'login_verification_expires' => null,

                'is_first_login' => 0,

                'two_factor_enabled' => 0,

                'two_factor_secret' => null,

                'reset_token' => null,

                'reset_expired' => null,

                'last_login' => null,

                'last_ip' => null,

                'created_at' => date('Y-m-d H:i:s'),

                'updated_at' => date('Y-m-d H:i:s'),
            ],

            /*
            |--------------------------------------------------------------------------
            | FIRST TIME USER
            |--------------------------------------------------------------------------
            */

            [

                'email' => 'newuser@finegas.com',

                'password' => password_hash(
                    'NewUser@123',
                    PASSWORD_DEFAULT
                ),

                'first_name' => 'New',

                'last_name' => 'User',

                'role_id' => 2,

                'permissions' => json_encode([]),

                'avatar' => null,

                'phone' => '0240000004',

                'status' => 'active',

                'email_verified' => 0,

                'email_verification_code' => null,

                'email_verification_expires' => null,

                'login_verification_code' => null,

                'login_verification_expires' => null,

                'is_first_login' => 1,

                'two_factor_enabled' => 0,

                'two_factor_secret' => null,

                'reset_token' => null,

                'reset_expired' => null,

                'last_login' => null,

                'last_ip' => null,

                'created_at' => date('Y-m-d H:i:s'),

                'updated_at' => date('Y-m-d H:i:s'),
            ],

            /*
            |--------------------------------------------------------------------------
            | INACTIVE USER
            |--------------------------------------------------------------------------
            */

            [

                'email' => 'inactive@finegas.com',

                'password' => password_hash(
                    'Inactive@123',
                    PASSWORD_DEFAULT
                ),

                'first_name' => 'Inactive',

                'last_name' => 'User',

                'role_id' => 2,

                'permissions' => json_encode([]),

                'avatar' => null,

                'phone' => '0240000005',

                'status' => 'inactive',

                'email_verified' => 1,

                'email_verification_code' => null,

                'email_verification_expires' => null,

                'login_verification_code' => null,

                'login_verification_expires' => null,

                'is_first_login' => 0,

                'two_factor_enabled' => 0,

                'two_factor_secret' => null,

                'reset_token' => null,

                'reset_expired' => null,

                'last_login' => null,

                'last_ip' => null,

                'created_at' => date('Y-m-d H:i:s'),

                'updated_at' => date('Y-m-d H:i:s'),
            ]

        ];

        $this->db
            ->table('admin_users')
            ->insertBatch($users);

        echo "Admin users seeded successfully.\n";
    }
}
