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

    private function decodeExtraData(?array $row): ?array
    {
        if (empty($row)) {
            return null;
        }

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

        return $this->decodeExtraData($section);
    }

    public function getSections(): array
    {
        $sections = $this->where('status', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();

        $data = [];

        foreach ($sections as $section) {
            $section = $this->decodeExtraData($section);

            if (!empty($section['section_name'])) {
                $data[$section['section_name']] = $section;
            }
        }

        return $data;
    }

    public function getAboutPageData(): array
    {
        $sections = $this->getSections();

        return [
            'page_header'    => $sections['page_header'] ?? null,
            'company_intro'  => $sections['company_intro'] ?? null,
            'vision'         => $sections['vision'] ?? null,
            'about_fine_gas' => $sections['about_fine_gas'] ?? null,
        ];
    }
}
