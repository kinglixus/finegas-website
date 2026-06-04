<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\HomeModel;

class Homepage extends BaseController
{
    protected $homeModel;

    public function __construct()
    {
        $this->homeModel = new HomeModel();
    }

    public function homepage()
    {
        $data = [

            'title' => 'Homepage Builder',

            'sliders' =>

            $this->homeModel
                ->where('section_name', 'slider')
                ->findAll(),

            'statistics' =>

            $this->homeModel
                ->where('section_name', 'statistics')
                ->findAll(),

            'services' =>

            $this->homeModel
                ->where('section_name', 'services')
                ->findAll(),

            'about' =>

            $this->homeModel
                ->where('section_name', 'about')
                ->first(),

            'services_header' =>

            $this->homeModel
                ->where('section_name', 'services_header')
                ->first(),

            'choose_us' =>

            $this->homeModel
                ->where('section_name', 'choose_us')
                ->first()
        ];

        return view(
            'admin/homepage/index',
            $data
        );
    }


    public function sliders()
    {
        $data = [

            'title' => 'Homepage Sliders',

            'sliders' =>

            $this->homeModel

                ->where(
                    'section_name',
                    'slider'
                )

                ->where(
                    'section_type',
                    'item'
                )

                ->orderBy(
                    'sort_order',
                    'ASC'
                )

                ->findAll()
        ];

        return view(
            'admin/homepage/sliders',
            $data
        );
    }

    public function createSlider()
    {
        return view(
            'admin/homepage/sliders_create',
            [
                'title' => 'Create Homepage Slide'
            ]
        );
    }

    public function storeSlider()
    {
        $image =
            $this->request
            ->getFile('image');

        $imagePath = null;

        if (
            $image &&
            $image->isValid()
        ) {

            $newName =
                $image->getRandomName();

            $image->move(
                FCPATH .
                    'uploads/homepage',
                $newName
            );

            $imagePath =
                'uploads/homepage/' .
                $newName;
        }

        $this->homeModel
            ->insert([

                'section_name' =>
                'slider',

                'section_type' =>
                'item',

                'title' =>
                $this->request->getPost('title'),

                'description' =>
                $this->request->getPost('description'),

                'image' =>
                $imagePath,

                'button_text' =>
                $this->request->getPost('button_text'),

                'button_url' =>
                $this->request->getPost('button_url'),

                'sort_order' =>
                $this->request->getPost('sort_order'),

                'status' =>
                $this->request->getPost('status')
            ]);

        activity_log(
            'SLIDER_CREATED',
            'CMS',
            session('admin_id'),
            'Homepage slider created'
        );

        return redirect()
            ->to(
                base_url(
                    'admin/homepage/sliders'
                )
            )
            ->with(
                'success',
                'Slider created successfully.'
            );
    }

    public function editSlider($id)
    {
        $slider = $this->homeModel->find($id);

        if (!$slider) {
            return redirect()
                ->to(base_url('admin/homepage'))
                ->with('error', 'Slider not found.');
        }

        return view(
            'admin/homepage/sliders_edit',
            [
                'title'  => 'Edit Slider',
                'slider' => $slider
            ]
        );
    }

    // public function updateSlider($id)
    // {
    //     $slider = $this->homeModel->find($id);

    //     if (!$slider) {
    //         return redirect()
    //             ->back()
    //             ->with('error', 'Slider not found.');
    //     }

    //     $data = [

    //         'title'       => $this->request->getPost('title'),

    //         'description' => $this->request->getPost('description'),

    //         'button_text' => $this->request->getPost('button_text'),

    //         'button_url'  => $this->request->getPost('button_url'),

    //         'sort_order'  => $this->request->getPost('sort_order'),

    //         'status'      => $this->request->getPost('status')
    //     ];

    //     $image = $this->request->getFile('image');

    //     if ($image && $image->isValid()) {

    //         $newName = $image->getRandomName();

    //         $image->move(
    //             FCPATH . 'uploads/homepage',
    //             $newName
    //         );

    //         $data['image'] =
    //             'uploads/homepage/' . $newName;
    //     }

    //     $this->homeModel->update(
    //         $id,
    //         $data
    //     );

    //     activity_log(
    //         'SLIDER_UPDATED',
    //         'CMS',
    //         session('admin_id'),
    //         'Homepage slider updated'
    //     );

