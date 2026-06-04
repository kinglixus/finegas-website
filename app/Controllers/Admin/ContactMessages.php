<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContactMessageModel;

use CodeIgniter\HTTP\ResponseInterface;

class ContactMessages extends BaseController
{
    protected $contactMessageModel;

    public function __construct()
    {
        $this->contactMessageModel = new ContactMessageModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Contact Messages',
            'messages' => $this->contactMessageModel->getAllMessages(),
        ];

        return view(
            'admin/contact_messages/index',
            $data
        );
    }

    public function view($id)
    {
        $messageModel =
            new ContactMessageModel();

        $message =
            $messageModel->find($id);

        if (!$message) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Message not found.'
                );
        }

        $messageModel->markAsRead($id);

        return view(
            'admin/contact_messages/view',
            [
                'title'   => 'View Message',
                'message' => $message
            ]
        );
    }

    public function markRead($id)
    {
        $this->contactMessageModel
            ->markAsRead($id);

        return redirect()
            ->back()
            ->with(
                'success',
                'Message marked as read.'
            );
    }


    public function markUnread($id)
    {
        $this->contactMessageModel
            ->markAsUnread($id);

        return redirect()
            ->back()
            ->with(
                'success',
                'Message marked as unread.'
            );
    }

    public function delete($id)
    {
        $this->contactMessageModel
            ->delete($id);

        return redirect()
            ->back()
            ->with(
                'success',
                'Message deleted successfully.'
            );
    }
}
