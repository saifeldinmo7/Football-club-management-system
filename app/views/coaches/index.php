<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Coaches - Football Club Management System</title>
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
        <h1>Coaches</h1>

        <a class="btn-primary small-btn" href="<?php echo BASE_URL; ?>index.php?page=coaches&action=create">
            Add Coach
        </a>

        <table class="data-table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Phone</th>
                <th>Specialization</th>
                <th>Team</th>
                <th>Actions</th>
            </tr>

            <?php if ($coaches && $coaches->num_rows > 0): ?>
                <?php while ($row = $coaches->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['coachId']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['age']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['specialization']); ?></td>
                        <td><?php echo htmlspecialchars($row['teamName'] ?? 'No Team'); ?></td>
                        <td>
                            <a href="<?php echo BASE_URL; ?>index.php?page=coaches&action=edit&id=<?php echo $row['coachId']; ?>">Edit</a>
                            |
                            <a href="<?php echo BASE_URL; ?>index.php?page=coaches&action=delete&id=<?php echo $row['coachId']; ?>"
                               onclick="return confirm('Are you sure you want to delete this coach?');">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No coaches found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </main>
</div>

</body>
</html>