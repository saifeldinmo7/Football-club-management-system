<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Team.php';

class TeamController extends Controller
{
    private $teamModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->requireLogin();
        $this->teamModel = new Team();
    }

    public function index()
    {
        $teams = $this->teamModel->getAllTeams();

        $this->view('teams/index', [
            'teams' => $teams
        ]);
    }

    public function create()
    {
        $this->view('teams/create');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect(BASE_URL . 'index.php?page=teams');
        }

        $teamName = trim($_POST['teamName'] ?? '');
        $category = trim($_POST['category'] ?? '');

        if ($teamName === '' || $category === '') {
            $this->view('teams/create', [
                'error' => 'Please enter team name and category.'
            ]);

            return;
        }

        $this->teamModel->addTeam($teamName, $category);

        $this->redirect(BASE_URL . 'index.php?page=teams');
    }

    public function edit()
    {
        $teamId = (int) ($_GET['id'] ?? 0);

        if ($teamId <= 0) {
            $this->redirect(BASE_URL . 'index.php?page=teams');
        }

        $team = $this->teamModel->getTeamById($teamId);

        if (!$team) {
            die('Team not found.');
        }

        $this->view('teams/edit', [
            'team' => $team
        ]);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect(BASE_URL . 'index.php?page=teams');
        }

        $teamId = (int) ($_POST['teamId'] ?? 0);
        $teamName = trim($_POST['teamName'] ?? '');
        $category = trim($_POST['category'] ?? '');

        if ($teamId <= 0 || $teamName === '' || $category === '') {
            die('Invalid team data.');
        }

        $this->teamModel->updateTeam($teamId, $teamName, $category);

        $this->redirect(BASE_URL . 'index.php?page=teams');
    }

    public function delete()
    {
        $teamId = (int) ($_GET['id'] ?? 0);

        if ($teamId > 0) {
            $this->teamModel->deleteTeam($teamId);
        }

        $this->redirect(BASE_URL . 'index.php?page=teams');
    }
}