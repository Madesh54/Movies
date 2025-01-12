<?php
// Initialize variables for the form inputs
$ntaHref = $text1 = '';
$scrollmenuData = [];
$dataFile = 'data/data.json';

// Function to save data to the JSON file
function saveToJsonFile($data, $file) {
    if (file_exists($file)) {
        $jsonData = json_decode(file_get_contents($file), true);
    } else {
        $jsonData = [];
    }
    
    // Add new data to the array
    $jsonData[] = $data;
    
    // Write the updated data to the JSON file
    file_put_contents($file, json_encode($jsonData, JSON_PRETTY_PRINT));
}

// Function to remove data from JSON by index
function removeFromJsonFile($index, $file) {
    if (file_exists($file)) {
        $jsonData = json_decode(file_get_contents($file), true);
        // Remove the entry by index
        array_splice($jsonData, $index, 1);
        file_put_contents($file, json_encode($jsonData, JSON_PRETTY_PRINT));
    }
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the input values from the form
    if (isset($_POST['ntaHref'])) {
        $ntaHref = $_POST['ntaHref'];
        $text1 = $_POST['text1'];

        // Prepare scrollmenu data
        $scrollmenuData = [];
        $i = 1;
        while (isset($_POST['scrollmenuHref'.$i]) && isset($_POST['scrollmenuImg'.$i])) {
            $scrollmenuData['scrollmenuHref'.$i] = $_POST['scrollmenuHref'.$i];
            $scrollmenuData['scrollmenuImg'.$i] = $_POST['scrollmenuImg'.$i];
            $i++;
        }

        // Prepare data to be saved
        $data = [
            'ntaHref' => $ntaHref,
            'text1' => $text1,
        ];

        // Merge scrollmenu data
        $data = array_merge($data, $scrollmenuData);

        // Save the data to the JSON file
        saveToJsonFile($data, $dataFile);
    }

    // Check if remove button is clicked and remove the data
    if (isset($_POST['removeIndex'])) {
        $removeIndex = $_POST['removeIndex'];
        removeFromJsonFile($removeIndex, $dataFile);
    }
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

<!-- Admin Panel Form -->
<div class="admin-panel">
    <form method="POST" action="">
        <div class="nta">
            <label for="ntaHref">Enter URL for NTA:</label>
            <input type="text" id="ntaHref" name="ntaHref" value="<?php echo $ntaHref; ?>" required><br>

            <label for="text1">Enter Text for Text1:</label>
            <input type="text" id="text1" name="text1" value="<?php echo $text1; ?>" required><br>

            <button type="submit">Submit NTA Inputs</button>
        </div>

        <div class="scrollmenu">
            <h3>Scrollmenu Entries</h3>
            <div id="scrollmenuInputs">
                <div class="scrollmenu-entry">
                    <label for="scrollmenuHref1">Enter URL for Scrollmenu 1:</label>
                    <input type="text" id="scrollmenuHref1" name="scrollmenuHref1" required><br>

                    <label for="scrollmenuImg1">Enter Image URL for Scrollmenu 1:</label>
                    <input type="text" id="scrollmenuImg1" name="scrollmenuImg1" required><br>
                </div>
            </div>

            <button type="button" onclick="addScrollmenuEntry()">Add Another Scrollmenu</button>
            <button type="submit">Submit Scrollmenu Inputs</button>
        </div>
    </form>
</div>

<!-- Display History and Remove Buttons -->
<div class="history">
    <h2>History of Entries:</h2>
    <?php
    // Load data from JSON file
    if (file_exists($dataFile)) {
        $data = json_decode(file_get_contents($dataFile), true);
        foreach ($data as $index => $entry) {
            echo "<div class='entry'>";
            echo "<p>URL for NTA: <a href='{$entry['ntaHref']}'>{$entry['ntaHref']}</a></p>";
            echo "<p>Text: {$entry['text1']}</p>";

            // Display each scrollmenu entry dynamically
            $scrollmenuCount = 1;
            while (isset($entry['scrollmenuHref'.$scrollmenuCount])) {
                $scrollmenuHref = $entry['scrollmenuHref'.$scrollmenuCount];
                $scrollmenuImg = $entry['scrollmenuImg'.$scrollmenuCount];
                echo "<p>Scrollmenu {$scrollmenuCount} URL: <a href='{$scrollmenuHref}'>{$scrollmenuHref}</a></p>";
                echo "<p>Scrollmenu {$scrollmenuCount} Image: <img src='{$scrollmenuImg}' alt='Image' width='100'></p>";
                $scrollmenuCount++;
            }

            // Remove Button
            echo "<form method='POST' action=''>";
            echo "<input type='hidden' name='removeIndex' value='{$index}'>";
            echo "<button type='submit'>Remove</button>";
            echo "</form>";
            echo "</div><hr>";
        }
    }
    ?>
</div>

<script>
// Function to dynamically add more scrollmenu entries
function addScrollmenuEntry() {
    const index = document.querySelectorAll('.scrollmenu-entry').length + 1;

    const newEntry = document.createElement('div');
    newEntry.classList.add('scrollmenu-entry');
    newEntry.innerHTML = `
        <label for="scrollmenuHref${index}">Enter URL for Scrollmenu ${index}:</label>
        <input type="text" id="scrollmenuHref${index}" name="scrollmenuHref${index}" required><br>

        <label for="scrollmenuImg${index}">Enter Image URL for Scrollmenu ${index}:</label>
        <input type="text" id="scrollmenuImg${index}" name="scrollmenuImg${index}" required><br>
    `;
    
    document.getElementById('scrollmenuInputs').appendChild(newEntry);
}
</script>
<style>
/* Admin Panel Styling */
.admin-panel {
    background-color: #f0f0f0;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.admin-panel form {
    display: flex;
    flex-direction: column;
}

.nta, .scrollmenu {
    margin-bottom: 20px;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"] {
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}

/* Scrollmenu Styling */
.scrollmenu {
    background-color: #f7f7f7;
    padding: 15px;
    border-radius: 8px;
}

.scrollmenu h3 {
    margin-bottom: 10px;
    color: #333;
}

.scrollmenu-entry {
    margin-bottom: 15px;
}

/* History Section Styling */
.history {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-top: 30px;
}

.entry {
    margin-bottom: 20px;
}

/* Button Styling */
button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
    margin-top: 10px;
}

button:hover {
    background-color: #45a049;
}

button:focus {
    outline: none;
}

button[type="submit"] {
    background-color: #007BFF;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

button[type="button"] {
    background-color: #FF5733;
}

button[type="button"]:hover {
    background-color: #c13e1b;
}

</style>
</body>
</html>
