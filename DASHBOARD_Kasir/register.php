<?php
session_start();

// Include the database configuration file
include 'config.php';

// Initialize alert message variable
$alert_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm-password']);

    // Validate input
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $alert_message = "<div class='alert alert-danger'>Semua bidang wajib diisi.</div>";
    } elseif ($password !== $confirm_password) {
        $alert_message = "<div class='alert alert-danger'>Password dan konfirmasi password tidak cocok.</div>";
    } else {
        // Check if username or email already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $alert_message = "<div class='alert alert-danger'>Username atau email sudah terdaftar.</div>";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user into the database with role 'Admin'
            $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'Admin')");
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                // Set success message in session and redirect
                $_SESSION['alert_message'] = "<div class='alert alert-success'>Registrasi berhasil! Anda telah terdaftar sebagai Admin. Silakan login.</div>";
                header("Location: register.php"); // Redirect to the same page
                exit();
            } else {
                $alert_message = "<div class='alert alert-danger'>Terjadi kesalahan saat registrasi. Silakan coba lagi.</div>";
            }
        }
    }
}

// Check for alert message in session
if (isset($_SESSION['alert_message'])) {
    $alert_message = $_SESSION['alert_message'];
    unset($_SESSION['alert_message']); // Clear the message after displaying it
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        .register-card {
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }
        .register-card h2 {
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
        .login-link {
            text-align: center;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <h2>Register</h2>
        <!-- Alert Messages -->
        <?php if ($alert_message): ?>
            <?php echo $alert_message; ?>
        <?php endif; ?>
        <!-- Registration Form -->
        <form id="register-form" method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" required placeholder="Username">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required placeholder="Password">
            </div>
            <div class="mb-3">
                <label for="confirm-password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm-password" id="confirm-password" placeholder="Confirm Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <p class="login-link mt-3">Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