    //     return redirect()
    //         ->to(
    //             base_url(
    //                 'admin/homepage/sliders'
    //             )
    //         )
    //         ->with(
    //             'success',
    //             'Slider updated successfully.'
    //         );
    // }


    public function updateSlider($id)
    {
        $slider =
            $this->homeModel
            ->find($id);

        if (!$slider) {
            return redirect()
                ->back();
        }

        $data = [

            'title' =>

            $this->request
                ->getPost(
                    'title'
                ),

            'description' =>

            $this->request
                ->getPost(
                    'description'
                ),

            'button_text' =>

            $this->request
                ->getPost(
                    'button_text'
                ),

            'button_url' =>

            $this->request
                ->getPost(
                    'button_url'
                ),

            'sort_order' =>

            $this->request
                ->getPost(
                    'sort_order'
                ),

            'status' =>

            $this->request
                ->getPost(
                    'status'
                )
        ];

        $image =
            $this->request
            ->getFile(
                'image'
            );

        if (
            $image &&
            $image->isValid()
        ) {
            /*
        |--------------------------------------------------------------------------
        | DELETE OLD IMAGE
        |--------------------------------------------------------------------------
        */

            if (
                !empty($slider['image'])
                &&
                file_exists(
                    FCPATH .
                        $slider['image']
                )
            ) {
                unlink(
                    FCPATH .
                        $slider['image']
                );
            }

            /*
        |--------------------------------------------------------------------------
        | SAVE NEW IMAGE
        |--------------------------------------------------------------------------
        */

            $newName =
                $image
                ->getRandomName();

            $image->move(
                FCPATH .
                    'uploads/homepage',
                $newName
            );

            $data['image'] =
                'uploads/homepage/' .
                $newName;
        }

        $this->homeModel
            ->update(
                $id,
                $data
            );

        activity_log(
            'SLIDER_UPDATED',
            'CMS',
            session('admin_id'),
            'Homepage slider updated'
        );

        return redirect()
            ->to(
                base_url(
                    'admin/homepage/sliders'
                )
            )
            ->with(
                'success',
                'Slider updated successfully.'
            );
    }

    public function deleteSlider($id)
    {
        // dd($id);
        $slider =
            $this->homeModel
            ->find($id);

        if (!$slider) {
            return $this->response
                ->setJSON([
                    'status' => false
                ]);
        }

        /*
    |--------------------------------------------------------------------------
    | DELETE IMAGE
    |--------------------------------------------------------------------------
    */

        if (
            !empty($slider['image'])
            &&
            file_exists(
                FCPATH .
                    $slider['image']
            )
        ) {
            unlink(
                FCPATH .
                    $slider['image']
            );
        }

        /*
    |--------------------------------------------------------------------------
    | DELETE RECORD
    |--------------------------------------------------------------------------
    */

        $this->homeModel
            ->delete($id);

        activity_log(
            'SLIDER_DELETED',
            'CMS',
            session('admin_id'),
            'Homepage slider deleted'
        );

        return $this->response
            ->setJSON([
                'status' => true
            ]);
    }
    public function statistics()
    {
        $data = [

            'title' => 'Homepage Statistics',

            'statistics' =>

            $this->homeModel

                ->where(
                    'section_name',
                    'statistics'
                )

                ->where(
                    'section_type',
                    'item'
                )

                ->orderBy(
                    'sort_order',
                    'ASC'
                )

                ->findAll()
        ];

        // dd($data['statistics']);

        return view(
            'admin/homepage/statistics',
            $data
        );
    }


    public function storeStatistic()
    {
        $this->homeModel
            ->insert([

                'section_name' =>
                'statistics',

                'section_type' =>
                'item',

                'title' =>
                $this->request->getPost('title'),

                'icon' =>
                $this->request->getPost('icon'),

                'extra_data' =>
                json_encode([

                    'number' =>
                    $this->request
                        ->getPost(
                            'counter'
                        )
                ]),

                'sort_order' =>
                $this->request
                    ->getPost(
                        'sort_order'
                    ),

                'status' =>
                $this->request
                    ->getPost(
                        'status'
                    )
            ]);

        return redirect()
            ->to(
                base_url(
                    'admin/homepage/statistics'
                )
            )
            ->with(
                'success',
                'Statistic created successfully.'
            );
    }

