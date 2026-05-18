<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/TrainingSession.php';

class TrainingController extends Controller
{
    private $trainingModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->requireLogin();
        $this->trainingModel = new TrainingSession();
    }

    public function index()
    {
        $sessions = $this->trainingModel->getAllSessions();

        $this->view('training/index', [
            'sessions' => $sessions
        ]);
    }

    public function create()
    {
        $coaches = $this->trainingModel->getCoaches();
        $teams = $this->trainingModel->getTeams();

        $this->view('training/create', [
            'coaches' => $coaches,
            'teams' => $teams
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect(BASE_URL . 'index.php?page=training');
        }

        $coachId = (int) ($_POST['coachId'] ?? 0);
        $teamId = (int) ($_POST['teamId'] ?? 0);
        $sessionDate = trim($_POST['sessionDate'] ?? '');
        $duration = trim($_POST['duration'] ?? '');
        $focusArea = trim($_POST['focusArea'] ?? '');
        $notes = trim($_POST['notes'] ?? '');

        if ($coachId <= 0 || $teamId <= 0 || $sessionDate === '' || $duration === '' || $focusArea === '') {
            $coaches = $this->trainingModel->getCoaches();
            $teams = $this->trainingModel->getTeams();

            $this->view('training/create', [
                'coaches' => $coaches,
                'teams' => $teams,
                'error' => 'Please enter valid training session data.'
            ]);

            return;
        }

        $this->trainingModel->addSession($coachId, $teamId, $sessionDate, $duration, $focusArea, $notes);

        $this->redirect(BASE_URL . 'index.php?page=training');
    }

    public function edit()
    {
        $sessionId = (int) ($_GET['id'] ?? 0);

        if ($sessionId <= 0) {
            $this->redirect(BASE_URL . 'index.php?page=training');
        }

        $session = $this->trainingModel->getSessionById($sessionId);
        $coaches = $this->trainingModel->getCoaches();
        $teams = $this->trainingModel->getTeams();

        if (!$session) {
            die('Training session not found.');
        }

        $this->view('training/edit', [
            'session' => $session,
            'coaches' => $coaches,
            'teams' => $teams
        ]);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect(BASE_URL . 'index.php?page=training');
        }

        $sessionId = (int) ($_POST['sessionId'] ?? 0);
        $coachId = (int) ($_POST['coachId'] ?? 0);
        $teamId = (int) ($_POST['teamId'] ?? 0);
        $sessionDate = trim($_POST['sessionDate'] ?? '');
        $duration = trim($_POST['duration'] ?? '');
        $focusArea = trim($_POST['focusArea'] ?? '');
        $notes = trim($_POST['notes'] ?? '');

        if ($sessionId <= 0 || $coachId <= 0 || $teamId <= 0 || $sessionDate === '' || $duration === '' || $focusArea === '') {
            die('Invalid training session data.');
        }

        $this->trainingModel->updateSession($sessionId, $coachId, $teamId, $sessionDate, $duration, $focusArea, $notes);

        $this->redirect(BASE_URL . 'index.php?page=training');
    }

    public function delete()
    {
        $sessionId = (int) ($_GET['id'] ?? 0);

        if ($sessionId > 0) {
            $this->trainingModel->deleteSession($sessionId);
        }

        $this->redirect(BASE_URL . 'index.php?page=training');
    }
}