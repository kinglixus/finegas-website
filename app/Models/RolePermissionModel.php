<?php

namespace App\Models;

use CodeIgniter\Model;

class RolePermissionModel extends Model
{
    protected $table = 'role_permissions';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [

        'role_id',

        'permission_id',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;

    /*
    |--------------------------------------------------------------------------
    | GET ROLE PERMISSIONS
    |--------------------------------------------------------------------------
    */

    public function getRolePermissions(
        int $roleId
    ): array {
        $rows = $this->where(
            'role_id',
            $roleId
        )->findAll();

        return array_column(
            $rows,
            'permission_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SYNC ROLE PERMISSIONS
    |--------------------------------------------------------------------------
    */

    public function syncPermissions(
        int $roleId,
        array $permissions
    ) {
        /*
        |--------------------------------------------------------------------------
        | DELETE OLD
        |--------------------------------------------------------------------------
        */

        $this->where(
            'role_id',
            $roleId
        )->delete();

        /*
        |--------------------------------------------------------------------------
        | INSERT NEW
        |--------------------------------------------------------------------------
        */

        foreach ($permissions as $permissionId) {

            $this->insert([

                'role_id' => $roleId,

                'permission_id' => $permissionId
            ]);
        }
    }
}
