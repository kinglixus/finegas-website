<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminUserModel;
use App\Models\RoleModel;

class Users extends BaseController
{
    protected $adminUserModel;

    protected $roleModel;

    public function __construct()
    {
        $this->adminUserModel =
            new AdminUserModel();

        $this->roleModel =
            new RoleModel();
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $keyword =
            $this->request
            ->getGet('keyword');

        $builder =
            $this->adminUserModel

            ->select(
                'admin_users.*, roles.name as role_name'
            )

            ->join(
                'roles',
                'roles.id = admin_users.role_id',
                'left'
            );

        if ($keyword) {

            $builder->groupStart()

                ->like(
                    'admin_users.first_name',
                    $keyword
                )

                ->orLike(
                    'admin_users.last_name',
                    $keyword
                )

                ->orLike(
                    'admin_users.email',
                    $keyword
                )

                ->orLike(
                    'admin_users.phone',
                    $keyword
                )

                ->groupEnd();
        }

        $users =
            $builder

            ->orderBy(
                'admin_users.id',
                'DESC'
            )

            ->find();

        return view(
            'admin/users/index',
            [

                'title' => 'Users',

                'users' => $users,

                'roles' =>
                $this->roleModel
                    ->findAll(),

                'keyword' => $keyword
            ]
        );
    }

    /*
|--------------------------------------------------------------------------
| CREATE USER
|--------------------------------------------------------------------------
*/

