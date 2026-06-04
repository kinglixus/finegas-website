<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminUserModel;
use App\Models\ContactMessageModel;

use Config\Services;

class Home extends BaseController
{
    protected $adminUserModel;
    protected $contactMessageModel;

    public function __construct()
    {
        $this->adminUserModel = new AdminUserModel();
        $this->contactMessageModel = new ContactMessageModel();
    }


    public function index()
    {
        /*
    |--------------------------------------------------------------------------
    | ADMIN USER
    |--------------------------------------------------------------------------
    */

        $admin =
            admin_user();

        /*
    |--------------------------------------------------------------------------
    | USER STATISTICS
    |--------------------------------------------------------------------------
    */

        $totalUsers =
            $this->adminUserModel
            ->countAll();

        $activeUsers =
            $this->adminUserModel

            ->where(
                'status',
                'active'
            )

            ->countAllResults();

        $inactiveUsers =
            $this->adminUserModel

            ->where(
                'status',
                'inactive'
            )

            ->countAllResults();


        /*
        |--------------------------------------------------------------------------
        | CONTACT MESSAGE STATISTICS
        |--------------------------------------------------------------------------
        */

        $unreadMessages =
            $this->contactMessageModel
            ->where('is_read', 0)
            ->countAllResults();

        $totalMessages =
            $this->contactMessageModel
            ->countAll();

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD DATA
        |--------------------------------------------------------------------------
        */

        $data = [

            'title' =>

            'Dashboard',

            'admin_user' =>

            $admin,

            'totalUsers' =>

            $totalUsers,

            'activeUsers' =>

            $activeUsers,

            'inactiveUsers' =>

            $inactiveUsers,
            'totalMessages' =>
            $totalMessages,

            'unreadMessages' =>
            $unreadMessages
        ];

        /*
    |--------------------------------------------------------------------------
    | LOAD VIEW
    |--------------------------------------------------------------------------
    */

        return view(
            'admin/home/index',
            $data
        );
    }




    public function profile()
    {
        $admin = admin_user();

        if ($this->request->getMethod() === 'POST') {
            $name = $this->request->getPost('name');
            $currentPassword = $this->request->getPost('current_password');
            $newPassword = $this->request->getPost('new_password');

            $updateData = ['name' => $name];

            if (!empty($newPassword)) {
                if (empty($currentPassword)) {
                    return redirect()->to('admin/profile')->with('error', 'Current password is required');
                }

                $user = $this->adminUserModel->find($admin['id']);
                if (!password_verify($currentPassword, $user['password'])) {
                    return redirect()->to('admin/profile')->with('error', 'Current password is incorrect');
                }

                $updateData['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
            }

            $this->adminUserModel->update($admin['id'], $updateData);

            // Update session
            $session = Services::session();
            $session->set('admin_name', $name);

            return redirect()->to('admin/profile')->with('success', 'Profile updated successfully');
        }

        return view('admin/home/profile', [
            'title' => 'Profile',
            'admin_user' => $admin
        ]);
    }

    public function settings()
    {
        if ($this->request->getMethod() === 'POST') {
            return redirect()->to('admin/settings')->with('success', 'Settings updated');
        }

        return view('admin/home/settings', [
            'title' => 'Settings'
        ]);
    }
}
