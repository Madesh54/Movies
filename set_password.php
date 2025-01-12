<?php
// Only allow admin or authorized users to access this page
session_start();


// Initialize variables
$password = '';
$expiryTime = '';
$errorMessage = '';
$successMessage = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $expiryTime = $_POST['expiry_time'];

    // Validate inputs
    if (!is_numeric($password)) {
        $errorMessage = "Password must be a number.";
    } elseif (!is_numeric($expiryTime) || $expiryTime <= 0) {
        $errorMessage = "Expiry time must be a positive number (in minutes).";
    } else {
        // Calculate expiry time (current time + expiry time in minutes)
        $expiryDate = new DateTime();
        $expiryDate->modify("+$expiryTime minutes");
        $expiryDateString = $expiryDate->format('Y-m-d\TH:i:s');

        // Store password and expiry time in JSON file
        $passwordData = [
            'password' => $password,
            'expiry_time' => $expiryDateString
        ];

        // Save to password.json
        if (file_put_contents('app/data/password/password.json', json_encode($passwordData))) {
            $successMessage = "Password and expiry time successfully updated.";
        } else {
            $errorMessage = "Failed to save password data.";
        }
		// Save to app/password.json
if (file_put_contents('app/data/password/password1.json', json_encode($passwordData))) {
    $successMessage = "Password and expiry time successfully updated in app.";
} else {
    $errorMessage = "Failed to save password data in app.";
}
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
        }
        .container {
            width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-size: 1.1em;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.2em;
        }
        .form-group button:hover {
            background-color: #45a049;
        }
        .message {
            text-align: center;
            margin-top: 20px;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Set New Password</h2>

    <!-- Display any error or success messages -->
    <?php if ($errorMessage): ?>
        <div class="message error"><?php echo htmlspecialchars($errorMessage); ?></div>
    <?php endif; ?>
    <?php if ($successMessage): ?>
        <div class="message success"><?php echo htmlspecialchars($successMessage); ?></div>
    <?php endif; ?>

    <form action="set_password.php" method="POST">
        <div class="form-group">
            <label for="password">New Password (Numeric):</label>
            <input type="text" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>" required>
        </div>
        <div class="form-group">
            <label for="expiry_time">Expiry Time (in minutes):</label>
            <input type="text" id="expiry_time" name="expiry_time" value="<?php echo htmlspecialchars($expiryTime); ?>" required>
        </div>
        <div class="form-group">
            <button type="submit">Set Password</button>
        </div>
    </form>
</div>

</body>
</html>
