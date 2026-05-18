<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Football Club Management System</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body>

    <div class="layout">
        <aside class="sidebar">
            <h2>FCMS</h2>

            <ul>
                <li><a href="<?php echo BASE_URL; ?>index.php?page=dashboard">Dashboard</a></li>

                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <li><a href="<?php echo BASE_URL; ?>index.php?page=teams">Teams</a></li>
                    <li><a href="<?php echo BASE_URL; ?>index.php?page=players">Players</a></li>
                    <li><a href="<?php echo BASE_URL; ?>index.php?page=coaches">Coaches</a></li>
                    <li><a href="<?php echo BASE_URL; ?>index.php?page=matches">Matches</a></li>
                    <li><a href="<?php echo BASE_URL; ?>index.php?page=training">Training</a></li>
                    <li><a href="<?php echo BASE_URL; ?>index.php?page=lineup">Lineup</a></li>
                <?php endif; ?>

                <?php if ($_SESSION['role'] === 'coach'): ?>
                    <li><a href="<?php echo BASE_URL; ?>index.php?page=players">Players</a></li>
                    <li><a href="<?php echo BASE_URL; ?>index.php?page=matches">Matches</a></li>
                    <li><a href="<?php echo BASE_URL; ?>index.php?page=training">Training</a></li>
                    <li><a href="<?php echo BASE_URL; ?>index.php?page=lineup">Lineup</a></li>
                <?php endif; ?>

                <?php if ($_SESSION['role'] === 'player'): ?>
                    <li><a href="<?php echo BASE_URL; ?>index.php?page=matches">Matches</a></li>
                    <li><a href="<?php echo BASE_URL; ?>index.php?page=training">Training</a></li>
                <?php endif; ?>

                <li><a href="<?php echo BASE_URL; ?>index.php?page=logout">Logout</a></li>
            </ul>
        </aside>

        <main class="content">
            <h1><?php echo htmlspecialchars($_SESSION['dashboard_title']); ?></h1>

            <p>Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
            <p>Your role is: <strong><?php echo htmlspecialchars($_SESSION['role']); ?></strong></p>

            <div class="cards">
                <div class="card">
                    <h3>Teams</h3>
                    <p>Manage football teams.</p>
                </div>

                <div class="card">
                    <h3>Players</h3>
                    <p>Manage players and performance.</p>
                </div>

                <div class="card">
                    <h3>Matches</h3>
                    <p>Schedule and view matches.</p>
                </div>

                <div class="card">
                    <h3>Training</h3>
                    <p>Manage training sessions.</p>
                </div>
            </div>
        </main>
    </div>

</body>
</html>