<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Match</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <h2>FCMS</h2>
            <ul>
                <li><a href="<?php echo BASE_URL; ?>index.php?page=dashboard">Dashboard</a></li>
                <li><a href="<?php echo BASE_URL; ?>index.php?page=matches">Matches</a></li>
                <li><a href="<?php echo BASE_URL; ?>index.php?page=logout">Logout</a></li>
            </ul>
        </aside>

        <main class="content">
            <div class="form-container">
                <h1>Edit Match</h1>

                <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=matches&action=update">
                    <input type="hidden" name="matchId" value="<?php echo htmlspecialchars($match['matchId']); ?>">

                    <div class="form-group">
                        <label>Team</label>
                        <select name="teamId" required>
                            <?php foreach ($teams as $team): ?>
                                <option value="<?php echo $team['teamId']; ?>" <?php echo ($team['teamId'] == $match['teamId']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($team['teamName']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Opponent</label>
                        <input type="text" name="opponent" value="<?php echo htmlspecialchars($match['opponent']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="matchDate" value="<?php echo htmlspecialchars($match['matchDate']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" name="location" value="<?php echo htmlspecialchars($match['location'] ?? ''); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Result</label>
                        <input type="text" name="result" value="<?php echo htmlspecialchars($match['result'] ?? ''); ?>" placeholder="Example: 2-1">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status">
                            <option value="scheduled" <?php echo ($match['status'] === 'scheduled') ? 'selected' : ''; ?>>Scheduled</option>
                            <option value="completed" <?php echo ($match['status'] === 'completed') ? 'selected' : ''; ?>>Completed</option>
                            <option value="cancelled" <?php echo ($match['status'] === 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-primary">Update Match</button>
                    <a href="<?php echo BASE_URL; ?>index.php?page=matches" class="btn-secondary">Cancel</a>
                </form>
            </div>
        </main>
    </div>

    <script src="<?php echo BASE_URL; ?>js/main.js"></script>
</body>
</html>
