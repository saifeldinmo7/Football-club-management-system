<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Training Session - Football Club Management System</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body>

<div class="layout">
    <aside class="sidebar">
        <h2>FCMS</h2>

        <ul>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=dashboard">Dashboard</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=training">Training</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=logout">Logout</a></li>
        </ul>
    </aside>

    <main class="content">
        <h1>Edit Training Session</h1>

        <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=training&action=update" class="form-box">
            <input type="hidden" name="sessionId" value="<?php echo $session['sessionId']; ?>">

            <div class="form-group">
                <label>Coach</label>
                <select name="coachId" required>
                    <?php while ($coach = $coaches->fetch_assoc()): ?>
                        <option value="<?php echo $coach['coachId']; ?>"
                            <?php echo $session['coachId'] == $coach['coachId'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($coach['name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Team</label>
                <select name="teamId" required>
                    <?php while ($team = $teams->fetch_assoc()): ?>
                        <option value="<?php echo $team['teamId']; ?>"
                            <?php echo $session['teamId'] == $team['teamId'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($team['teamName']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Session Date</label>
                <input type="date" name="sessionDate" value="<?php echo htmlspecialchars($session['sessionDate']); ?>" required>
            </div>

            <div class="form-group">
                <label>Duration</label>
                <input type="text" name="duration" value="<?php echo htmlspecialchars($session['duration']); ?>" required>
            </div>

            <div class="form-group">
                <label>Focus Area</label>
                <input type="text" name="focusArea" value="<?php echo htmlspecialchars($session['focusArea']); ?>" required>
            </div>

            <div class="form-group">
                <label>Notes</label>
                <textarea name="notes"><?php echo htmlspecialchars($session['notes']); ?></textarea>
            </div>

            <button type="submit" class="btn-primary">Update Session</button>
        </form>
    </main>
</div>

</body>
</html>