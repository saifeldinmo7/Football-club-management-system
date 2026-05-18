<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Coach.php';

class CoachController extends Controller
{
    private $coachModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->requireLogin();
        $this->coachModel = new Coach();
    }

    public function index()
    {
        $coaches = $this->coachModel->getAllCoaches();

        $this->view('coaches/index', [
            'coaches' => $coaches
        ]);
    }

    public function create()
    {
        $teams = $this->coachModel->getTeams();

        $this->view('coaches/create', [
            'teams' => $teams
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect(BASE_URL . 'index.php?page=coaches');
        }

        $name = trim($_POST['name'] ?? '');
        $age = (int) ($_POST['age'] ?? 0);
        $phone = trim($_POST['phone'] ?? '');
        $specialization = trim($_POST['specialization'] ?? '');
        $teamId = (int) ($_POST['teamId'] ?? 0);

        if ($name === '' || $age <= 0 || $phone === '' || $specialization === '' || $teamId <= 0) {
            $teams = $this->coachModel->getTeams();

            $this->view('coaches/create', [
                'teams' => $teams,
                'error' => 'Please enter valid coach data.'
            ]);

            return;
        }

        $this->coachModel->addCoach($name, $age, $phone, $specialization, $teamId);

        $this->redirect(BASE_URL . 'index.php?page=coaches');
    }

    public function edit()
    {
        $coachId = (int) ($_GET['id'] ?? 0);

        if ($coachId <= 0) {
            $this->redirect(BASE_URL . 'index.php?page=coaches');
        }

        $coach = $this->coachModel->getCoachById($coachId);
        $teams = $this->coachModel->getTeams();

        if (!$coach) {
            die('Coach not found.');
        }

        $this->view('coaches/edit', [
            'coach' => $coach,
            'teams' => $teams
        ]);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect(BASE_URL . 'index.php?page=coaches');
        }

        $coachId = (int) ($_POST['coachId'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $age = (int) ($_POST['age'] ?? 0);
        $phone = trim($_POST['phone'] ?? '');
        $specialization = trim($_POST['specialization'] ?? '');
        $teamId = (int) ($_POST['teamId'] ?? 0);

        if ($coachId <= 0 || $name === '' || $age <= 0 || $phone === '' || $specialization === '' || $teamId <= 0) {
            die('Invalid coach data.');
        }

        $this->coachModel->updateCoach($coachId, $name, $age, $phone, $specialization, $teamId);

        $this->redirect(BASE_URL . 'index.php?page=coaches');
    }

    public function delete()
    {
        $coachId = (int) ($_GET['id'] ?? 0);

        if ($coachId > 0) {
            $this->coachModel->deleteCoach($coachId);
        }

        $this->redirect(BASE_URL . 'index.php?page=coaches');
    }
}