<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Player - Football Club Management System</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body>

<div class="layout">
    <aside class="sidebar">
        <h2>FCMS</h2>

        <ul>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=dashboard">Dashboard</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=players">Players</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=logout">Logout</a></li>
        </ul>
    </aside>

    <main class="content">
        <h1>Edit Player</h1>

        <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=players&action=update" class="form-box">
            <input type="hidden" name="playerId" value="<?php echo $player['playerId']; ?>">

            <div class="form-group">
                <label>Player Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($player['name']); ?>" required>
            </div>

            <div class="form-group">
                <label>Age</label>
                <input type="number" name="age" value="<?php echo htmlspecialchars($player['age']); ?>" required>
            </div>

            <div class="form-group">
                <label>Position</label>
                <select name="position" required>
                    <option value="Forward" <?php echo $player['position'] === 'Forward' ? 'selected' : ''; ?>>Forward</option>
                    <option value="Midfielder" <?php echo $player['position'] === 'Midfielder' ? 'selected' : ''; ?>>Midfielder</option>
                    <option value="Defender" <?php echo $player['position'] === 'Defender' ? 'selected' : ''; ?>>Defender</option>
                    <option value="Goalkeeper" <?php echo $player['position'] === 'Goalkeeper' ? 'selected' : ''; ?>>Goalkeeper</option>
                </select>
            </div>

            <div class="form-group">
                <label>Shirt Number</label>
                <input type="number" name="shirtNumber" value="<?php echo htmlspecialchars($player['shirtNumber']); ?>" required>
            </div>

            <div class="form-group">
                <label>Fitness Status</label>
                <select name="fitnessStatus" required>
                    <option value="Fit" <?php echo $player['fitnessStatus'] === 'Fit' ? 'selected' : ''; ?>>Fit</option>
                    <option value="Injured" <?php echo $player['fitnessStatus'] === 'Injured' ? 'selected' : ''; ?>>Injured</option>
                    <option value="Recovering" <?php echo $player['fitnessStatus'] === 'Recovering' ? 'selected' : ''; ?>>Recovering</option>
                </select>
            </div>

            <div class="form-group">
                <label>Performance Score</label>
                <input type="number" name="performanceScore" min="0" max="100"
                       value="<?php echo htmlspecialchars($player['performanceScore']); ?>" required>
            </div>

            <div class="form-group">
                <label>Team</label>
                <select name="teamId" required>
                    <?php while ($team = $teams->fetch_assoc()): ?>
                        <option value="<?php echo $team['teamId']; ?>"
                            <?php echo $player['teamId'] == $team['teamId'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($team['teamName']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button type="submit" class="btn-primary">Update Player</button>
        </form>
    </main>
</div>

</body>
</html>