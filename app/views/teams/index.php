<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teams - Football Club Management System</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body>

<div class="layout">
    <aside class="sidebar">
        <h2>FCMS</h2>

        <ul>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=dashboard">Dashboard</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=teams">Teams</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=players">Players</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=coaches">Coaches</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=training">Training</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=matches">Matches</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=lineup">Lineup</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=logout">Logout</a></li>
        </ul>
    </aside>

    <main class="content">
        <h1>Teams</h1>

        <a class="btn-primary small-btn" href="<?php echo BASE_URL; ?>index.php?page=teams&action=create">
            Add Team
        </a>

        <table class="data-table">
            <tr>
                <th>ID</th>
                <th>Team Name</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>

            <?php if ($teams && $teams->num_rows > 0): ?>
                <?php while ($row = $teams->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['teamId']; ?></td>
                        <td><?php echo htmlspecialchars($row['teamName']); ?></td>
                        <td><?php echo htmlspecialchars($row['category']); ?></td>
                        <td>
                            <a href="<?php echo BASE_URL; ?>index.php?page=teams&action=edit&id=<?php echo $row['teamId']; ?>">Edit</a>
                            |
                            <a href="<?php echo BASE_URL; ?>index.php?page=teams&action=delete&id=<?php echo $row['teamId']; ?>"
                               onclick="return confirm('Are you sure you want to delete this team?');">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No teams found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </main>
</div>

</body>
</html>