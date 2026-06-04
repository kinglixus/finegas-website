<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\RoleModel;

use App\Models\PermissionModel;

use App\Models\RolePermissionModel;

class Roles extends BaseController
{
    protected $roleModel;

    protected $permissionModel;

    protected $rolePermissionModel;

    public function __construct()
    {
        $this->roleModel = new RoleModel();

        $this->permissionModel =
            new PermissionModel();

        $this->rolePermissionModel =
            new RolePermissionModel();
    }

    /*
    |--------------------------------------------------------------------------
    | ROLES LIST
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $keyword =
            $this->request->getGet('keyword');

        if ($keyword) {

            $roles =
                $this->roleModel
                ->search($keyword);
        } else {

            $roles =
                $this->roleModel
                ->findAll();
        }

        return view(
            'admin/roles/index',
            [

                'title' => 'Roles',

                'roles' => $roles,

                'keyword' => $keyword
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE ROLE
    |--------------------------------------------------------------------------
    */

    // public function create()
    // {
    //     if (!$this->request->isAJAX()) {

    //         return $this->response->setJSON([

    //             'status' => false,

    //             'message' => 'Invalid request'
    //         ]);
    //     }

    //     $rules = [

    //         'name' =>
    //         'required|min_length[3]',

    //         'slug' =>
    //         'required|alpha_dash|is_unique[roles.slug]'
    //     ];

    //     if (!$this->validate($rules)) {

    //         return $this->response->setJSON([

    //             'status' => false,

    //             'errors' =>
    //             $this->validator
    //                 ->getErrors()
    //         ]);
    //     }

    //     $this->roleModel->insert([

    //         'name' =>
    //         trim(
    //             $this->request
    //                 ->getPost('name')
    //         ),

    //         'slug' =>
    //         trim(
    //             $this->request
    //                 ->getPost('slug')
    //         ),

    //         'description' =>
    //         trim(
    //             $this->request
    //                 ->getPost('description')
    //         )
    //     ]);

    //     return $this->response->setJSON([

    //         'status' => true,

