<?php

use App\Models\AdminUserModel;

if (
    !function_exists(
        'refreshAdminSessionPermissions'
    )
) {

    function refreshAdminSessionPermissions()
    {
        $session = session();

        /*
        |--------------------------------------------------------------------------
        | CHECK LOGIN
        |--------------------------------------------------------------------------
        */

        if (
            !$session->get(
                'is_admin_logged_in'
            )
        ) {

            return;
        }

        $adminId =
            $session->get(
                'admin_id'
            );

        $adminUserModel =
            new AdminUserModel();

        /*
        |--------------------------------------------------------------------------
        | GET USER
        |--------------------------------------------------------------------------
        */

        $user =
            $adminUserModel

            ->select(
                'admin_users.*, roles.name as role_name'
            )

            ->join(
                'roles',
                'roles.id = admin_users.role_id',
                'left'
            )

            ->find($adminId);

        if (!$user) {

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | GET PERMISSIONS
        |--------------------------------------------------------------------------
        */

        $permissions =
            $adminUserModel
            ->getUserPermissions(
                $adminId
            );

        /*
        |--------------------------------------------------------------------------
        | UPDATE SESSION
        |--------------------------------------------------------------------------
        */

        $session->set([

            'admin_first_name' =>
            $user['first_name'] ?? '',

            'admin_last_name' =>
            $user['last_name'] ?? '',

            'admin_avatar' =>
            $user['avatar'] ?? '',

            'admin_phone' =>
            $user['phone'] ?? '',

            'admin_status' =>
            $user['status'] ?? '',

            'admin_role' =>
            $user['role_id'] ?? '',

            'admin_role_name' =>
            $user['role_name'] ?? '',

            'admin_permissions' =>
            $permissions
        ]);
    }
}