    public function createStatistic()
    {
        return view(
            'admin/homepage/statistics_create',
            [
                'title' => 'Create Statistic'
            ]
        );
    }


    public function editStatistic($id)
    {
        $statistic =
            $this->homeModel
            ->find($id);

        if (!$statistic) {

            return redirect()
                ->to(
                    base_url(
                        'admin/homepage/statistics'
                    )
                )
                ->with(
                    'error',
                    'Statistic not found.'
                );
        }

        $extraData =
            json_decode(
                $statistic['extra_data'],
                true
            );

        return view(
            'admin/homepage/statistics_edit',
            [

                'title' =>

                'Edit Statistic',

                'statistic' =>

                $statistic,

                'extraData' =>

                $extraData
            ]
        );
    }

    public function updateStatistic($id)
    {
        $this->homeModel
            ->update(
                $id,
                [

                    'title' =>
                    $this->request
                        ->getPost(
                            'title'
                        ),

                    'icon' =>
                    $this->request
                        ->getPost(
                            'icon'
                        ),

                    'sort_order' =>
                    $this->request
                        ->getPost(
                            'sort_order'
                        ),

                    'status' =>
                    $this->request
                        ->getPost(
                            'status'
                        ),

                    'subtitle' =>
                    $this->request
                        ->getPost(
                            'counter'
                        ),

                    'extra_data' =>
                    json_encode([

                        'number' =>
                        $this->request
                            ->getPost(
                                'counter'
                            )
                    ])
                ]
            );

        return redirect()
            ->to(
                base_url(
                    'admin/homepage/statistics'
                )
            )
            ->with(
                'success',
                'Statistic updated successfully.'
            );
    }

    public function about()
    {
        $about = $this->homeModel
            ->where('section_name', 'about')
            ->where('section_type', 'section')
            ->first();

        return view(
            'admin/homepage/about',
            [
                'title' => 'About Section',
                'about' => $about
            ]
        );
    }