    public function create()
    {
        /*
    |--------------------------------------------------------------------------
    | SHOW CREATE PAGE
    |--------------------------------------------------------------------------
    */

        if (
            $this->request->getMethod() === 'GET'
        ) {

            return view(
                'admin/users/create',
                [

                    'title' => 'Create User',

                    'roles' =>
                    $this->roleModel
                        ->findAll()
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
    | VALIDATION RULES
    |--------------------------------------------------------------------------
    */

        $rules = [

            'first_name' =>

            'required|min_length[2]|max_length[100]',

            'last_name' =>

            'required|min_length[2]|max_length[100]',

            'email' =>

            'required|valid_email|is_unique[admin_users.email]',

            'phone' =>

            'permit_empty|min_length[10]|max_length[20]',

            'password' =>

            'required|min_length[6]',

            'confirm_password' =>

            'required|matches[password]',

            'role_id' =>

            'required|numeric',

            'status' =>

            'required|in_list[active,inactive]',

            'avatar' =>

            'permit_empty|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png,image/webp]|max_size[avatar,2048]'
        ];

        /*
    |--------------------------------------------------------------------------
    | VALIDATE
    |--------------------------------------------------------------------------
    */

        if (
            !$this->validate($rules)
        ) {

            return $this->response
                ->setJSON([

                    'status' => false,

                    'errors' =>

                    $this->validator
                        ->getErrors(),

                    'message' =>
                    'Validation failed'
                ]);
        }

        /*
    |--------------------------------------------------------------------------
    | GENERATE VERIFICATION CODE
    |--------------------------------------------------------------------------
    */

        $verificationCode =

            random_int(
                100000,
                999999
            );

        $verificationExpires =

            date(
                'Y-m-d H:i:s',
                strtotime('+5 minutes')
            );

        /*
    |--------------------------------------------------------------------------
    | HANDLE AVATAR UPLOAD
    |--------------------------------------------------------------------------
    */

        $avatarName = null;

        $avatar =

            $this->request
            ->getFile('avatar');

        if (
            $avatar &&
            $avatar->isValid() &&
            !$avatar->hasMoved()
        ) {

            $avatarName =

                $avatar
                ->getRandomName();

            $avatar->move(

                FCPATH .
                    'uploads/avatars',

                $avatarName
            );
        }

        /*
    |--------------------------------------------------------------------------
    | INSERT USER
    |--------------------------------------------------------------------------
    */

        try {

            $this->adminUserModel
                ->insert([

                    'first_name' =>

                    trim(
                        $this->request
                            ->getPost('first_name')
                    ),

                    'last_name' =>

                    trim(
                        $this->request
                            ->getPost('last_name')
                    ),

                    'email' =>

                    trim(
                        strtolower(
                            $this->request
                                ->getPost('email')
                        )
                    ),

                    'phone' =>

                    trim(
                        $this->request
                            ->getPost('phone')
                    ),

                    'password' =>

                    password_hash(

                        $this->request
                            ->getPost('password'),

                        PASSWORD_DEFAULT
                    ),

                    'role_id' =>

                    $this->request
                        ->getPost('role_id'),

                    'status' =>

                    $this->request
                        ->getPost('status'),

                    'avatar' =>

                    $avatarName,

                    /*
                    |--------------------------------------------------------------------------
                    | EMAIL VERIFICATION
                    |--------------------------------------------------------------------------
                    */

                    'email_verified' => 0,

                    'email_verification_code' =>

                    $verificationCode,

                    'email_verification_expires' =>

                    $verificationExpires,

                    /*
                    |--------------------------------------------------------------------------
                    | SECURITY DEFAULTS
                    |--------------------------------------------------------------------------
                    */

                    'is_first_login' => 1,

                    'two_factor_enabled' => 0,

                    'login_attempts' => 0,

                    'verification_attempts' => 0
                ]);

            /*
                |--------------------------------------------------------------------------
                | GET INSERTED USER ID
                |--------------------------------------------------------------------------
                */
            $userId = $this->adminUserModel->getInsertID();
            /*
                |--------------------------------------------------------------------------
                | ACTIVITY LOG
                |--------------------------------------------------------------------------
                */
            activity_log(

                'CREATE',

                'USERS',

                $userId,

                'Created new user'
            );

            /*
            |--------------------------------------------------------------------------
            | SEND VERIFICATION EMAIL
            |--------------------------------------------------------------------------
            */

            $emailSent = false;

            if (
                $this->request
                ->getPost('send_email')
            ) {

                helper('url');

                $fullName =

                    trim(
                        $this->request
                            ->getPost('first_name')
                    ) . ' ' .

                    trim(
                        $this->request
                            ->getPost('last_name')
                    );

                $verifyUrl =

                    base_url(
                        'verify-email/' .
                            $verificationCode
                    );

                $email =
                    service('email');

                $email->setTo(

                    $this->request
                        ->getPost('email')
                );

                $email->setSubject(
                    'Verify Your Account'
                );

                $email->setMessage(

                    view(
                        'admin/emails/verify_account',
                        [

                            'fullName' =>
                            $fullName,

                            'code' =>
                            $verificationCode,

                            'verifyUrl' =>
                            $verifyUrl
                        ]
                    )
                );

                /*
            |--------------------------------------------------------------------------
            | SEND EMAIL SAFELY
            |--------------------------------------------------------------------------
            */

                try {

                    $emailSent =
                        $email->send();

                    /*
                |--------------------------------------------------------------------------
                | DEBUG SMTP FAILURE
                |--------------------------------------------------------------------------
                */

                    if (!$emailSent) {

                        log_message(
                            'error',
                            $email->printDebugger(
                                ['headers']
                            )
                        );

                        dd(
                            $email->printDebugger(
                                ['headers']
                            )
                        );
                    }
                } catch (\Exception $e) {

                    log_message(
                        'error',
                        $e->getMessage()
                    );
                }
            }

            /*
        |--------------------------------------------------------------------------
        | SUCCESS RESPONSE
        |--------------------------------------------------------------------------
        */

            return $this->response
                ->setJSON([

                    'status' => true,

                    'message' =>

                    $emailSent

                        ? 'User created successfully. Verification email sent.'

                        : 'User created successfully, but verification email could not be sent.'
                ]);
        } catch (\Exception $e) {

            log_message(
                'error',
                $e->getMessage()
            );

            return $this->response
                ->setJSON([

                    'status' => false,

                    'message' =>
                    $e->getMessage()
                ]);
        }
    }
    /*
    |--------------------------------------------------------------------------
    | EDIT USER
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        /*
    |--------------------------------------------------------------------------
    | FIND USER
    |--------------------------------------------------------------------------
    */

        $user =
            $this->adminUserModel
            ->find($id);

        if (!$user) {

            return redirect()
                ->to('admin/users')
                ->with(
                    'error',
                    'User not found'
                );
        }

        /*
    |--------------------------------------------------------------------------
    | LOAD EDIT VIEW
    |--------------------------------------------------------------------------
    */

        if (
            strtolower(
                $this->request->getMethod()
            ) === 'get'
        ) {

            return view(
                'admin/users/edit',
                [

                    'title' => 'Edit User',

                    'user' => $user,

                    'roles' =>
                    $this->roleModel
                        ->findAll()
                ]
            );
        }

        /*
    |--------------------------------------------------------------------------
    | AJAX ONLY AFTER GET
    |--------------------------------------------------------------------------
    */

        if (
            !$this->request->isAJAX()
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
    | VALIDATION RULES
    |--------------------------------------------------------------------------
    */

        $rules = [

            'first_name' =>

            'required|min_length[2]|max_length[100]',

            'last_name' =>

            'required|min_length[2]|max_length[100]',

            'email' =>

            'required|valid_email',

            'phone' =>

            'permit_empty|min_length[10]|max_length[20]',

            'role_id' =>

            'required|numeric',

            'status' =>

            'required|in_list[active,inactive]',

            'avatar' =>

            'permit_empty|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png,image/webp]|max_size[avatar,2048]'
        ];

        /*
    |--------------------------------------------------------------------------
    | VALIDATE
    |--------------------------------------------------------------------------
    */

        if (
            !$this->validate($rules)
        ) {

            return $this->response
                ->setJSON([

                    'status' => false,

                    'errors' =>

                    $this->validator
                        ->getErrors(),

                    'message' =>
                    'Validation failed'
                ]);
        }

        /*
    |--------------------------------------------------------------------------
    | CHECK DUPLICATE EMAIL
    |--------------------------------------------------------------------------
    */

        $existing =

            $this->adminUserModel

            ->where(
                'email',
                trim(
                    strtolower(
                        $this->request
                            ->getPost('email')
                    )
                )
            )

            ->where(
                'id !=',
                $id
            )

            ->first();

        if ($existing) {

            return $this->response
                ->setJSON([

                    'status' => false,

                    'errors' => [

                        'email' =>
                        'Email already exists'
                    ]
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA
        |--------------------------------------------------------------------------
        */

        $updateData = [

            'first_name' =>

            trim(
                $this->request
                    ->getPost('first_name')
            ),

            'last_name' =>

            trim(
                $this->request
                    ->getPost('last_name')
            ),

            'email' =>

            trim(
                strtolower(
                    $this->request
                        ->getPost('email')
                )
            ),

            'phone' =>

            trim(
                $this->request
                    ->getPost('phone')
            ),

            'role_id' =>

            $this->request
                ->getPost('role_id'),

            'status' =>

            $this->request
                ->getPost('status')
        ];



        /*
        |--------------------------------------------------------------------------
        | AVATAR UPDATE
        |--------------------------------------------------------------------------
        */

        $avatar =

            $this->request
            ->getFile('avatar');

        if (
            $avatar &&
            $avatar->isValid() &&
            !$avatar->hasMoved()
        ) {

            /*
        |--------------------------------------------------------------------------
        | DELETE OLD AVATAR
        |--------------------------------------------------------------------------
        */

            if (
                !empty($user['avatar']) &&
                file_exists(

                    FCPATH .

                        'uploads/avatars/' .

                        $user['avatar']
                )
            ) {

                unlink(

                    FCPATH .

                        'uploads/avatars/' .

                        $user['avatar']
                );
            }

            /*
        |--------------------------------------------------------------------------
        | UPLOAD NEW AVATAR
        |--------------------------------------------------------------------------
        */

            $avatarName =

                $avatar
                ->getRandomName();

            $avatar->move(

                FCPATH .
                    'uploads/avatars',

                $avatarName
            );

            $updateData['avatar'] =
                $avatarName;
        }

        /*
    |--------------------------------------------------------------------------
    | UPDATE USER
    |--------------------------------------------------------------------------
    */

        $this->adminUserModel
            ->update(
                $id,
                $updateData
            );

        /*
    |--------------------------------------------------------------------------
    | ACTIVITY LOG
    |--------------------------------------------------------------------------
    */

        activity_log(

            'UPDATE',

            'USERS',

            $id,

            'Updated user account'
        );

        /*
    |--------------------------------------------------------------------------
    | RESPONSE
    |--------------------------------------------------------------------------
    */

        return $this->response
            ->setJSON([

                'status' => true,

                'message' =>
                'User updated successfully'
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE USER STATUS
    |--------------------------------------------------------------------------
    */
    public function status($id)
    {
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
        | FIND USER
        |--------------------------------------------------------------------------
        */

        $user =
            $this->adminUserModel
            ->find($id);

        if (!$user) {

            return $this->response
                ->setJSON([

                    'status' => false,

                    'message' =>
                    'User not found'
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATE STATUS
        |--------------------------------------------------------------------------
        */

        $status =
            $this->request
            ->getPost('status');

        if (
            !in_array(
                $status,
                [

                    'active',

                    'inactive'
                ]
            )
        ) {

            return $this->response
                ->setJSON([

                    'status' => false,

                    'message' =>
                    'Invalid status'
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE USER STATUS
        |--------------------------------------------------------------------------
        */

        $this->adminUserModel
            ->update($id, [

                'status' => $status
            ]);

        /*
        |--------------------------------------------------------------------------
        | ACTIVITY LOG
        |--------------------------------------------------------------------------
        */

        activity_log(

            'UPDATE',

            'USERS',

            $id,

            'Updated user status to ' .
                strtoupper($status)
        );

        /*
        |--------------------------------------------------------------------------
        | SUCCESS RESPONSE
        |--------------------------------------------------------------------------
        */

        return $this->response
            ->setJSON([

                'status' => true,

                'message' =>

                'User status updated successfully'
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SEARCH USERS
    |--------------------------------------------------------------------------
    */
    public function search()
    {
        /*
        |--------------------------------------------------------------------------
        | AJAX ONLY
        |--------------------------------------------------------------------------
        */

        if (
            !$this->request->isAJAX()
        ) {

            return;
        }

        $keyword =
            trim(

                $this->request
                    ->getGet('keyword')
            );

        $builder =
            $this->adminUserModel

            ->select(
                'admin_users.*, roles.name as role_name'
            )

            ->join(
                'roles',
                'roles.id = admin_users.role_id',
                'left'
            );

        /*
        |--------------------------------------------------------------------------
        | FILTER
        |--------------------------------------------------------------------------
        */

        if (!empty($keyword)) {

            $builder->groupStart()

                ->like(
                    'admin_users.first_name',
                    $keyword
                )

                ->orLike(
                    'admin_users.last_name',
                    $keyword
                )

                ->orLike(
                    'admin_users.email',
                    $keyword
                )

                ->orLike(
                    'admin_users.phone',
                    $keyword
                )

                ->groupEnd();
        }

        $users =
            $builder

            ->orderBy(
                'admin_users.id',
                'DESC'
            )

            ->find();

        /*
        |--------------------------------------------------------------------------
        | RETURN PARTIAL VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'admin/users/ajax/table_rows',
            [

                'users' => $users
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE USER
    |--------------------------------------------------------------------------
    */
    public function delete($id)
    {
        /*
    |--------------------------------------------------------------------------
    | AJAX ONLY
    |--------------------------------------------------------------------------
    */

        if (
            !$this->request->isAJAX()
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
    | FIND USER
    |--------------------------------------------------------------------------
    */

        $user =
            $this->adminUserModel
            ->find($id);

        if (!$user) {

            return $this->response
                ->setJSON([

                    'status' => false,

                    'message' =>
                    'User not found'
                ]);
        }

        /*
    |--------------------------------------------------------------------------
    | PREVENT SELF DELETE
    |--------------------------------------------------------------------------
    */

        if (
            session('admin_id') == $id
        ) {

            return $this->response
                ->setJSON([

                    'status' => false,

                    'message' =>
                    'You cannot delete your own account'
                ]);
        }

        /*
    |--------------------------------------------------------------------------
    | DELETE AVATAR
    |--------------------------------------------------------------------------
    */

        if (
            !empty($user['avatar']) &&
            file_exists(

                FCPATH .
                    'uploads/avatars/' .
                    $user['avatar']
            )
        ) {

            unlink(

                FCPATH .
                    'uploads/avatars/' .
                    $user['avatar']
            );
        }

        /*
    |--------------------------------------------------------------------------
    | DELETE USER
    |--------------------------------------------------------------------------
    */

        $this->adminUserModel
            ->delete($id);

        /*
    |--------------------------------------------------------------------------
    | ACTIVITY LOG
    |--------------------------------------------------------------------------
    */

        activity_log(

            'DELETE',

            'USERS',

            $id,

            'Deleted user account'
        );

        /*
    |--------------------------------------------------------------------------
    | RESPONSE
    |--------------------------------------------------------------------------
    */

        return $this->response
            ->setJSON([

                'status' => true,

                'message' =>
                'User deleted successfully'
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SEND TEMPORARY PASSWORD
    |--------------------------------------------------------------------------
    */
    public function sendTempPassword($id)
    {
        /*
        |--------------------------------------------------------------------------
        | AJAX ONLY
        |--------------------------------------------------------------------------
        */

        if (
            !$this->request->isAJAX()
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
        | FIND USER
        |--------------------------------------------------------------------------
        */

        $user =
            $this->adminUserModel
            ->find($id);

        if (!$user) {

            return $this->response
                ->setJSON([

                    'status' => false,

                    'message' =>
                    'User not found'
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | GENERATE TEMP PASSWORD
        |--------------------------------------------------------------------------
        */

        $tempPassword =

            substr(

                str_shuffle(

                    '!@#$%^&*()_+ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789'
                ),

                0,

                10
            );

        /*
        |--------------------------------------------------------------------------
        | EXPIRATION
        |--------------------------------------------------------------------------
        */

        $expiresAt =

            date(

                'Y-m-d H:i:s',

                strtotime('+30 minutes')
            );

        /*
        |--------------------------------------------------------------------------
        | UPDATE USER
        |--------------------------------------------------------------------------
        */

        $this->adminUserModel
            ->update($id, [

                'password' =>

                password_hash(

                    $tempPassword,

                    PASSWORD_DEFAULT
                ),

                'temp_password_expires' =>

                $expiresAt,

                'must_change_password' => 1
            ]);

        /*
        |--------------------------------------------------------------------------
        | EMAIL DATA
        |--------------------------------------------------------------------------
        */

        $fullName =

            trim(

                ($user['first_name'] ?? '') .
                    ' ' .
                    ($user['last_name'] ?? '')
            );

        /*
        |--------------------------------------------------------------------------
        | SEND EMAIL
        |--------------------------------------------------------------------------
        */

        $email = service('email');

        $email->setTo(
            $user['email']
        );

        $email->setSubject(
            'Temporary Login Password'
        );

        $email->setMessage(

            view(
                'admin/emails/temp_password',
                [

                    'fullName' => $fullName,

                    'tempPassword' => $tempPassword,

                    'expiresAt' => $expiresAt
                ]
            )
        );

        if (
            !$email->send()
        ) {

            return $this->response
                ->setJSON([

                    'status' => false,

                    'message' =>
                    'Failed to send email'
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | ACTIVITY LOG
        |--------------------------------------------------------------------------
        */

        activity_log(

            'PASSWORD_RESET',

            'USERS',

            $id,

            'Admin sent temporary password'
        );

        /*
    |--------------------------------------------------------------------------
    | RESPONSE
    |--------------------------------------------------------------------------
    */

        return $this->response
            ->setJSON([

                'status' => true,

                'message' =>

                'Temporary password sent successfully'
            ]);
    }
}
