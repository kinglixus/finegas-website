<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissionModel extends Model
{
    protected $table = 'permissions';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [

        'name',

        'slug',

        'module',

        'description'
    ];

    protected $useTimestamps = true;

    public function groupedPermissions()
    {
        $permissions = $this->findAll();

        $grouped = [];

        foreach ($permissions as $permission) {

            $grouped[$permission['module']][] = $permission;
        }

        return $grouped;
    }
}