    public function aboutUpdate()
    {
        $about = $this->homeModel
            ->where('section_name', 'about')
            ->where('section_type', 'section')
            ->first();

        if (!$about) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'About section not found.'
                );
        }

        $data = [

            'title' =>
            $this->request
                ->getPost('title'),

            'subtitle' =>
            $this->request
                ->getPost('subtitle'),

            'description' =>
            $this->request
                ->getPost('description'),

            'button_text' =>
            $this->request
                ->getPost('button_text'),

            'button_url' =>
            $this->request
                ->getPost('button_url'),

            'status' =>
            $this->request
                ->getPost('status'),
        ];

        /*
    |--------------------------------------------------------------------------
    | IMAGE UPLOAD
    |--------------------------------------------------------------------------
    */

        $image =
            $this->request
            ->getFile('image');

        if (
            $image &&
            $image->isValid() &&
            !$image->hasMoved()
        ) {

            /*
        |--------------------------------------------------------------------------
        | DELETE OLD IMAGE
        |--------------------------------------------------------------------------
        */

            if (
                !empty($about['image']) &&
                file_exists(
                    FCPATH .
                        $about['image']
                )
            ) {
                unlink(
                    FCPATH .
                        $about['image']
                );
            }

            /*
        |--------------------------------------------------------------------------
        | SAVE NEW IMAGE
        |--------------------------------------------------------------------------
        */

            $newName =
                $image->getRandomName();

            $image->move(
                FCPATH .
                    'uploads/homepage',
                $newName
            );

            $data['image'] =
                'uploads/homepage/' .
                $newName;
        }

        $this->homeModel
            ->update(
                $about['id'],
                $data
            );

        activity_log(
            'ABOUT_UPDATED',
            'CMS',
            session('admin_id'),
            'Homepage About section updated'
        );

        return redirect()
            ->back()
            ->with(
                'success',
                'About section updated successfully.'
            );
    }

    public function servicesHeader()
    {
        $servicesHeader =
            $this->homeModel
            ->where(
                'section_name',
                'services_header'
            )
            ->where(
                'section_type',
                'section'
            )
            ->first();

        return view(
            'admin/homepage/services_header',
            [

                'title' =>
                'Services Header',

                'servicesHeader' =>
                $servicesHeader
            ]
        );
    }

    public function servicesHeaderUpdate()
    {
        $header =
            $this->homeModel
            ->where(
                'section_name',
                'services_header'
            )
            ->where(
                'section_type',
                'section'
            )
            ->first();

        if (!$header) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Services header not found.'
                );
        }

        $this->homeModel
            ->update(
                $header['id'],
                [

                    'title' =>
                    $this->request
                        ->getPost(
                            'title'
                        ),

                    'subtitle' =>
                    $this->request
                        ->getPost(
                            'subtitle'
                        ),

                    'description' =>
                    $this->request
                        ->getPost(
                            'description'
                        ),

                    'status' =>
                    $this->request
                        ->getPost(
                            'status'
                        )
                ]
            );

        activity_log(
            'SERVICES_HEADER_UPDATED',
            'CMS',
            session('admin_id'),
            'Homepage services header updated'
        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Services header updated successfully.'
            );
    }


    public function services()
    {
        $data = [

            'title' => 'Services',

            'services' =>

            $this->homeModel

                ->where(
                    'section_name',
                    'services'
                )

                ->where(
                    'section_type',
                    'item'
                )

                ->orderBy(
                    'sort_order',
                    'ASC'
                )

                ->findAll()
        ];

        return view(
            'admin/homepage/services',
            $data
        );
    }


    public function editService($id)
    {
        $service = $this->homeModel->find($id);

        if (!$service) {
            return redirect()
                ->to(
                    base_url(
                        'admin/homepage/services'
                    )
                )
                ->with(
                    'error',
                    'Service not found.'
                );
        }

        return view(
            'admin/homepage/services_edit',
            [
                'title'   => 'Edit Service',
                'service' => $service
            ]
        );
    }


    public function updateService($id)
    {
        $service = $this->homeModel->find($id);

        if (!$service) {
            return redirect()
                ->to(
                    base_url(
                        'admin/homepage/services'
                    )
                )
                ->with(
                    'error',
                    'Service not found.'
                );
        }

        $data = [

            'title' =>
            $this->request
                ->getPost(
                    'title'
                ),

            'subtitle' =>
            $this->request
                ->getPost(
                    'subtitle'
                ),

            'description' =>
            $this->request
                ->getPost(
                    'description'
                ),

            'icon' =>
            $this->request
                ->getPost(
                    'icon'
                ),

            'button_text' =>
            $this->request
                ->getPost(
                    'button_text'
                ),

            'button_url' =>
            $this->request
                ->getPost(
                    'button_url'
                ),

            'sort_order' =>
            $this->request
                ->getPost(
                    'sort_order'
                ),

            'status' =>
            $this->request
                ->getPost(
                    'status'
                )
        ];

        /*
    |--------------------------------------------------------------------------
    | IMAGE REPLACEMENT
    |--------------------------------------------------------------------------
    */

        $image =
            $this->request
            ->getFile(
                'image'
            );

        if (
            $image &&
            $image->isValid() &&
            !$image->hasMoved()
        ) {
            /*
        |--------------------------------------------------------------------------
        | DELETE OLD IMAGE
        |--------------------------------------------------------------------------
        */

            if (
                !empty($service['image'])
                &&
                file_exists(
                    FCPATH .
                        $service['image']
                )
            ) {
                unlink(
                    FCPATH .
                        $service['image']
                );
            }

            /*
        |--------------------------------------------------------------------------
        | SAVE NEW IMAGE
        |--------------------------------------------------------------------------
        */

            $newName =
                $image
                ->getRandomName();

            $image->move(
                FCPATH .
                    'uploads/homepage',
                $newName
            );

            $data['image'] =
                'uploads/homepage/' .
                $newName;
        }

        /*
    |--------------------------------------------------------------------------
    | UPDATE RECORD
    |--------------------------------------------------------------------------
    */

        $this->homeModel
            ->update(
                $id,
                $data
            );

        /*
    |--------------------------------------------------------------------------
    | ACTIVITY LOG
    |--------------------------------------------------------------------------
    */

        activity_log(
            'SERVICE_UPDATED',
            'CMS',
            session('admin_id'),
            'Homepage service updated'
        );

        return redirect()
            ->to(
                base_url(
                    'admin/homepage/services'
                )
            )
            ->with(
                'success',
                'Service updated successfully.'
            );
    }


    public function deleteService($id)
    {
        $service = $this->homeModel
            ->find($id);

        if (!$service) {
            return $this->response
                ->setJSON([
                    'status' => false
                ]);
        }

        /*
    |--------------------------------------------------------------------------
    | DELETE IMAGE
    |--------------------------------------------------------------------------
    */

        if (
            !empty($service['image'])
            &&
            file_exists(
                FCPATH .
                    $service['image']
            )
        ) {
            unlink(
                FCPATH .
                    $service['image']
            );
        }

        /*
    |--------------------------------------------------------------------------
    | DELETE RECORD
    |--------------------------------------------------------------------------
    */

        $this->homeModel
            ->delete($id);

        /*
    |--------------------------------------------------------------------------
    | ACTIVITY LOG
    |--------------------------------------------------------------------------
    */

        activity_log(
            'SERVICE_DELETED',
            'CMS',
            session('admin_id'),
            'Homepage service deleted'
        );

        return $this->response
            ->setJSON([
                'status' => true
            ]);
    }


    public function createService()
    {
        return view(
            'admin/homepage/services_create',
            [
                'title' => 'Create Service'
            ]
        );
    }


    public function storeService()
    {
        $image = $this->request->getFile('image');

        $imagePath = null;

        if (
            $image &&
            $image->isValid() &&
            !$image->hasMoved()
        ) {

            $newName = $image->getRandomName();

            $image->move(
                FCPATH . 'uploads/homepage',
                $newName
            );

            $imagePath =
                'uploads/homepage/' .
                $newName;
        }

        $this->homeModel->insert([

            'section_name' => 'services',

            'section_type' => 'item',

            'title' =>
            $this->request->getPost('title'),

            'subtitle' =>
            $this->request->getPost('subtitle'),

            'description' =>
            $this->request->getPost('description'),

            'icon' =>
            $this->request->getPost('icon'),

            'image' =>
            $imagePath,

            'button_text' =>
            $this->request->getPost('button_text'),

            'button_url' =>
            $this->request->getPost('button_url'),

            'sort_order' =>
            $this->request->getPost('sort_order'),

            'status' =>
            $this->request->getPost('status'),
        ]);

        activity_log(
            'SERVICE_CREATED',
            'CMS',
            session('admin_id'),
            'Homepage service created'
        );

        return redirect()
            ->to(
                base_url(
                    'admin/homepage/services'
                )
            )
            ->with(
                'success',
                'Service created successfully.'
            );
    }



    public function chooseUs()
    {
        $chooseUs = $this->homeModel
            ->where(
                'section_name',
                'choose_us'
            )
            ->where(
                'section_type',
                'section'
            )
            ->first();

        return view(
            'admin/homepage/choose_us',
            [
                'title'    => 'Why Choose Us',
                'chooseUs' => $chooseUs
            ]
        );
    }


    public function chooseUsUpdate()
    {
        $chooseUs = $this->homeModel
            ->where(
                'section_name',
                'choose_us'
            )
            ->where(
                'section_type',
                'section'
            )
            ->first();

        if (!$chooseUs) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Record not found.'
                );
        }

        $data = [

            'title' =>
            $this->request
                ->getPost('title'),

            'subtitle' =>
            $this->request
                ->getPost('subtitle'),

            'description' =>
            $this->request
                ->getPost('description'),

            'status' =>
            $this->request
                ->getPost('status')
        ];

        $image =
            $this->request
            ->getFile('image');

        if (
            $image &&
            $image->isValid() &&
            !$image->hasMoved()
        ) {
            if (
                !empty($chooseUs['image']) &&
                file_exists(
                    FCPATH .
                        $chooseUs['image']
                )
            ) {
                unlink(
                    FCPATH .
                        $chooseUs['image']
                );
            }

            $newName =
                $image->getRandomName();

            $image->move(
                FCPATH .
                    'uploads/homepage',
                $newName
            );

            $data['image'] =
                'uploads/homepage/' .
                $newName;
        }

        $this->homeModel
            ->update(
                $chooseUs['id'],
                $data
            );

        activity_log(
            'WHY_CHOOSE_US_UPDATED',
            'CMS',
            session('admin_id'),
            'Homepage Why Choose Us updated'
        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Why Choose Us updated successfully.'
            );
    }
}
