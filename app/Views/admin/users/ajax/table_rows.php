 <?php if (!empty($users)): ?>

     <?php foreach ($users as $key => $user): ?>



         <tr id="user-row-<?= $user['id'] ?>">

             <!-- ===================================================== -->
             <!-- ID -->
             <!-- ===================================================== -->

             <td>

                 <?php
                    $key = isset($key) ? $key + 1 : 1;
                    echo $key++ ?>

             </td>

             <!-- ===================================================== -->
             <!-- USER -->
             <!-- ===================================================== -->

             <td>

                 <div class="d-flex align-items-center gap-3">

                     <?php

                        $avatar = !empty($user['avatar'])

                            ? base_url(
                                'uploads/avatars/' .
                                    $user['avatar']
                            )

                            : base_url(
                                'public/assets_admin/images/avatar/default-avatar.png'
                            );

                        ?>

                     <img src="<?= $avatar ?>" class="rounded-circle border" width="45" height="45" style="object-fit:cover;">

                     <div>

                         <div class="fw-semibold">

                             <?= esc(

                                    trim(

                                        ($user['first_name'] ?? '') .
                                            ' ' .
                                            ($user['last_name'] ?? '')
                                    )
                                ) ?>

                         </div>

                         <small class="text-muted">

                             <?= esc(
                                    $user['phone'] ?? '-'
                                ) ?>

                         </small>

                     </div>

                 </div>

             </td>

             <!-- ===================================================== -->
             <!-- EMAIL -->
             <!-- ===================================================== -->

             <td>

                 <?= esc($user['email']) ?>

             </td>

             <!-- ===================================================== -->
             <!-- ROLE -->
             <!-- ===================================================== -->

             <td>

                 <?php

                    $roleBadge =
                        'bg-secondary';

                    if (
                        strtolower(
                            $user['role_name'] ?? ''
                        ) === 'super admin'
                    ) {

                        $roleBadge =
                            'bg-danger';
                    } elseif (
                        strtolower(
                            $user['role_name'] ?? ''
                        ) === 'admin'
                    ) {

                        $roleBadge =
                            'bg-primary';
                    } elseif (
                        strtolower(
                            $user['role_name'] ?? ''
                        ) === 'manager'
                    ) {

                        $roleBadge =
                            'bg-info';
                    }

                    ?>

                 <span class="badge <?= $roleBadge ?>">

                     <?= esc(
                            $user['role_name'] ?? 'N/A'
                        ) ?>

                 </span>

             </td>

             <!-- ===================================================== -->
             <!-- STATUS -->
             <!-- ===================================================== -->

             <td>

                 <div class="form-check form-switch">

                     <input class="form-check-input user-status-toggle" type="checkbox" data-id="<?= $user['id'] ?>"
                         <?= ($user['status'] ?? '') === 'active'
                                ? 'checked'
                                : '' ?> <?= !can('users.edit')
                                                                                                                                        ? 'disabled'
                                                                                                                                        : '' ?>>

                     <label class="form-check-label status-label">

                         <?= ucfirst(
                                $user['status'] ?? 'inactive'
                            ) ?>

                     </label>

                 </div>

             </td>


             <!-- ===================================================== -->
             <!-- ACTIONS -->
             <!-- ===================================================== -->

             <td>

                 <div class="d-flex align-items-center gap-2">

                     <?php if (can('users.edit')): ?>

                         <a href="<?= base_url('admin/users/edit/' . $user['id']) ?>" class="btn btn-sm btn-warning">

                             <i class="feather-edit-2"></i>

                         </a>

                     <?php endif; ?>

                     <?php if (can('users.delete')): ?>

                         <button type="button" class="btn btn-sm btn-danger delete-user-btn" data-id="<?= $user['id'] ?>" data-name="<?= esc(

                                                                                                                                            trim(

                                                                                                                                                ($user['first_name'] ?? '') .
                                                                                                                                                    ' ' .
                                                                                                                                                    ($user['last_name'] ?? '')
                                                                                                                                            )
                                                                                                                                        ) ?>">

                             <i class="feather-trash-2"></i>

                         </button>

                     <?php endif; ?>

                     <?php if (can('users.edit')): ?>

                         <button type="button" class="btn btn-sm btn-dark send-temp-password-btn" data-id="<?= $user['id'] ?>"
                             data-name="<?= esc(

                                            trim(

                                                ($user['first_name'] ?? '') .
                                                    ' ' .
                                                    ($user['last_name'] ?? '')
                                            )
                                        ) ?>">

                             <i class="feather-lock"></i>

                         </button>

                     <?php endif; ?>

                 </div>

             </td>

         </tr>

     <?php endforeach; ?>

 <?php else: ?>

     <tr>

         <td colspan="7" class="text-center py-5">

             <div class="text-muted">

                 No users found

             </div>

         </td>

     </tr>

 <?php endif; ?>