    //         'message' =>
    //         'Role created successfully'
    //     ]);
    // }
    public function create()
    {
        /*
    |--------------------------------------------------------------------------
    | AJAX ONLY
    |--------------------------------------------------------------------------
    */

        if (!$this->request->isAJAX()) {

            return $this->response->setJSON([

                'status'  => false,

                'message' => 'Invalid request'

            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | VALIDATION RULES
    |--------------------------------------------------------------------------
    */

        $rules = [

            'name' =>

            'required|min_length[3]',

            'slug' =>

            'required|alpha_dash|is_unique[roles.slug]'
        ];

        /*
    |--------------------------------------------------------------------------
    | VALIDATE
    |--------------------------------------------------------------------------
    */

        if (!$this->validate($rules)) {

            return $this->response->setJSON([

                'status' => false,

                'errors' =>

                $this->validator
                    ->getErrors(),

                'message' => 'Validation failed'
            ]);
        }

        try {

            /*
        |--------------------------------------------------------------------------
        | INSERT ROLE
        |--------------------------------------------------------------------------
        */

            $insert = $this->roleModel->insert([

                'name' => trim(

                    $this->request
                        ->getPost('name')

                ),

                'slug' => trim(

                    $this->request
                        ->getPost('slug')

                ),

                'description' => trim(

                    $this->request
                        ->getPost('description')

                )
            ]);

            /*
        |--------------------------------------------------------------------------
        | INSERT FAILED
        |--------------------------------------------------------------------------
        */

            if (!$insert) {

                return $this->response->setJSON([

                    'status'  => false,

                    'message' => 'Failed to create role'
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

            return $this->response->setJSON([

                'status'  => true,

                'message' => 'Role added successfully'
            ]);
        } catch (\Exception $e) {

            log_message(
                'error',
                $e->getMessage()
            );

            return $this->response->setJSON([

                'status'  => false,

                'message' => 'Something went wrong'
            ]);
        }
    }
    /*
    |--------------------------------------------------------------------------
    | EDIT ROLE
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $role =
            $this->roleModel->find($id);

        if (!$role) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Role not found'
            ]);
        }

        if ($this->request->isAJAX()) {

            $rules = [

                'name' =>
                'required|min_length[3]',

                'slug' =>
                'required|alpha_dash'
            ];

            if (!$this->validate($rules)) {

                return $this->response->setJSON([

                    'status' => false,

                    'errors' =>
                    $this->validator
                        ->getErrors()
                ]);
            }

            $this->roleModel->update($id, [

                'name' =>
                trim(
                    $this->request
                        ->getPost('name')
                ),

                'slug' =>
                trim(
                    $this->request
                        ->getPost('slug')
                ),

                'description' =>
                trim(
                    $this->request
                        ->getPost('description')
                )
            ]);

            return $this->response->setJSON([

                'status' => true,

                'message' =>
                'Role updated successfully'
            ]);
        }

        return view(
            'admin/roles/edit',
            [

                'title' => 'Edit Role',

                'role' => $role
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE ROLE
    |--------------------------------------------------------------------------
    */

    // public function delete($id)
    // {
    //     $role =
    //         $this->roleModel->find($id);

    //     if (!$role) {

    //         return redirect()

    //             ->back()

    //             ->with(
    //                 'error',
    //                 'Role not found'
    //             );
    //     }

    //     /*
    //     |--------------------------------------------------------------------------
    //     | PREVENT SUPER ADMIN DELETE
    //     |--------------------------------------------------------------------------
    //     */

    //     if ($role['slug'] === 'super_admin') {

    //         return redirect()

    //             ->back()

    //             ->with(
    //                 'error',
    //                 'Super Admin role cannot be deleted.'
    //             );
    //     }

    //     $this->roleModel->delete($id);

    //     return redirect()

    //         ->back()

    //         ->with(
    //             'success',
    //             'Role deleted successfully'
    //         );
    // }

    public function delete($id)
    {
        /*
    |--------------------------------------------------------------------------
    | AJAX ONLY
    |--------------------------------------------------------------------------
    */

        if (!$this->request->isAJAX()) {

            return $this->response->setJSON([

                'status'  => false,

                'message' => 'Invalid request'
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | FIND ROLE
    |--------------------------------------------------------------------------
    */

        $role =
            $this->roleModel->find($id);

        if (!$role) {

            return $this->response->setJSON([

                'status'  => false,

                'message' => 'Role not found'
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | PREVENT SUPER ADMIN DELETE
    |--------------------------------------------------------------------------
    */

        if ($role['slug'] === 'super_admin') {

            return $this->response->setJSON([

                'status'  => false,

                'message' =>
                'Super Admin role cannot be deleted.'
            ]);
        }

        try {

            /*
        |--------------------------------------------------------------------------
        | DELETE ROLE
        |--------------------------------------------------------------------------
        */

            $this->roleModel->delete($id);

            return $this->response->setJSON([

                'status'  => true,

                'message' =>
                'Role deleted successfully'
            ]);
        } catch (\Exception $e) {

            log_message(
                'error',
                $e->getMessage()
            );

            return $this->response->setJSON([

                'status'  => false,

                'message' =>
                'Failed to delete role'
            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | ROLE PERMISSIONS
    |--------------------------------------------------------------------------
    */

    public function permissions($id)
    {
        $role =
            $this->roleModel->find($id);

        if (!$role) {

            return redirect()

                ->back()

                ->with(
                    'error',
                    'Role not found'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | SAVE PERMISSIONS
        |--------------------------------------------------------------------------
        */

        if ($this->request->isAJAX()) {

            $permissions =
                $this->request
                ->getPost('permissions') ?? [];

            $this->rolePermissionModel
                ->syncPermissions(
                    $id,
                    $permissions
                );

            return $this->response->setJSON([

                'status' => true,

                'message' =>
                'Permissions updated successfully'
            ]);
        }

        $groupedPermissions =
            $this->permissionModel
            ->groupedPermissions();

        $assignedPermissions =
            $this->rolePermissionModel
            ->getRolePermissions($id);

        return view(
            'admin/roles/permissions',
            [

                'title' =>
                'Role Permissions',

                'role' => $role,

                'permissions' =>
                $groupedPermissions,

                'assignedPermissions' =>
                $assignedPermissions
            ]
        );
    }
}
