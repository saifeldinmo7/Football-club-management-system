<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Matches - Football Club Management System</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <h2>FCMS</h2>
            <ul>
                <li><a href="<?php echo BASE_URL; ?>index.php?page=dashboard">Dashboard</a></li>
                <li><a href="<?php echo BASE_URL; ?>index.php?page=teams">Teams</a></li>
                <li><a href="<?php echo BASE_URL; ?>index.php?page=players">Players</a></li>
                <li><a href="<?php echo BASE_URL; ?>index.php?page=coaches">Coaches</a></li>
                <li><a href="<?php echo BASE_URL; ?>index.php?page=matches">Matches</a></li>
                <li><a href="<?php echo BASE_URL; ?>index.php?page=training">Training</a></li>
                <li><a href="<?php echo BASE_URL; ?>index.php?page=lineup&action=show">Lineup</a></li>
                <li><a href="<?php echo BASE_URL; ?>index.php?page=logout">Logout</a></li>
            </ul>
        </aside>

        <main class="content">
            <div class="page-header">
                <h1>Matches</h1>
                <a class="btn-primary btn-link" href="<?php echo BASE_URL; ?>index.php?page=matches&action=create">+ Schedule Match</a>
            </div>

            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Team</th>
                            <th>Opponent</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Result</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($matches)): ?>
                            <?php foreach ($matches as $match): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($match['matchId']); ?></td>
                                    <td><?php echo htmlspecialchars($match['teamName'] ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($match['opponent']); ?></td>
                                    <td><?php echo htmlspecialchars($match['matchDate']); ?></td>
                                    <td><?php echo htmlspecialchars($match['location'] ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($match['status']); ?></td>
                                    <td><?php echo htmlspecialchars($match['result'] ?: '-'); ?></td>
                                    <td class="actions">
                                        <a class="text-blue" href="<?php echo BASE_URL; ?>index.php?page=matches&action=edit&id=<?php echo $match['matchId']; ?>">Edit</a>
                                        |
                                        <a class="text-red" href="<?php echo BASE_URL; ?>index.php?page=matches&action=delete&id=<?php echo $match['matchId']; ?>">Delete</a>
                                        |
                                        <a class="text-blue" href="<?php echo BASE_URL; ?>index.php?page=lineup&action=show&matchId=<?php echo $match['matchId']; ?>">Lineup</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8">No matches found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="<?php echo BASE_URL; ?>js/main.js"></script>
</body>
</html>
