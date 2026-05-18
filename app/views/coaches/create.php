<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Coach - Football Club Management System</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body>

<div class="layout">
    <aside class="sidebar">
        <h2>FCMS</h2>

        <ul>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=dashboard">Dashboard</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=coaches">Coaches</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=logout">Logout</a></li>
        </ul>
    </aside>

    <main class="content">
        <h1>Add Coach</h1>

        <?php if (isset($error)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=coaches&action=store" class="form-box">
            <div class="form-group">
                <label>Coach Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Age</label>
                <input type="number" name="age" required>
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" required>
            </div>

            <div class="form-group">
                <label>Specialization</label>
                <input type="text" name="specialization" required>
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

            <button type="submit" class="btn-primary">Add Coach</button>
        </form>
    </main>
</div>

</body>
</html>