<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Lineup.php';
require_once __DIR__ . '/../../config/config.php';

class LineupController extends Controller
{
    private $lineupModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->lineupModel = new Lineup();
        $this->requireLogin();
    }

    public function create()
    {
        $matches = $this->lineupModel->getAllMatches();
        $coaches = $this->lineupModel->getCoaches();
        $selectedMatchId = (int)($_GET['matchId'] ?? 0);

        $this->view('lineup/create', [
            'matches' => $matches,
            'coaches' => $coaches,
            'selectedMatchId' => $selectedMatchId
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect(BASE_URL . 'index.php?page=lineup&action=create');
        }

        $matchId = (int)($_POST['matchId'] ?? 0);
        $coachId = (int)($_POST['coachId'] ?? 0);
        $position = trim($_POST['position'] ?? '');
        $isStarting = isset($_POST['isStarting']) ? 1 : 0;

        if ($matchId <= 0 || $coachId <= 0 || $position === '') {
            $matches = $this->lineupModel->getAllMatches();
            $coaches = $this->lineupModel->getCoaches();
            $this->view('lineup/create', [
                'matches' => $matches,
                'coaches' => $coaches,
                'selectedMatchId' => $matchId,
                'error' => 'Please select match, coach, and position.'
            ]);
            return;
        }

        $this->lineupModel->addLineupEntry($matchId, $coachId, $position, $isStarting);
        $this->redirect(BASE_URL . 'index.php?page=lineup&action=show&matchId=' . $matchId);
    }

    public function show()
    {
        $matchId = (int)($_GET['matchId'] ?? 0);
        $matches = $this->lineupModel->getAllMatches();
        $lineup = $matchId > 0 ? $this->lineupModel->getLineupByMatch($matchId) : [];

        $this->view('lineup/show', [
            'matches' => $matches,
            'lineup' => $lineup,
            'selectedMatchId' => $matchId
        ]);
    }

    public function delete()
    {
        $lineupId = (int)($_GET['id'] ?? 0);
        $matchId = (int)($_GET['matchId'] ?? 0);

        if ($lineupId > 0) {
            $this->lineupModel->removeLineupEntry($lineupId);
        }

        $this->redirect(BASE_URL . 'index.php?page=lineup&action=show&matchId=' . $matchId);
    }
}
