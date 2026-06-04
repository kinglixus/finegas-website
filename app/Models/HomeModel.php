<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    protected $table            = 'home_pages';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useTimestamps    = true;

    protected $allowedFields = [
        'section_name',
        'section_type',
        'title',
        'subtitle',
        'description',
        'image',
        'icon',
        'button_text',
        'button_url',
        'extra_data',
        'sort_order',
        'status',
    ];

    public function getSectionItems($sectionName)
    {
        return $this->where('section_name', $sectionName)
            ->where('section_type', 'item')
            ->where('status', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }

    public function getSection($sectionName)
    {
        $section = $this->where('section_name', $sectionName)
            ->where('section_type', 'section')
            ->where('status', 1)
            ->orderBy('sort_order', 'ASC')
            ->first();

        if (!empty($section['extra_data'])) {
            $section['extra_data'] = json_decode($section['extra_data'], true);
        }

        return $section;
    }

    public function getHomePageData()
    {
        return [
            'sliders'         => $this->getSectionItems('slider'),
            'statistics'     => $this->getSectionItems('statistics'),
            'about'          => $this->getSection('about'),
            'services_header' => $this->getSection('services_header'),
            'services'       => $this->getSectionItems('services'),
            'choose_us'      => $this->getSection('choose_us'),
        ];
    }
}
