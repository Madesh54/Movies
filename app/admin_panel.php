<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: admin.php');
    exit;
}
// Define the JSON file path
$jsonFile = 'data/carousel_data.json';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the data from the form
    $className = $_POST['class_name'];
    $hrefLink = $_POST['href_link'];
    $imgUrl = $_POST['img_url'];

    // Read the existing data from JSON file
    if (file_exists($jsonFile)) {
        $data = json_decode(file_get_contents($jsonFile), true);
    } else {
        $data = [];
    }

    // Add the new item to the data
    $data[] = [
        'class_name' => $className,
        'href_link' => $hrefLink,
        'img_url' => $imgUrl
    ];

    // Save the updated data back to the JSON file
    file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT));
}

// Check if a remove request is made
if (isset($_GET['remove'])) {
    // Read the existing data from JSON file
    if (file_exists($jsonFile)) {
        $data = json_decode(file_get_contents($jsonFile), true);
    } else {
        $data = [];
    }

    // Remove the item from the data
    $classToRemove = $_GET['remove'];
    foreach ($data as $key => $item) {
        if ($item['class_name'] == $classToRemove) {
            unset($data[$key]);
            break;
        }
    }

    // Save the updated data back to the JSON file
    file_put_contents($jsonFile, json_encode(array_values($data), JSON_PRETTY_PRINT));
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>

<body>
<div class="header">
    <h1><span>Admin</span> <span>Panel</span></h1>
	<a href="adminlogout.php" class="logout-button">Logout</a>
	</div>
    <form method="POST">
        <label for="class_name">Class Name (e.g., item1, item2, etc.):</label>
        <input type="text" id="class_name" name="class_name" required><br><br>

        <label for="href_link">Href Link:</label>
        <input type="url" id="href_link" name="href_link" required><br><br>

        <label for="img_url">Image URL:</label>
        <input type="url" id="img_url" name="img_url" required><br><br>

        <button type="submit">Save</button>
		
		<br>
		<button type="submit" onclick="window.location.href='admin_movies.php';" class="save-button">Add Movies</button>
		</br>

    </form>
	<h2>History</h2>
    <ul>
        <?php
        // Read the existing data from JSON file
        if (file_exists($jsonFile)) {
            $data = json_decode(file_get_contents($jsonFile), true);
            foreach ($data as $item) {
                echo '<li>';
                echo 'Class: ' . $item['class_name'] . ' | ';
                echo 'Link: <a href="' . $item['href_link'] . '" target="_blank">Go to link</a> | ';
                echo 'Image: <img src="' . $item['img_url'] . '" alt="image" width="100" height="100"> ';
                echo '<a href="?remove=' . $item['class_name'] . '">Remove</a>';
                echo '</li>';
            }
        } else {
            echo '<li>No items found.</li>';
        }
        ?>
    </ul>
	<style>
	/* Header styling */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #333;
    color: white;
    position: relative;
}

/* h1 styling */
.header h1 {
    font-size: 24px;
    font-weight: bold;
    margin: 0;
    text-align: center;
    width: 100%;
    color: #fff; /* White color for the main heading */
}

/* Logout button styling */
.logout-button {
    text-decoration: none;
    font-size: 16px;
    color: #fff;
    background-color: #FF5733;
    padding: 8px 16px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    position: absolute;
    right: 20px;
}

.logout-button:hover {
    background-color: #c13e29;
}
	.save-button {
  margin-bottom: 20px; /* Adds space below the button */
  padding: 10px 20px;  /* Adds padding inside the button */
  font-size: 16px;     /* Sets the font size */
  background-color: #4CAF50; /* Green background */
  color: white;        /* White text color */
  border: none;        /* Removes border */
  cursor: pointer;     /* Changes cursor to pointer on hover */
  border-radius: 5px;  /* Rounded corners */
  transition: background-color 0.3s ease; /* Smooth background change */
}

.save-button:hover {
  background-color: #45a049; /* Darker green when hovered */
}

	/* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    margin-top: 20px;
    font-size: 36px;
}

h1 span {
    color: #3498db; /* Blue color for first part */
}

h1 span:nth-child(2) {
    color: #e74c3c; /* Red color for second part */
}

h1 span:nth-child(3) {
    color: #2ecc71; /* Green color for third part */
}

form {
    background-color: #fff;
    border-radius: 8px;
    padding: 20px;
    max-width: 500px;
    margin: 20px auto;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

label {
    font-size: 16px;
    color: #333;
    display: block;
    margin-bottom: 8px;
}

input[type="text"], input[type="url"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
    box-sizing: border-box;
    transition: border-color 0.3s ease; /* Smooth transition for border color */
}

input[type="text"]:focus, input[type="url"]:focus {
    border-color: #3498db; /* Highlight border with blue color */
    outline: none; /* Remove default focus outline */
    box-shadow: 0 0 5px rgba(52, 152, 219, 0.5); /* Add a soft blue glow effect */
}


button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
}

button:hover {
    background-color: #45a049;
}

button:active {
    background-color: #3e8e41;
}
/* History Section */
h2 {
    text-align: center;
    color: #333;
    margin-top: 30px;
    font-size: 1.8em;
}

ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
    width: 80%;
    max-width: 600px;
    margin: 20px auto;
}

ul li {
    background-color: #fff;
    padding: 15px;
    margin-bottom: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 4px;
}

ul li a {
    color: #007BFF;
    text-decoration: none;
    margin-left: 10px;
}

ul li a:hover {
    text-decoration: underline;
}

ul li img {
    margin-left: 10px;
    border-radius: 4px;
}

/* Remove Link Styling */
ul li a[href*="remove"] {
    color: #dc3545;
    font-weight: bold;
}

ul li a[href*="remove"]:hover {
    text-decoration: underline;
}

	</style>
</div>
</body>
</html>
