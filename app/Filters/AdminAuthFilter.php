<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\HTTP\ResponseInterface;

use Config\Services;

class AdminAuthFilter implements FilterInterface
{
    /*
    |--------------------------------------------------------------------------
    | BEFORE REQUEST
    |--------------------------------------------------------------------------
    */

    public function before(
        RequestInterface $request,
        $arguments = null
    ) {
        $session = Services::session();

        /*
        |--------------------------------------------------------------------------
        | NOT LOGGED IN
        |--------------------------------------------------------------------------
        */

        if (!$session->get('admin_id')) {

            /*
            |--------------------------------------------------------------------------
            | AJAX REQUEST
            |--------------------------------------------------------------------------
            */

            if ($request->isAJAX()) {

                return service('response')
                    ->setJSON([

                        'status' => false,

                        'message' =>
                        'Your session has expired.',

                        'redirect' =>
                        base_url('login')
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | NORMAL REQUEST
            |--------------------------------------------------------------------------
            */

            return redirect()

                ->to(base_url('login'))

                ->with(
                    'error',
                    'Please login to continue.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | FIND USER
        |--------------------------------------------------------------------------
        */

        $adminUserModel = new \App\Models\AdminUserModel();

        $admin = $adminUserModel->find(
            $session->get('admin_id')
        );

        /*
        |--------------------------------------------------------------------------
        | USER NOT FOUND
        |--------------------------------------------------------------------------
        */

        if (!$admin) {

            $session->destroy();

            /*
            |--------------------------------------------------------------------------
            | AJAX REQUEST
            |--------------------------------------------------------------------------
            */

            if ($request->isAJAX()) {

                return service('response')
                    ->setJSON([

                        'status' => false,

                        'message' =>
                        'User account not found.',

                        'redirect' =>
                        base_url('login')
                    ]);
            }

            return redirect()

                ->to(base_url('login'))

                ->with(
                    'error',
                    'User not found.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | ACCOUNT INACTIVE
        |--------------------------------------------------------------------------
        */

        if (
            !isset($admin['status']) ||

            $admin['status'] !== 'active'
        ) {

            $session->destroy();

            /*
            |--------------------------------------------------------------------------
            | AJAX REQUEST
            |--------------------------------------------------------------------------
            */

            if ($request->isAJAX()) {

                return service('response')
                    ->setJSON([

                        'status' => false,

                        'message' =>
                        'Your account is inactive.',

                        'redirect' =>
                        base_url('login')
                    ]);
            }

            return redirect()

                ->to(base_url('login'))

                ->with(
                    'error',
                    'Your account is inactive.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | ROLE PROTECTION
        |--------------------------------------------------------------------------
        */

        if ($arguments) {

            if (
                !isset($admin['role']) ||

                !in_array(
                    $admin['role'],
                    $arguments
                )
            ) {

                /*
                |--------------------------------------------------------------------------
                | AJAX REQUEST
                |--------------------------------------------------------------------------
                */

                if ($request->isAJAX()) {

                    return service('response')
                        ->setJSON([

                            'status' => false,

                            'message' =>
                            'You do not have permission to perform this action.'
                        ]);
                }

                return redirect()

                    ->to(base_url('admin/home'))

                    ->with(
                        'error',
                        'You do not have permission to access this page.'
                    );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | CONTINUE REQUEST
        |--------------------------------------------------------------------------
        */

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | AFTER REQUEST
    |--------------------------------------------------------------------------
    */

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        return null;
    }
}
