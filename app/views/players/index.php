<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Players - Football Club Management System</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body>

<div class="layout">
    <aside class="sidebar">
        <h2>FCMS</h2>

        <ul>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=dashboard">Dashboard</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=players">Players</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=matches">Matches</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=lineup">Lineup</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=logout">Logout</a></li>
        </ul>
    </aside>

    <main class="content">
        <h1>Players</h1>

        <a class="btn-primary small-btn" href="<?php echo BASE_URL; ?>index.php?page=players&action=create">
            Add Player
        </a>

        <form method="GET" action="<?php echo BASE_URL; ?>index.php" class="filter-form">
            <input type="hidden" name="page" value="players">

            <input type="text" name="search" placeholder="Search by name"
                   value="<?php echo htmlspecialchars($search ?? ''); ?>">

            <select name="teamId">
                <option value="">All Teams</option>
                <?php while ($team = $teams->fetch_assoc()): ?>
                    <option value="<?php echo $team['teamId']; ?>"
                        <?php echo ((string)($selectedTeam ?? '') === (string)$team['teamId']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($team['teamName']); ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <select name="position">
                <option value="">All Positions</option>
                <option value="Forward" <?php echo ($selectedPosition ?? '') === 'Forward' ? 'selected' : ''; ?>>Forward</option>
                <option value="Midfielder" <?php echo ($selectedPosition ?? '') === 'Midfielder' ? 'selected' : ''; ?>>Midfielder</option>
                <option value="Defender" <?php echo ($selectedPosition ?? '') === 'Defender' ? 'selected' : ''; ?>>Defender</option>
                <option value="Goalkeeper" <?php echo ($selectedPosition ?? '') === 'Goalkeeper' ? 'selected' : ''; ?>>Goalkeeper</option>
            </select>

            <button type="submit" class="btn-primary">Filter</button>
        </form>

        <table class="data-table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Position</th>
                <th>Shirt No.</th>
                <th>Fitness</th>
                <th>Score</th>
                <th>Team</th>
                <th>Actions</th>
            </tr>

            <?php if ($players && $players->num_rows > 0): ?>
                <?php while ($row = $players->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['playerId']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['age']); ?></td>
                        <td><?php echo htmlspecialchars($row['position']); ?></td>
                        <td><?php echo htmlspecialchars($row['shirtNumber']); ?></td>
                        <td><?php echo htmlspecialchars($row['fitnessStatus']); ?></td>
                        <td><?php echo htmlspecialchars($row['performanceScore']); ?></td>
                        <td><?php echo htmlspecialchars($row['teamName'] ?? 'No Team'); ?></td>
                        <td>
                            <a href="<?php echo BASE_URL; ?>index.php?page=players&action=edit&id=<?php echo $row['playerId']; ?>">Edit</a>
                            |
                            <a href="<?php echo BASE_URL; ?>index.php?page=players&action=delete&id=<?php echo $row['playerId']; ?>"
                               onclick="return confirm('Are you sure you want to delete this player?');">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">No players found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </main>
</div>

</body>
</html>