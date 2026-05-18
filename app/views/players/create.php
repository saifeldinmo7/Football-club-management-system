<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Player - Football Club Management System</title>
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
        <h1>Add Player</h1>

        <?php if (isset($error)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=players&action=store" class="form-box">
            <div class="form-group">
                <label>Player Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Age</label>
                <input type="number" name="age" required>
            </div>

            <div class="form-group">
                <label>Position</label>
                <select name="position" required>
                    <option value="">Select Position</option>
                    <option value="Forward">Forward</option>
                    <option value="Midfielder">Midfielder</option>
                    <option value="Defender">Defender</option>
                    <option value="Goalkeeper">Goalkeeper</option>
                </select>
            </div>

            <div class="form-group">
                <label>Shirt Number</label>
                <input type="number" name="shirtNumber" required>
            </div>

            <div class="form-group">
                <label>Fitness Status</label>
                <select name="fitnessStatus" required>
                    <option value="">Select Fitness Status</option>
                    <option value="Fit">Fit</option>
                    <option value="Injured">Injured</option>
                    <option value="Recovering">Recovering</option>
                </select>
            </div>

            <div class="form-group">
                <label>Performance Score</label>
                <input type="number" name="performanceScore" min="0" max="100" required>
            </div>

            <div class="form-group">
                <label>Team</label>
                <select name="teamId" required>
                    <option value="">Select Team</option>
                    <?php while ($team = $teams->fetch_assoc()): ?>
                        <option value="<?php echo $team['teamId']; ?>">
                            <?php echo htmlspecialchars($team['teamName']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button type="submit" class="btn-primary">Add Player</button>
        </form>
    </main>
</div>

</body>
</html>