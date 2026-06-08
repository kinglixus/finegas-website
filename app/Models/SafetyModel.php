<?php

namespace App\Models;

use CodeIgniter\Model;

class SafetyModel extends Model
{
    protected $table            = 'safety_pages';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
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

    public function getSectionItems(string $sectionName): array
    {
        $items = $this->where('section_name', $sectionName)
            ->where('section_type', 'item')
            ->where('status', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();

        foreach ($items as $key => $item) {
            $items[$key] = $this->decodeExtraData($item);
        }

        return $items;
    }

    public function getSafetyPageData(): array
    {
        return [
            'page_header'       => $this->getSection('page_header'),
            'safety_header'     => $this->getSection('safety_header'),
            'safety_tips'       => $this->getSectionItems('safety_tips'),
            'emergency_header'  => $this->getSection('emergency_header'),
            'emergency_contact' => $this->getSection('emergency_contact'),
        ];
    }
}
