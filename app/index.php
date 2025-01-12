<?php
session_start();

// Redirect to login if no user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
// Load password and expiry data from the password.json
$passwordData = json_decode(file_get_contents('data/password/password1.json'), true) ?? [];

// Check if password data exists
if (!isset($passwordData['password']) || !isset($passwordData['expiry_time'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}

// Validate session password against the stored password
if ($_SESSION['user'] != $passwordData['password']) {
    // Destroy session if the password doesn't match
    session_destroy();
    header('Location: login.php');
    exit;
}

// Check if the password has expired
$currentTime = new DateTime();
$expiryTime = new DateTime($passwordData['expiry_time']);

// If the password has expired, destroy session and redirect to login
if ($currentTime > $expiryTime) {
    session_destroy();
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies page</title>
    <style>
       body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #2d3e50; /* Light grayish blue background */
}

.scrollmenu {
    display: flex;
    overflow-x: auto;
    white-space: nowrap;
    background-color: #2d3e50; /* Dark blue-gray background */
    padding: 10px;
}

.scrollmenu a {
    text-decoration: none;
    margin-right: 15px;
    display: inline-block;
}

.scrollmenu .cen {
    text-align: center;
    background-color: #ffffff; /* White background for cards */
    border: 2px solid #4caf50; /* Green border for cards */
    border-radius: 8px;
    padding: 10px;
    width: 150px;
    transition: transform 0.3s, border-color 0.3s; /* Smooth hover effect */
}

.scrollmenu .cen:hover {
    transform: scale(1.05); /* Slight zoom on hover */
    border-color: #f44336; /* Change border to red on hover */
}

.scrollmenu img.nt {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

    </style>
</head>
<body>
    <?php
    // File to read stored data from
    $dataFile = 'data/data.json';

    // Function to read data from the JSON file
    function getDataFromJsonFile($file) {
        if (file_exists($file)) {
            return json_decode(file_get_contents($file), true);
        } else {
            return [];
        }
    }

    // Get the data from the JSON file
    $data = getDataFromJsonFile($dataFile);
    ?>
    <div class="scrollmenu">
        <?php 
        // Loop through all data and extract specific keys
        if (!empty($data)) {
            foreach ($data as $entry) {
                $i = 1; // Start with 1 for numbered keys
                while (isset($entry["scrollmenuHref$i"]) && isset($entry["scrollmenuImg$i"])) {
                    $href = $entry["scrollmenuHref$i"];
                    $img = $entry["scrollmenuImg$i"];
                    ?>
                    <a href="video_player.php?url=<?php echo urlencode($href); ?>">
                        <div class="cen ag">
                            <img class="nt" src="<?php echo htmlspecialchars($img); ?>" alt="Image">
                        </div>
                    </a>
                    <?php
                    $i++; // Increment for next numbered key
                }
            }
        } else {
            echo "<p style='color: white;'>No movies not available now (try after some time).</p>";
        }
        ?>
    </div>
</body>
</html>
