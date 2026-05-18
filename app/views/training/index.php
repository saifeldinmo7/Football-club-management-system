<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Training Sessions - Football Club Management System</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body>

<div class="layout">
    <aside class="sidebar">
        <h2>FCMS</h2>

        <ul>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=dashboard">Dashboard</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=coaches">Coaches</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=training">Training</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php?page=logout">Logout</a></li>
        </ul>
    </aside>

    <main class="content">
        <h1>Training Sessions</h1>

        <a class="btn-primary small-btn" href="<?php echo BASE_URL; ?>index.php?page=training&action=create">
            Add Training Session
        </a>

        <table class="data-table">
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Duration</th>
                <th>Focus Area</th>
                <th>Coach</th>
                <th>Team</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>

            <?php if ($sessions && $sessions->num_rows > 0): ?>
                <?php while ($row = $sessions->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['sessionId']; ?></td>
                        <td><?php echo htmlspecialchars($row['sessionDate']); ?></td>
                        <td><?php echo htmlspecialchars($row['duration']); ?></td>
                        <td><?php echo htmlspecialchars($row['focusArea']); ?></td>
                        <td><?php echo htmlspecialchars($row['coachName'] ?? 'No Coach'); ?></td>
                        <td><?php echo htmlspecialchars($row['teamName'] ?? 'No Team'); ?></td>
                        <td><?php echo htmlspecialchars($row['notes']); ?></td>
                        <td>
                            <a href="<?php echo BASE_URL; ?>index.php?page=training&action=edit&id=<?php echo $row['sessionId']; ?>">Edit</a>
                            |
                            <a href="<?php echo BASE_URL; ?>index.php?page=training&action=delete&id=<?php echo $row['sessionId']; ?>"
                               onclick="return confirm('Are you sure you want to delete this training session?');">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No training sessions found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </main>
</div>

</body>
</html>