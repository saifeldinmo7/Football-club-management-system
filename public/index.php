<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';

$page = $_GET['page'] ?? 'login';
$action = $_GET['action'] ?? 'index';

$authController = new AuthController();

if ($page === 'login') {

    if ($action === 'submit') {
        $authController->login();
    } else {
        $authController->showLogin();
    }

} elseif ($page === 'dashboard') {

    $authController->dashboard();

} elseif ($page === 'logout') {

    $authController->logout();

} elseif ($page === 'players') {

    require_once __DIR__ . '/../app/controllers/PlayerController.php';

    $playerController = new PlayerController();

    if ($action === 'create') {
        $playerController->create();
    } elseif ($action === 'store') {
        $playerController->store();
    } elseif ($action === 'edit') {
        $playerController->edit();
    } elseif ($action === 'update') {
        $playerController->update();
    } elseif ($action === 'delete') {
        $playerController->delete();
    } else {
        $playerController->index();
    }

} elseif ($page === 'matches') {

    require_once __DIR__ . '/../app/controllers/MatchController.php';

    $matchController = new MatchController();

    if ($action === 'create') {
        $matchController->create();
    } elseif ($action === 'store') {
        $matchController->store();
    } elseif ($action === 'edit') {
        $matchController->edit();
    } elseif ($action === 'update') {
        $matchController->update();
    } elseif ($action === 'delete') {
        $matchController->delete();
    } else {
        $matchController->index();
    }

} elseif ($page === 'lineup') {

    require_once __DIR__ . '/../app/controllers/LineupController.php';

    $lineupController = new LineupController();

    if ($action === 'create') {
        $lineupController->create();
    } elseif ($action === 'store') {
        $lineupController->store();
    } elseif ($action === 'delete') {
        $lineupController->delete();
    } else {
        $lineupController->show();
    }
} elseif ($page === 'coaches') {

    require_once __DIR__ . '/../app/controllers/CoachController.php';

    $coachController = new CoachController();

    if ($action === 'create') {
        $coachController->create();
    } elseif ($action === 'store') {
        $coachController->store();
    } elseif ($action === 'edit') {
        $coachController->edit();
    } elseif ($action === 'update') {
        $coachController->update();
    } elseif ($action === 'delete') {
        $coachController->delete();
    } else {
        $coachController->index();
    }
  } elseif ($page === 'training') {

    require_once __DIR__ . '/../app/controllers/TrainingController.php';

    $trainingController = new TrainingController();

    if ($action === 'create') {
        $trainingController->create();
    } elseif ($action === 'store') {
        $trainingController->store();
    } elseif ($action === 'edit') {
        $trainingController->edit();
    } elseif ($action === 'update') {
        $trainingController->update();
    } elseif ($action === 'delete') {
        $trainingController->delete();
    } else {
        $trainingController->index();
    }

    } elseif ($page === 'teams') {

    require_once __DIR__ . '/../app/controllers/TeamController.php';

    $teamController = new TeamController();

    if ($action === 'create') {
        $teamController->create();
    } elseif ($action === 'store') {
        $teamController->store();
    } elseif ($action === 'edit') {
        $teamController->edit();
    } elseif ($action === 'update') {
        $teamController->update();
    } elseif ($action === 'delete') {
        $teamController->delete();
    } else {
        $teamController->index();
    }
}else {

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        header('Location: ' . BASE_URL . 'index.php?page=login');
        exit();
    }

    echo "<h1>Page under development</h1>";
    echo "<p>The page <strong>" . htmlspecialchars($page) . "</strong> will be implemented by another team member.</p>";
    echo "<a href='" . BASE_URL . "index.php?page=dashboard'>Back to Dashboard</a>";
}