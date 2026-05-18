<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schedule Match</title>
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
                <h1>Schedule New Match</h1>

                <?php if (isset($error)): ?>
                    <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=matches&action=store">
                    <div class="form-group">
                        <label>Team</label>
                        <select name="teamId" required>
                            <option value="">Select Team</option>
                            <?php foreach ($teams as $team): ?>
                                <option value="<?php echo $team['teamId']; ?>"><?php echo htmlspecialchars($team['teamName']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Opponent</label>
                        <input type="text" name="opponent" required>
                    </div>

                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="matchDate" required>
                    </div>

                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" name="location" required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status">
                            <option value="scheduled">Scheduled</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-primary">Save Match</button>
                    <a href="<?php echo BASE_URL; ?>index.php?page=matches" class="btn-secondary">Cancel</a>
                </form>
            </div>
        </main>
    </div>

    <script src="<?php echo BASE_URL; ?>js/main.js"></script>
</body>
</html>
