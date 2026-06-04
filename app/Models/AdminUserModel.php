<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminUserModel extends Model
{
    protected $table            = 'admin_users';

    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;

    protected $returnType       = 'array';

    protected $useSoftDeletes   = false;

    protected $useTimestamps    = true;

    protected $createdField     = 'created_at';

    protected $updatedField     = 'updated_at';

    protected $allowedFields = [

        'email',

        'password',

        'first_name',

        'last_name',

        'role_id',

        'permissions',

        'avatar',

        'phone',

        'status',

        'email_verified',

        'email_verification_code',

        'email_verification_expires',

        'login_verification_code',

        'login_verification_expires',

        'is_first_login',

        'two_factor_enabled',

        'two_factor_secret',

        'reset_token',

        'reset_expired',

        'last_login',

        'last_ip',
        'login_attempts',

        'locked_until',

        'verification_attempts',

        'verification_locked_until',
        'temp_password_expires',
        'must_change_password',

        'created_at',

        'updated_at',

        'deleted_at'
    ];

    /*
    |--------------------------------------------------------------------------
    | VERIFY PASSWORD
    |--------------------------------------------------------------------------
    */

    public function verifyPassword($email, $password)
    {
        $user = $this->where('email', $email)->first();

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        return $user;
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE LAST LOGIN
    |--------------------------------------------------------------------------
    */

    public function updateLastLogin($userId)
    {
        return $this->update($userId, [

            'last_login' => date('Y-m-d H:i:s'),

            'last_ip' => service('request')->getIPAddress()

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | ACTIVE USERS
    |--------------------------------------------------------------------------
    */

    public function getActiveUsers()
    {
        return $this->where('status', 'active')
            ->findAll();
    }

    /*
    |--------------------------------------------------------------------------
    | SEARCH USERS
    |--------------------------------------------------------------------------
    */

    public function search($keyword)
    {
        return $this->groupStart()

            ->like('email', $keyword)

            ->orLike('first_name', $keyword)

            ->orLike('last_name', $keyword)

            ->groupEnd()

            ->findAll();
    }

    /*
    |--------------------------------------------------------------------------
    | FIND USER
    |--------------------------------------------------------------------------
    */

    public function findWithRole_id($id)
    {
        return $this->find($id);
    }

    /*
    |--------------------------------------------------------------------------
    | FULL NAME
    |--------------------------------------------------------------------------
    */

    public function getFullName(array $user): string
    {
        return trim(

            ($user['first_name'] ?? '') . ' ' .

                ($user['last_name'] ?? '')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | GENERATE VERIFICATION CODE
    |--------------------------------------------------------------------------
    */

    public function generateVerificationCode($length = 6)
    {
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';

        $code = '';

        for ($i = 0; $i < $length; $i++) {

            $code .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $code;
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE EMAIL VERIFICATION
    |--------------------------------------------------------------------------
    */

    public function createEmailVerification($userId)
    {
        $code = $this->generateVerificationCode();

        $this->update($userId, [

            'email_verification_code' => $code,

            'email_verification_expires' => date(
                'Y-m-d H:i:s',
                strtotime('+5 minutes')
            )
        ]);

        return $code;
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE LOGIN VERIFICATION
    |--------------------------------------------------------------------------
    */

    public function createLoginVerification($userId)
    {
        $code = $this->generateVerificationCode();

        $this->update($userId, [

            'login_verification_code' => $code,

            'login_verification_expires' => date(
                'Y-m-d H:i:s',
                strtotime('+5 minutes')
            )
        ]);

        return $code;
    }

    /*
    |--------------------------------------------------------------------------
    | VERIFY EMAIL CODE
    |--------------------------------------------------------------------------
    */

    public function verifyEmailCode($userId, $code)
    {
        $user = $this->find($userId);

        if (!$user) {
            return false;
        }

        if (
            empty($user['email_verification_code']) ||

            strtoupper($user['email_verification_code']) !== strtoupper($code)
        ) {
            return false;
        }

        if (
            empty($user['email_verification_expires']) ||

            strtotime($user['email_verification_expires']) < time()
        ) {
            return false;
        }

        $this->update($userId, [

            'email_verified' => 1,

            'is_first_login' => 0,

            'email_verification_code' => null,

            'email_verification_expires' => null
        ]);

        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | VERIFY LOGIN CODE
    |--------------------------------------------------------------------------
    */

    public function verifyLoginCode($userId, $code)
    {
        $user = $this->find($userId);

        if (!$user) {
            return false;
        }

        if (
            empty($user['login_verification_code']) ||

            strtoupper($user['login_verification_code']) !== strtoupper($code)
        ) {
            return false;
        }

        if (
            empty($user['login_verification_expires']) ||

            strtotime($user['login_verification_expires']) < time()
        ) {
            return false;
        }

        $this->update($userId, [

            'login_verification_code' => null,

            'login_verification_expires' => null
        ]);

        return true;
    }

    public function incrementLoginAttempts($userId)
    {
        $user = $this->find($userId);

        if (!$user) {
            return;
        }

        $attempts = (int) $user['login_attempts'] + 1;

        $data = [

            'login_attempts' => $attempts
        ];

        /*
        |--------------------------------------------------------------------------
        | LOCK ACCOUNT
        |--------------------------------------------------------------------------
        */

        if ($attempts >= 5) {

            $data['locked_until'] = date(
                'Y-m-d H:i:s',
                strtotime('+15 minutes')
            );
        }

        $this->update($userId, $data);
    }

    public function resetLoginAttempts($userId)
    {
        $this->update($userId, [

            'login_attempts' => 0,

            'locked_until' => null
        ]);
    }

    public function isLocked(array $user): bool
    {
        if (empty($user['locked_until'])) {

            return false;
        }

        return strtotime($user['locked_until']) > time();
    }

    public function incrementVerificationAttempts($userId)
    {
        $user = $this->find($userId);

        if (!$user) {
            return;
        }

        $attempts =
            (int) $user['verification_attempts'] + 1;

        $data = [

            'verification_attempts' => $attempts
        ];

        /*
        |--------------------------------------------------------------------------
        | LOCK VERIFICATION
        |--------------------------------------------------------------------------
        */

        if ($attempts >= 5) {

            $data['verification_locked_until'] = date(
                'Y-m-d H:i:s',
                strtotime('+5 minutes')
            );
        }

        $this->update($userId, $data);
    }


    public function resetVerificationAttempts($userId)
    {
        $this->update($userId, [

            'verification_attempts' => 0,

            'verification_locked_until' => null
        ]);
    }


    public function isVerificationLocked(array $user): bool
    {
        if (
            empty($user['verification_locked_until'])
        ) {

            return false;
        }

        return strtotime(
            $user['verification_locked_until']
        ) > time();
    }

    public function getUserPermissions(
        int $userId
    ): array {
        $builder = $this->db->table(
            'role_permissions rp'
        );

        $builder->select(
            'permissions.slug'
        );

        $builder->join(
            'permissions',
            'permissions.id = rp.permission_id'
        );

        $builder->join(
            'admin_users',
            'admin_users.role_id = rp.role_id'
        );

        $builder->where(
            'admin_users.id',
            $userId
        );

        $results = $builder->get()->getResultArray();

        return array_column(
            $results,
            'slug'
        );
    }
}
