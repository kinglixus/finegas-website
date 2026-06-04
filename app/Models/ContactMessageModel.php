<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactMessageModel extends Model
{
    protected $table            = 'contact_messages';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useTimestamps    = true;

    protected $allowedFields = [
        'name',
        'email',
        'location',
        'subject',
        'message',
        'ip_address',
        'user_agent',
        'status',
        'is_read',
    ];


    public function getUnreadCount()
    {
        return $this->where('is_read', 0)->countAllResults();
    }

    public function getAllMessages()
    {
        return $this->orderBy('created_at', 'DESC')
            ->findAll();
    }

    public function markAsRead($id)
    {
        return $this->update($id, [
            'is_read' => 1
        ]);
    }

    public function markAsUnread($id)
    {
        return $this->update($id, [
            'is_read' => 0
        ]);
    }
}
