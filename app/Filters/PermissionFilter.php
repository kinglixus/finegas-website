<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\HTTP\ResponseInterface;

class PermissionFilter implements FilterInterface
{
    public function before(
        RequestInterface $request,
        $arguments = null
    ) {
        if (!$arguments) {

            return;
        }

        $permissions =
            session('admin_permissions') ?? [];

        foreach ($arguments as $permission) {

            if (
                in_array(
                    $permission,
                    $permissions
                )
            ) {

                return;
            }
        }

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
                    'Permission denied.'
                ]);
        }

        return redirect()

            ->to(base_url('admin/home'))

            ->with(
                'error',
                'Permission denied.'
            );
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {}
}
