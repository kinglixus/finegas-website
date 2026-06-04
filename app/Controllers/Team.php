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
        $data = [
            'title' => 'Our Team - Fine Gas',

        ];
        $data = array_merge($data, $this->teamModel->getTeamPageData());
        return view('pages/team', $data);
    }
}
