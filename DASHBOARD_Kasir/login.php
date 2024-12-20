<?php
session_start();

// Include the database configuration file
include 'config.php';

// Initialize alert message variable
$alert_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($username) || empty($password)) {
        $alert_message = "<div class='alert alert-danger'>Username dan password wajib diisi.</div>";
    } else {
        // Prepare and execute the query to check user credentials
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role']; // Assuming you have a role column

                // Redirect to the dashboard
                header("Location: dashboard.php");
                exit();
            } else {
                $alert_message = "<div class='alert alert-danger'>Username atau password salah.</div>";
            }
        } else {
            $alert_message = "<div class='alert alert-danger'>Username atau password salah.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }
        .login-card {
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }
        .login-card h2 {
            color: #333;
            font-weight: 600;
            text-align: center;
            margin-bottom: 1rem;
        }
        .form-label {
            font-weight: 500;
            color: #555;
        }
        .btn-primary {
            width: 100%;
            font-weight: 600;
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .register-link {
            text-align: center;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Login</h2>
        <div id="alert-message" class="alert">
            <?php if ($alert_message): ?>
                <?php echo $alert_message; ?>
            <?php endif; ?>
        </div>
        <form id="login-form" method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" required placeholder="Username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <p class="register-link mt-3">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
