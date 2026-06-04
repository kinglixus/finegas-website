<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\PermissionModel;

class Permissions extends BaseController
{
    protected $permissionModel;

    public function __construct()
    {
        $this->permissionModel =
            new PermissionModel();
    }

    /*
    |--------------------------------------------------------------------------
    | PERMISSIONS LIST
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $permissions =
            $this->permissionModel
            ->findAll();

        return view(
            'admin/permissions/index',
            [

                'title' => 'Permissions',

                'permissions' => $permissions
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE PERMISSION
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        if (!$this->request->isAJAX()) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Invalid request'
            ]);
        }

        $rules = [

            'name' =>
            'required|min_length[3]',

            'slug' => 'required|regex_match[/^[a-z0-9._-]+$/]|is_unique[permissions.slug]',

            'module' =>
            'required'
        ];

        if (!$this->validate($rules)) {

            return $this->response->setJSON([

                'status' => false,

                'errors' =>
                $this->validator
                    ->getErrors()
            ]);
        }

        $this->permissionModel->insert([

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

            'module' =>
            trim(
                $this->request
                    ->getPost('module')
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
            'Permission created successfully'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE PERMISSION
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        /*
    |--------------------------------------------------------------------------
    | AJAX ONLY
    |--------------------------------------------------------------------------
    */

        if (!$this->request->isAJAX()) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Invalid request'
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | FIND PERMISSION
    |--------------------------------------------------------------------------
    */

        $permission =
            $this->permissionModel
            ->find($id);

        if (!$permission) {

            return $this->response->setJSON([

                'status' => false,

                'message' => 'Permission not found'
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | PROTECT SYSTEM PERMISSIONS
    |--------------------------------------------------------------------------
    */

        $protected = [

            'roles.permissions',

            'roles.view',

            'permissions.view'
        ];

        if (
            in_array(
                $permission['slug'],
                $protected
            )
        ) {

            return $this->response->setJSON([

                'status' => false,

                'message' =>
                'This permission is protected'
            ]);
        }

        try {

            /*
        |--------------------------------------------------------------------------
        | REMOVE ROLE LINKS
        |--------------------------------------------------------------------------
        */

            db_connect()

                ->table('role_permissions')

                ->where(
                    'permission_id',
                    $id
                )

                ->delete();

            /*
        |--------------------------------------------------------------------------
        | DELETE PERMISSION
        |--------------------------------------------------------------------------
        */

            $this->permissionModel
                ->delete($id);

            return $this->response->setJSON([

                'status' => true,

                'message' =>
                'Permission deleted successfully'
            ]);
        } catch (\Exception $e) {

            log_message(
                'error',
                $e->getMessage()
            );

            return $this->response->setJSON([

                'status' => false,

                'message' =>
                'Failed to delete permission'
            ]);
        }
    }


    public function edit($id)
    {
        /*
        |--------------------------------------------------------------------------
        | FIND PERMISSION
        |--------------------------------------------------------------------------
        */

        $permission =
            $this->permissionModel
            ->find($id);

        if (!$permission) {

            return redirect()

                ->back()

                ->with(
                    'error',
                    'Permission not found'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | AJAX UPDATE
        |--------------------------------------------------------------------------
        */

        if ($this->request->isAJAX()) {

            $rules = [

                'name' =>

                'required|min_length[3]',

                'slug' =>

                'required|regex_match[/^[a-z0-9._-]+$/]',

                'module' =>

                'required'
            ];

            if (!$this->validate($rules)) {

                return $this->response->setJSON([

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
            | CHECK DUPLICATE SLUG
            |--------------------------------------------------------------------------
            */

            $exists =
                $this->permissionModel

                ->where(
                    'slug',
                    trim(
                        $this->request
                            ->getPost('slug')
                    )
                )

                ->where(
                    'id !=',
                    $id
                )

                ->first();

            if ($exists) {

                return $this->response->setJSON([

                    'status' => false,

                    'errors' => [

                        'slug' =>
                        'Permission slug already exists'
                    ]
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | UPDATE
            |--------------------------------------------------------------------------
            */

            $this->permissionModel->update($id, [

                'name' => trim(
                    $this->request
                        ->getPost('name')
                ),

                'slug' => trim(
                    $this->request
                        ->getPost('slug')
                ),

                'module' => trim(
                    $this->request
                        ->getPost('module')
                ),

                'description' => trim(
                    $this->request
                        ->getPost('description')
                )
            ]);

            return $this->response->setJSON([

                'status' => true,

                'message' =>
                'Permission updated successfully'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'admin/permissions/edit',
            [

                'title' => 'Edit Permission',

                'permission' => $permission
            ]
        );
    }
}
