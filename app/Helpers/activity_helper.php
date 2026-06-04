<?php

use App\Models\ActivityLogModel;

if (!function_exists('activity_log')) {

    function activity_log(

        string $action,

        string $module,

        ?int $recordId = null,

        ?string $description = null

    ) {

        $session = session();

        $model =
            new ActivityLogModel();

        $model->insert([

            'user_id' =>

            $session->get(
                'admin_id'
            ),

            'user_name' =>

            trim(

                $session->get(
                    'admin_first_name'
                ) . ' ' .

                    $session->get(
                        'admin_last_name'
                    )
            ),

            'user_email' =>

            $session->get(
                'admin_email'
            ),

            'action' =>

            strtoupper($action),

            'module' =>

            strtoupper($module),

            'record_id' =>

            $recordId,

            'description' =>

            $description,

            'ip_address' =>

            service('request')
                ->getIPAddress(),

            'user_agent' =>

            service('request')
                ->getUserAgent()
                ->getAgentString()
        ]);
    }
}
