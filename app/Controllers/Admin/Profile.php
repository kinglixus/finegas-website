<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminUserModel;


class Profile extends BaseController
{

    protected $adminUserModel;
    protected $roleModel;

    public function __construct()
    {
        $this->adminUserModel =
            new AdminUserModel();
    }




    /*|-------------------------------------------------------------------------
     | ACCOUNT SETTINGS
     |--------------------------------------------------------------------------
     |
     | This method allows admin users to update their account settings, such as
     | changing their password. It includes validation, security checks, and
     | activity logging.
     |
     */
    public function accountSettings()
    {
        /*
        |--------------------------------------------------------------------------
        | CHECK LOGIN
        |--------------------------------------------------------------------------
        */

        if (
            !session('is_admin_logged_in')
        ) {

            return redirect()
                ->to(
                    base_url('admin')
                );
        }

        /*
        |--------------------------------------------------------------------------
        | GET USER
        |--------------------------------------------------------------------------
        */

        $userId =
            session('admin_id');

        $user =
            $this->adminUserModel
            ->find($userId);

        if (!$user) {

            session()->destroy();

            return redirect()
                ->to(
                    base_url('admin')
                );
        }

        /*
        |--------------------------------------------------------------------------
        | LOAD PAGE
        |--------------------------------------------------------------------------
        */

        if (
            strtolower(
                $this->request
                    ->getMethod()
            ) === 'get'
        ) {

            return view(
                'admin/profile/account_settings',
                [

                    'title' =>

                    'Account Settings',

                    'user' => $user
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | AJAX ONLY
        |--------------------------------------------------------------------------
        */

        if (
            !$this->request
                ->isAJAX()
        ) {

            return $this->response
                ->setJSON([

                    'status' => false,

                    'message' =>
                    'Invalid request'
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $rules = [

            'current_password' =>

            'required',

            'password' =>

            'required|min_length[8]',

            'confirm_password' =>

            'required|matches[password]'
        ];

        if (
            !$this->validate($rules)
        ) {

            return $this->response
                ->setJSON([

                    'status' => false,

                    'errors' =>

                    $this->validator
                        ->getErrors()
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | INPUTS
        |--------------------------------------------------------------------------
        */

        $currentPassword =
            $this->request
            ->getPost(
                'current_password'
            );

        $newPassword =
            $this->request
            ->getPost(
                'password'
            );

        /*
        |--------------------------------------------------------------------------
        | VERIFY CURRENT PASSWORD
        |--------------------------------------------------------------------------
        */

        if (
            !password_verify(

                $currentPassword,

                $user['password']
            )
        ) {

            return $this->response
                ->setJSON([

                    'status' => false,

                    'errors' => [

                        'current_password' =>

                        'Current password is incorrect'
                    ]
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | PREVENT SAME PASSWORD REUSE
        |--------------------------------------------------------------------------
        */

        if (
            password_verify(

                $newPassword,

                $user['password']
            )
        ) {

            return $this->response
                ->setJSON([

                    'status' => false,

                    'errors' => [

                        'password' =>

                        'New password cannot be the same as current password'
                    ]
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE PASSWORD
        |--------------------------------------------------------------------------
        */

        $this->adminUserModel
            ->update($userId, [

                'password' =>

                password_hash(

                    $newPassword,

                    PASSWORD_DEFAULT
                )
            ]);

        /*
        |--------------------------------------------------------------------------
        | ACTIVITY LOG
        |--------------------------------------------------------------------------
        */

        activity_log(

            'PASSWORD_CHANGED',

            'AUTH',

            $userId,

            'Account password changed'
        );

        /*
        |--------------------------------------------------------------------------
        | SEND PASSWORD CHANGE EMAIL
        |--------------------------------------------------------------------------
        */

        $email =
            \Config\Services::email();

        $email->setTo(
            $user['email']
        );

        $email->setSubject(
            'Password Changed Successfully'
        );

        $email->setMessage(

            view(
                'admin/emails/password_changed',
                [

                    'user' => $user,

                    'ip_address' =>

                    $this->request
                        ->getIPAddress(),

                    'changed_at' =>

                    date(
                        'Y-m-d H:i:s'
                    )
                ]
            )
        );

        $email->send();

        /*
        |--------------------------------------------------------------------------
        | DESTROY SESSION
        |--------------------------------------------------------------------------
        */

        session()->destroy();

        /*
        |--------------------------------------------------------------------------
        | RESPONSE
        |--------------------------------------------------------------------------
        */

        return $this->response
            ->setJSON([

                'status' => true,

                'message' =>

                'Password updated successfully. Please login again.',

                'redirect' =>

                base_url('admin')
            ]);
    }
}
