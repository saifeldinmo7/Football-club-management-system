<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Player.php';

class PlayerController extends Controller
{
    private $playerModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->requireLogin();
        $this->playerModel = new Player();
    }

    public function index()
    {

       

        $search = $_GET['search'] ?? '';
        $teamId = $_GET['teamId'] ?? '';
        $position = $_GET['position'] ?? '';

        $players = $this->playerModel->getAllPlayers($search, $teamId, $position);
        $teams = $this->playerModel->getTeams();

        $this->view('players/index', [
            'players' => $players,
            'teams' => $teams,
            'search' => $search,
            'selectedTeam' => $teamId,
            'selectedPosition' => $position
        ]);
    }

    public function create()
    {
        $teams = $this->playerModel->getTeams();

        $this->view('players/create', [
            'teams' => $teams
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect(BASE_URL . 'index.php?page=players');
        }

        $name = trim($_POST['name'] ?? '');
        $age = (int) ($_POST['age'] ?? 0);
        $position = trim($_POST['position'] ?? '');
        $shirtNumber = (int) ($_POST['shirtNumber'] ?? 0);
        $fitnessStatus = trim($_POST['fitnessStatus'] ?? '');
        $performanceScore = (int) ($_POST['performanceScore'] ?? 0);
        $teamId = (int) ($_POST['teamId'] ?? 0);

        if (
            $name === '' ||
            $age <= 0 ||
            $position === '' ||
            $shirtNumber <= 0 ||
            $fitnessStatus === '' ||
            $performanceScore < 0 ||
            $performanceScore > 100 ||
            $teamId <= 0
        ) {
            $teams = $this->playerModel->getTeams();

            $this->view('players/create', [
                'teams' => $teams,
                'error' => 'Please enter valid player data. Performance score must be between 0 and 100.'
            ]);

            return;
        }

        $this->playerModel->addPlayer(
            $name,
            $age,
            $position,
            $shirtNumber,
            $fitnessStatus,
            $performanceScore,
            $teamId
        );

        $this->redirect(BASE_URL . 'index.php?page=players');
    }

    public function edit()
    {
        $playerId = (int) ($_GET['id'] ?? 0);

        if ($playerId <= 0) {
            $this->redirect(BASE_URL . 'index.php?page=players');
        }

        $player = $this->playerModel->getPlayerById($playerId);
        $teams = $this->playerModel->getTeams();

        if (!$player) {
            die('Player not found.');
        }

        $this->view('players/edit', [
            'player' => $player,
            'teams' => $teams
        ]);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect(BASE_URL . 'index.php?page=players');
        }

        $playerId = (int) ($_POST['playerId'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $age = (int) ($_POST['age'] ?? 0);
        $position = trim($_POST['position'] ?? '');
        $shirtNumber = (int) ($_POST['shirtNumber'] ?? 0);
        $fitnessStatus = trim($_POST['fitnessStatus'] ?? '');
        $performanceScore = (int) ($_POST['performanceScore'] ?? 0);
        $teamId = (int) ($_POST['teamId'] ?? 0);

        if (
            $playerId <= 0 ||
            $name === '' ||
            $age <= 0 ||
            $position === '' ||
            $shirtNumber <= 0 ||
            $fitnessStatus === '' ||
            $performanceScore < 0 ||
            $performanceScore > 100 ||
            $teamId <= 0
        ) {
            die('Invalid player data.');
        }

        $this->playerModel->updatePlayer(
            $playerId,
            $name,
            $age,
            $position,
            $shirtNumber,
            $fitnessStatus,
            $performanceScore,
            $teamId
        );

        $this->redirect(BASE_URL . 'index.php?page=players');
    }

    public function delete()
    {
        $playerId = (int) ($_GET['id'] ?? 0);

        if ($playerId > 0) {
            $this->playerModel->deletePlayer($playerId);
        }

        $this->redirect(BASE_URL . 'index.php?page=players');
    }
}