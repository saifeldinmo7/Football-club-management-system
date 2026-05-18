<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/MatchModel.php';
require_once __DIR__ . '/../../config/config.php';

class MatchController extends Controller
{
    private $matchModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->matchModel = new MatchModel();
        $this->requireLogin();
    }

    public function index()
    {
        $matches = $this->matchModel->getAllMatches();
        $this->view('matches/index', ['matches' => $matches]);
    }

    public function create()
    {
        $teams = $this->matchModel->getTeams();
        $this->view('matches/create', ['teams' => $teams]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect(BASE_URL . 'index.php?page=matches');
        }

        $teamId = (int)($_POST['teamId'] ?? 0);
        $opponent = trim($_POST['opponent'] ?? '');
        $matchDate = trim($_POST['matchDate'] ?? '');
        $location = trim($_POST['location'] ?? '');
        $status = trim($_POST['status'] ?? 'scheduled');

        if ($teamId <= 0 || $opponent === '' || $matchDate === '' || $location === '') {
            $teams = $this->matchModel->getTeams();
            $this->view('matches/create', [
                'teams' => $teams,
                'error' => 'Please fill in all required fields.'
            ]);
            return;
        }

        $this->matchModel->createMatch($teamId, $opponent, $matchDate, $location, $status);
        $this->redirect(BASE_URL . 'index.php?page=matches');
    }

    public function edit()
    {
        $matchId = (int)($_GET['id'] ?? 0);
        $match = $this->matchModel->getMatchById($matchId);

        if (!$match) {
            die('Match not found.');
        }

        $teams = $this->matchModel->getTeams();
        $this->view('matches/edit', ['match' => $match, 'teams' => $teams]);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect(BASE_URL . 'index.php?page=matches');
        }

        $matchId = (int)($_POST['matchId'] ?? 0);
        $teamId = (int)($_POST['teamId'] ?? 0);
        $opponent = trim($_POST['opponent'] ?? '');
        $matchDate = trim($_POST['matchDate'] ?? '');
        $location = trim($_POST['location'] ?? '');
        $result = trim($_POST['result'] ?? '');
        $status = trim($_POST['status'] ?? 'scheduled');

        if ($matchId <= 0 || $teamId <= 0 || $opponent === '' || $matchDate === '' || $location === '') {
            die('Invalid match data.');
        }

        $this->matchModel->updateMatch($matchId, $teamId, $opponent, $matchDate, $location, $result, $status);
        $this->redirect(BASE_URL . 'index.php?page=matches');
    }

    public function delete()
    {
        $matchId = (int)($_GET['id'] ?? 0);

        if ($matchId > 0) {
            $this->matchModel->deleteMatch($matchId);
        }

        $this->redirect(BASE_URL . 'index.php?page=matches');
    }
}
