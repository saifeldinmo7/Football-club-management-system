<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lineup - Football Club Management System</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <h2>FCMS</h2>
            <ul>
                <li><a href="<?php echo BASE_URL; ?>index.php?page=dashboard">Dashboard</a></li>
                <li><a href="<?php echo BASE_URL; ?>index.php?page=matches">Matches</a></li>
                <li><a href="<?php echo BASE_URL; ?>index.php?page=lineup&action=show">Lineup</a></li>
                <li><a href="<?php echo BASE_URL; ?>index.php?page=logout">Logout</a></li>
            </ul>
        </aside>

        <main class="content">
            <div class="page-header">
                <h1>Match Lineup</h1>
                <a class="btn-primary btn-link" href="<?php echo BASE_URL; ?>index.php?page=lineup&action=create<?php echo $selectedMatchId ? '&matchId=' . $selectedMatchId : ''; ?>">+ Add Lineup Entry</a>
            </div>

            <form method="GET" action="<?php echo BASE_URL; ?>index.php" class="filter-form">
                <input type="hidden" name="page" value="lineup">
                <input type="hidden" name="action" value="show">
                <label>Select Match</label>
                <select name="matchId" onchange="this.form.submit()">
                    <option value="">Choose match</option>
                    <?php foreach ($matches as $match): ?>
                        <option value="<?php echo $match['matchId']; ?>" <?php echo ($selectedMatchId == $match['matchId']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars(($match['teamName'] ?? 'Team') . ' vs ' . $match['opponent'] . ' - ' . $match['matchDate']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>

            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Match</th>
                            <th>Coach</th>
                            <th>Position</th>
                            <th>Starting</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($lineup)): ?>
                            <?php foreach ($lineup as $entry): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($entry['lineupId']); ?></td>
                                    <td><?php echo htmlspecialchars($entry['opponent'] . ' - ' . $entry['matchDate']); ?></td>
                                    <td><?php echo htmlspecialchars($entry['coachName'] ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($entry['position'] ?? '-'); ?></td>
                                    <td><?php echo $entry['isStarting'] ? 'Yes' : 'No'; ?></td>
                                    <td>
                                        <a class="text-red" href="<?php echo BASE_URL; ?>index.php?page=lineup&action=delete&id=<?php echo $entry['lineupId']; ?>&matchId=<?php echo $selectedMatchId; ?>">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No lineup entries found for this match.</td>
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
