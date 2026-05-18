<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Team - Football Club Management System</title>
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
        <h1>Add Team</h1>

        <?php if (isset($error)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=teams&action=store" class="form-box">
            <div class="form-group">
                <label>Team Name</label>
                <input type="text" name="teamName" required>
            </div>

            <div class="form-group">
                <label>Category</label>
                <select name="category" required>
                    <option value="">Select Category</option>
                    <option value="Senior">Senior</option>
                    <option value="Youth">Youth</option>
                    <option value="U21">U21</option>
                    <option value="U18">U18</option>
                </select>
            </div>

            <button type="submit" class="btn-primary">Add Team</button>
        </form>
    </main>
</div>

</body>
</html>