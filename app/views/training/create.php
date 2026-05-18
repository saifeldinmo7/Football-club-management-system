<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Training Session - Football Club Management System</title>
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
        <h1>Add Training Session</h1>

        <?php if (isset($error)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=training&action=store" class="form-box">
            <div class="form-group">
                <label>Coach</label>
                <select name="coachId" required>
                    <option value="">Select Coach</option>
                    <?php while ($coach = $coaches->fetch_assoc()): ?>
                        <option value="<?php echo $coach['coachId']; ?>">
                            <?php echo htmlspecialchars($coach['name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
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

            <div class="form-group">
                <label>Session Date</label>
                <input type="date" name="sessionDate" required>
            </div>

            <div class="form-group">
                <label>Duration</label>
                <input type="text" name="duration" placeholder="Example: 90 mins" required>
            </div>

            <div class="form-group">
                <label>Focus Area</label>
                <input type="text" name="focusArea" required>
            </div>

            <div class="form-group">
                <label>Notes</label>
                <textarea name="notes"></textarea>
            </div>

            <button type="submit" class="btn-primary">Add Session</button>
        </form>
    </main>
</div>

</body>
</html>