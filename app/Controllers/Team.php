<?php

namespace App\Controllers;

use App\Models\TeamModel;

class Team extends BaseController
{
    protected $teamModel;

    public function __construct()
    {
        $this->teamModel = new TeamModel();
    }

    public function index()
    {
        $teamData = $this->teamModel->getTeamPageData();

        $data = [
            'title' => ($teamData['page_header']['title'] ?? 'Our Team') . ' - Fine Gas',
        ];

        $data = array_merge($data, $teamData);

        return view('pages/team', $data);
    }
}
