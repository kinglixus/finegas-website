<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table = 'activity_logs';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [

        'user_id',

        'user_name',

        'user_email',

        'action',

        'module',

        'record_id',

        'description',

        'ip_address',

        'user_agent',
        'created_at'
    ];

    protected $useTimestamps = false;
}
