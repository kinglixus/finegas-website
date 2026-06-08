<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AboutModel;

class Aboutpage extends BaseController
{
    protected $aboutModel;

    public function __construct()
    {
        $this->aboutModel = new AboutModel();
    }

    public function index()
    {
        $data = [
            'title' => 'About Page CMS',

            'page_header' => $this->aboutModel->getSection('page_header'),

            'company_intro' => $this->aboutModel->getSection('company_intro'),

            'vision' => $this->aboutModel->getSection('vision'),

            'about_fine_gas' => $this->aboutModel->getSection('about_fine_gas'),
        ];

        return view('admin/aboutpage/index', $data);
    }

    public function pageHeader()
    {
        $pageHeader = $this->aboutModel->getSection('page_header');

        return view('admin/aboutpage/page_header', [
            'title'      => 'Page Header',
            'pageHeader' => $pageHeader,
        ]);
    }

    public function updatePageHeader()
    {
        $pageHeader = $this->aboutModel->getSection('page_header');

        if (!$pageHeader) {
            return redirect()
                ->back()
                ->with('error', 'Page Header section not found.');
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'subtitle'    => $this->request->getPost('subtitle'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status'),
        ];

        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $uploadedImage = $this->uploadAboutImage($image, $pageHeader['image'] ?? null);

            if ($uploadedImage !== null) {
                $data['image'] = $uploadedImage;
            }
        }

        $this->aboutModel->update($pageHeader['id'], $data);

        activity_log(
            'PAGE_HEADER_UPDATED',
            'CMS',
            session('admin_id'),
            'About page header updated'
        );

        return redirect()
            ->back()
            ->with('success', 'Page Header updated successfully.');
    }

    public function companyIntro()
    {
        $companyIntro = $this->aboutModel->getSection('company_intro');

        return view('admin/aboutpage/company_intro', [
            'title'        => 'Company Intro',
            'companyIntro' => $companyIntro,
        ]);
    }

    public function updateCompanyIntro()
    {
        $companyIntro = $this->aboutModel->getSection('company_intro');

        if (!$companyIntro) {
            return redirect()
                ->back()
                ->with('error', 'Section not found.');
        }

        $extraData = [
            'highlight_text' => trim((string) $this->request->getPost('highlight_text')),
        ];

        $data = [
            'title'       => $this->request->getPost('title'),
            'subtitle'    => $this->request->getPost('subtitle'),
            'description' => $this->request->getPost('description'),
            'extra_data'  => json_encode($extraData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            'status'      => $this->request->getPost('status'),
        ];

        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $uploadedImage = $this->uploadAboutImage($image, $companyIntro['image'] ?? null);

            if ($uploadedImage !== null) {
                $data['image'] = $uploadedImage;
            }
        }

        $this->aboutModel->update($companyIntro['id'], $data);

        activity_log(
            'COMPANY_INTRO_UPDATED',
            'CMS',
            session('admin_id'),
            'Company Intro updated'
        );

        return redirect()
            ->back()
            ->with('success', 'Company Intro updated successfully.');
    }

    public function vision()
    {
        $vision = $this->aboutModel->getSection('vision');

        return view('admin/aboutpage/vision', [
            'title'  => 'Vision',
            'vision' => $vision,
        ]);
    }

    public function updateVision()
    {
        $vision = $this->aboutModel->getSection('vision');

        if (!$vision) {
            return redirect()
                ->back()
                ->with('error', 'Vision section not found.');
        }

        $this->aboutModel->update($vision['id'], [
            'title'       => $this->request->getPost('title'),
            'subtitle'    => $this->request->getPost('subtitle'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status'),
        ]);

        activity_log(
            'VISION_UPDATED',
            'CMS',
            session('admin_id'),
            'About page vision updated'
        );

        return redirect()
            ->back()
            ->with('success', 'Vision updated successfully.');
    }

    public function aboutFineGas()
    {
        $aboutFineGas = $this->aboutModel->getSection('about_fine_gas');

        return view('admin/aboutpage/about_fine_gas', [
            'title'        => 'About Fine Gas',
            'aboutFineGas' => $aboutFineGas,
        ]);
    }

    public function updateAboutFineGas()
    {
        $aboutFineGas = $this->aboutModel->getSection('about_fine_gas');

        if (!$aboutFineGas) {
            return redirect()
                ->back()
                ->with('error', 'Section not found.');
        }

        $paragraphs = [];

        for ($i = 1; $i <= 6; $i++) {
            $paragraphText = trim((string) $this->request->getPost('paragraph_' . $i));
            $linkText      = trim((string) $this->request->getPost('link_text_' . $i));
            $linkUrl       = trim((string) $this->request->getPost('link_url_' . $i));

            if ($paragraphText === '') {
                continue;
            }

            $paragraphs[] = [
                'text' => $paragraphText,
                'link' => ($linkText !== '' && $linkUrl !== '')
                    ? [
                        'text' => $linkText,
                        'url'  => $linkUrl,
                    ]
                    : null,
            ];
        }

        $this->aboutModel->update($aboutFineGas['id'], [
            'title' => $this->request->getPost('title'),

            'subtitle' => $this->request->getPost('subtitle'),

            'extra_data' => json_encode([
                'paragraphs' => $paragraphs,
            ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),

            'status' => $this->request->getPost('status'),
        ]);

        activity_log(
            'ABOUT_FINE_GAS_UPDATED',
            'CMS',
            session('admin_id'),
            'About Fine Gas section updated'
        );

        return redirect()
            ->back()
            ->with('success', 'About Fine Gas updated successfully.');
    }

    private function uploadAboutImage($image, ?string $oldImage = null): ?string
    {
        $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/webp'];

        if (!in_array($image->getMimeType(), $allowedTypes, true)) {
            return null;
        }

        $uploadPath = FCPATH . 'uploads/about';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0775, true);
        }

        if (
            !empty($oldImage)
            && str_starts_with($oldImage, 'uploads/about/')
            && file_exists(FCPATH . $oldImage)
        ) {
            unlink(FCPATH . $oldImage);
        }

        $newName = $image->getRandomName();

        $image->move($uploadPath, $newName);

        return 'uploads/about/' . $newName;
    }
}
