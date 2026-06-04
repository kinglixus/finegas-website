<?php

if (!function_exists('can')) {

    function can(string $permission): bool
    {
        $permissions =
            session('admin_permissions') ?? [];

        return in_array(
            $permission,
            $permissions
        );
    }
}
