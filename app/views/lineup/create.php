<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Lineup</title>
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
            <div class="form-container">
                <h1>Add Lineup Entry</h1>
                <p class="helper-text">This version follows the current database structure: match, coach, position, and starting status.</p>

                <?php if (isset($error)): ?>
                    <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=lineup&action=store">
                    <div class="form-group">
                        <label>Match</label>
                        <select name="matchId" required>
                            <option value="">Select Match</option>
                            <?php foreach ($matches as $match): ?>
                                <option value="<?php echo $match['matchId']; ?>" <?php echo ($selectedMatchId == $match['matchId']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars(($match['teamName'] ?? 'Team') . ' vs ' . $match['opponent'] . ' - ' . $match['matchDate']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Coach</label>
                        <select name="coachId" required>
                            <option value="">Select Coach</option>
                            <?php foreach ($coaches as $coach): ?>
                                <option value="<?php echo $coach['coachId']; ?>"><?php echo htmlspecialchars($coach['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Position</label>
                        <input type="text" name="position" placeholder="Forward / Midfielder / Defender / Goalkeeper" required>
                    </div>

                    <div class="form-group checkbox-group">
                        <label>
                            <input type="checkbox" name="isStarting" value="1" checked>
                            Starting lineup
                        </label>
                    </div>

                    <button type="submit" class="btn-primary">Save Lineup Entry</button>
                    <a href="<?php echo BASE_URL; ?>index.php?page=lineup&action=show" class="btn-secondary">Cancel</a>
                </form>
            </div>
        </main>
    </div>

    <script src="<?php echo BASE_URL; ?>js/main.js"></script>
</body>
</html>
