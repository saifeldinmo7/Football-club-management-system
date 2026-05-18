<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Coach - Football Club Management System</title>
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
        <h1>Edit Coach</h1>

        <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=coaches&action=update" class="form-box">
            <input type="hidden" name="coachId" value="<?php echo $coach['coachId']; ?>">

            <div class="form-group">
                <label>Coach Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($coach['name']); ?>" required>
            </div>

            <div class="form-group">
                <label>Age</label>
                <input type="number" name="age" value="<?php echo htmlspecialchars($coach['age']); ?>" required>
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($coach['phone']); ?>" required>
            </div>

            <div class="form-group">
                <label>Specialization</label>
                <input type="text" name="specialization" value="<?php echo htmlspecialchars($coach['specialization']); ?>" required>
            </div>

            <div class="form-group">
                <label>Team</label>
                <select name="teamId" required>
                    <?php while ($team = $teams->fetch_assoc()): ?>
                        <option value="<?php echo $team['teamId']; ?>"
                            <?php echo $coach['teamId'] == $team['teamId'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($team['teamName']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button type="submit" class="btn-primary">Update Coach</button>
        </form>
    </main>
</div>

</body>
</html>