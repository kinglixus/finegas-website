<?php

use Config\Services;

function admin_logged_in(): bool
{
    $session = Services::session();
    return $session->get('admin_id') !== null;
}

function admin_id(): ?int
{
    $session = Services::session();
    return $session->get('admin_id');
}

function admin_user(): ?array
{
    $session = Services::session();
    $adminId = $session->get('admin_id');
    
    if (!$adminId) {
        return null;
    }

    $adminUserModel = new \App\Models\AdminUserModel();
    return $adminUserModel->find($adminId);
}

function admin_has_role(int $roleId): bool
{
    $user = admin_user();
    if (!$user) {
        return false;
    }
    return ($user['role_id'] ?? 0) == $roleId;
}

function admin_is_super_admin(): bool
{
    return admin_has_role(1);
}

function admin_can(string $permission): bool
{
    $user = admin_user();
    if (!$user) {
        return false;
    }

    // Role ID 1 (super_admin) has all permissions
    if (($user['role_id'] ?? 0) == 1) {
        return true;
    }

    $permissions = json_decode($user['permissions'] ?? '[]', true);
    return in_array($permission, $permissions);
}

function admin_has_permission(string $permission): bool
{
    return admin_can($permission);
}

function admin_logout(): void
{
    $session = Services::session();
    $session->destroy();
}