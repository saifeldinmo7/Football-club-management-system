<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Team - Football Club Management System</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body>

<div class="layout">
    <aside class="sidebar">
        <h2>FCMS</h2>

        <ul>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=dashboard">Dashboard</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=teams">Teams</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=logout">Logout</a></li>
        </ul>
    </aside>

    <main class="content">
        <h1>Edit Team</h1>

        <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=teams&action=update" class="form-box">
            <input type="hidden" name="teamId" value="<?php echo $team['teamId']; ?>">

            <div class="form-group">
                <label>Team Name</label>
                <input type="text" name="teamName" value="<?php echo htmlspecialchars($team['teamName']); ?>" required>
            </div>

            <div class="form-group">
                <label>Category</label>
                <select name="category" required>
                    <option value="Senior" <?php echo $team['category'] === 'Senior' ? 'selected' : ''; ?>>Senior</option>
                    <option value="Youth" <?php echo $team['category'] === 'Youth' ? 'selected' : ''; ?>>Youth</option>
                    <option value="U21" <?php echo $team['category'] === 'U21' ? 'selected' : ''; ?>>U21</option>
                    <option value="U18" <?php echo $team['category'] === 'U18' ? 'selected' : ''; ?>>U18</option>
                </select>
            </div>

            <button type="submit" class="btn-primary">Update Team</button>
        </form>
    </main>
</div>

</body>
</html>