<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Football Club Management System</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body class="login-body">

    <div class="login-container">
        <h1>Football Club Management System</h1>
        <p class="subtitle">Login to continue</p>

        <?php if (isset($error)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=login&action=submit">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label>Role</label>
                <select name="role" required>
                    <option value="">Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="coach">Coach</option>
                    <option value="player">Player</option>
                </select>
            </div>

            <button type="submit" class="btn-primary">Login</button>
        </form>

        <div class="demo-users">
            <p><strong>Demo Users:</strong></p>
            <p>admin1 / admin123 / Admin</p>
            <p>coach_ali / coach123 / Coach</p>
            <p>player_ahmed / player123 / Player</p>
        </div>
    </div>

</body>
</html>
