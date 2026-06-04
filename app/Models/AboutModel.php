<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutModel extends Model
{
    protected $table            = 'about_pages';
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

    private function decodeExtraData(array $row): array
    {
        if (!empty($row['extra_data'])) {
            $decoded = json_decode($row['extra_data'], true);
            $row['extra_data'] = is_array($decoded) ? $decoded : [];
        } else {
            $row['extra_data'] = [];
        }

        return $row;
    }

    public function getSection(string $sectionName): ?array
    {
        $section = $this->where('section_name', $sectionName)
            ->where('section_type', 'section')
            ->where('status', 1)
            ->orderBy('sort_order', 'ASC')
            ->first();

        return $section ? $this->decodeExtraData($section) : null;
    }

    public function getAboutPageData(): array
    {
        return [
            'page_header'    => $this->getSection('page_header'),
            'company_intro'  => $this->getSection('company_intro'),
            'vision'         => $this->getSection('vision'),
            'about_fine_gas' => $this->getSection('about_fine_gas'),
        ];
    }
}
