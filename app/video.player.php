<?php
// Check if the 'url' parameter exists in the query string
if (isset($_GET['url'])) {
    $videoUrl = $_GET['url']; // Get the video URL
} else {
    // Redirect or display an error if no URL is provided
    echo "No video URL specified.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fullscreen Video Player</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #222;
            color: white;
            overflow: hidden; /* Prevent scrolling */
        }

        #plyrDiv {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: black;
        }

        video {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensure the video covers the screen */
        }

        /* Small image aligned to the right side inside the video player */
        .side-image {
            position: absolute;
            top: 41%;
            right: 2%; /* Align closer to the right edge */
            transform: translateY(-50%);
            z-index: 10;
            width: 36px; /* Reduced width */
            height: 36px; /* Reduced height */
            opacity: 0.9;
            pointer-events: none; /* Prevent interaction with the image */
        }

        /* Download icon inside video player */
        .download-overlay {
            position: absolute;
            bottom: 20px;
            right: 20px;
            z-index: 20;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 24px;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .download-overlay i {
            color: white; /* Icon color */
        }

        .download-overlay:hover {
            background: rgba(0, 0, 0, 0.9);
        }
    </style>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Plyr CSS -->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.3/plyr.css" />
</head>
<body>

    <!-- Plyr container -->
    <div id="plyrDiv">
        <!-- Video Player -->
        <video id="plyrVideo" controls>
            <source src="<?php echo htmlspecialchars($videoUrl); ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- Small Image on the right side -->
        <img src="https://i.ibb.co/S72FLBY/IMG-20241225-WA0003.jpg" alt="Side Image" class="side-image" id="sideImage" />

        <!-- Download Icon -->
        <button class="download-overlay" id="downloadBtn">
            <i class="fas fa-download"></i> <!-- Font Awesome icon -->
        </button>
    </div>

    <!-- Plyr Script -->
    <script src="https://cdn.plyr.io/3.7.3/plyr.js"></script>
    <script>
        // Initialize Plyr with the video element
        const plyr = new Plyr('#plyrVideo');

        // Download button functionality
        const downloadBtn = document.getElementById('downloadBtn');
        downloadBtn.addEventListener('click', () => {
            const downloadUrl = "<?php echo htmlspecialchars($videoUrl); ?>"; // Dynamic video URL
            const downloadFileName = "video.mp4"; // File name for download

            const anchor = document.createElement('a');
            anchor.href = downloadUrl;
            anchor.download = downloadFileName;
            anchor.style.display = 'none';
            document.body.appendChild(anchor);
            anchor.click();
            document.body.removeChild(anchor);
        });
    </script>
</body>
</html>
