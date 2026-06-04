<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\HTTP\ResponseInterface;

use CodeIgniter\Filters\FilterInterface;

class ForcePasswordChangeFilter
implements FilterInterface
{
    public function before(
        RequestInterface $request,
        $arguments = null
    ) {
        /*
        |--------------------------------------------------------------------------
        | NOT LOGGED IN
        |--------------------------------------------------------------------------
        */

        if (
            !session('is_admin_logged_in')
        ) {

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | MUST CHANGE PASSWORD?
        |--------------------------------------------------------------------------
        */

        if (
            (int) session(
                'admin_must_change_password'
            ) !== 1
        ) {

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | URI STRING
        |--------------------------------------------------------------------------
        */

        $uri = service('uri');

        $path = trim(
            $uri->getPath(),
            '/'
        );

        /*
        |--------------------------------------------------------------------------
        | DEBUG
        |--------------------------------------------------------------------------
        */

        log_message(
            'debug',
            'CURRENT FILTER PATH: ' . $path
        );

        /*
        |--------------------------------------------------------------------------
        | ALLOW CHANGE PASSWORD PAGE
        |--------------------------------------------------------------------------
        */

        if (
            str_contains(
                $path,
                'admin/change-temp-password'
            )
        ) {

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | ALLOW LOGOUT
        |--------------------------------------------------------------------------
        */

        if (
            str_contains(
                $path,
                'admin/logout'
            )
        ) {

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()->to(

            base_url(
                'admin/change-temp-password'
            )
        );
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {

        //
    }
}
