<?php
session_start();

// Redirect to login if no user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
// Load password and expiry data from the password.json
$passwordData = json_decode(file_get_contents('app/data/password/password.json'), true) ?? [];

// Check if password data exists
if (!isset($passwordData['password']) || !isset($passwordData['expiry_time'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

// Validate session password against the stored password
if ($_SESSION['user'] != $passwordData['password']) {
    // Destroy session if the password doesn't match
    session_destroy();
    header('Location: index.php');
    exit;
}

// Check if the password has expired
$currentTime = new DateTime();
$expiryTime = new DateTime($passwordData['expiry_time']);

// If the password has expired, destroy session and redirect to login
if ($currentTime > $expiryTime) {
    session_destroy();
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html> 
<html> 
<head> 
<title>hello</title> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    

 <style> body { background-color:black; } .alignleft{ float:left; margin-left:3px;
 margin-top:10px;
 color:white; font-weight:bold; font-size:14px; } 
 
 .alignleftt{ float:left; margin-left:10px; color:red; font-weight:bold; font-size:30px; } 
 
 .alignright{ float:right; margin-right:10px; color:white;
 margin-top:9px;
 text-align:center ;
 line-height:130%;
 border-radius:4px;
 width:17%;
 background-color: #FF0000;
 font-size:15px; font-weight:10px ; } 
 
 h4{ margin-left:5px; color:silver; font-weight:bold; font-size:15px; }
 
 .nta { position:relative ; overflow:hidden ; } div.scrollmenu { background-color: black; overflow: auto; white-space: nowrap; position:relative ; overflow-y:hidden ; } div.scrollmenu a { display: inline-block; color: white; text-align:center; padding: 4px; text-decoration: none; } div.scrollmenu a:hover { background-color: black; } .cen{ position:relative ; text-align:center; color:white; } .centered{ font-size:14px; font-weight:bold; position:absolute ; top:80%; left: 50%; transform:translate(-50%,-50%) } .cent{ font-size:auto; position:absolute ; top:95%; left: 50%; transform:translate(-50%,-50%) } .nt{ width: 105px; border-radius: 5px; height: 150px ; z-index:1; } 
 
 .mnt{ width: 120px; border-radius: 2px; height: 80px; }
 
  .nnt{ width: 99px; border-radius: 2px; height: 40px; }
  
  .nntt{ width: 96%; border-radius: 6px; height: 55px; }
 
  .bty{ width: 135px; border-radius: 2px; height: 100px; }
 
 .bottom-left {
  position: absolute;
  bottom: -20px;
  left: -80;
  font-size:15px;
  font-weight:bold;
}
 
 
</style>


<style>


/* stylos para ajustar el carousel */
.carousel.pointer-event {
    touch-action: pan-y;
    width: 100%;
    height: %;
    
}
.carousel-inner {
    position: relative;
    width: 100%;
    height: ;
    overflow: hidden;
}
.carousel-item {
    width: 100%;
    padding: 0px 0px;
    height: 210px;
}
.carousel-item img {
    width: 100%;
    height: 210px;
    object-fit: ;
    padding: 0px;
    border-radius: 0px;
}



/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 13px;
  padding: 10px 14px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: Left;
  font-weight: bold;
  text-shadow: 2px 2px 4px black;
}


.textt {
  color: #f2f2f2;
  font-size: 10px;
  padding: 0px 14px;
  position: absolute;
  bottom: 4px;
  width: 100%;
  text-align: Left;
  font-weight: normal;
  text-shadow: 2px 2px 4px black;
}


.texttt {
  color: #f2f2f2;
  font-size: 10px;
  padding: 20px 14px;
  position: absolute;
  bottom: 15px;
  width: 100%;
  text-align: Left;
  font-weight: normal;
  text-shadow: 2px 2px 3px black;
}


.textttt {
  img-size: 0px;
  padding: 10px 0px;
  position: absolute;
  bottom: 5px;
  width: 28px;
  height: 45px;
  img-align: ;
  
}
h2 {
  text-align: center;
}

.hello, .world {
  animation: colorChange 3s infinite; /* Applies the color change animation */
}

.hello {
  font-size: 30px;
}

.world {
  font-size: 30px;
}

@keyframes colorChange {
  0% {
    color: red; /* Starting color */
  }
  25% {
    color: orange;
  }
  50% {
    color: yellow;
  }
  75% {
    color: green;
  }
  100% {
    color: blue; /* Ending color */
  }
}



</style>


</head>

<body> 
<h2>
  <span class="hello">HELLO</span> 
  <span class="world">WORLD</span>
</h2>

<?php
// Read the data from the JSON file
$jsonFile = 'app/data/carousel_data.json';
$data = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];
?>

<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php foreach ($data as $index => $item): ?>
            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                <a class="<?php echo $item['class_name']; ?>" href="<?php echo $item['href_link']; ?>">
                    <img src="<?php echo $item['img_url']; ?>" alt="carousel image">
                    <div class="texttt"></div>
                    <div class="text"></div>
                    <div class="textt"></div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>


</div></div><br>

<div class="scrollmenu">
    
<a href="app/index.php"> <img class="nnt" src="https://i.ibb.co/6RHvc74/tamil.jpg">
<a href="app/index.php"> <img class="nnt" src="https://i.ibb.co/5R9qL8C/hindi.jpg">
<a href="app/index.php"> <img class="nnt" src="https://i.ibb.co/G2fPkLk/telugu.jpg">
<a href="app/index.php"> <img class="nnt" src="https://i.ibb.co/M5dRMw3/kannada.jpg">

</a></div> </div><p>
<br>

<?php
// File to read stored data from
$dataFile = 'app/data/data.json';

// Function to read data from the JSON file
function getDataFromJsonFile($file) {
    // If the file exists, read and decode the content
    if (file_exists($file)) {
        return json_decode(file_get_contents($file), true);
    } else {
        return [];
    }
}

// Get the data from the JSON file
$data = getDataFromJsonFile($dataFile);
?>
<?php foreach ($data as $entry): ?>
    <div class="nta">
        <a href="<?php echo htmlspecialchars($entry['ntaHref']); ?>">
            <h4 class="alignleftt">|</h4>
            <h4 class="alignleft"><?php echo htmlspecialchars($entry['text1']); ?></h4>
            <h4 class="alignright">See All</h4>
        </a>
    </div>

    <!-- Displaying Scrollmenu Entries -->
    <div class="scrollmenu">
        <?php 
        // Loop through all scrollmenuHref and scrollmenuImg pairs dynamically
        $i = 1;
        while (isset($entry['scrollmenuHref'.$i]) && isset($entry['scrollmenuImg'.$i])): 
        ?>
            <a href="video_player.php?url=<?php echo urlencode($entry['scrollmenuHref'.$i]); ?>">
                <div class="cen ag">
                    <img class="nt" src="<?php echo htmlspecialchars($entry['scrollmenuImg'.$i]); ?>" alt="Image">
                </div>
            </a>
        <?php 
            $i++;
        endwhile; 
        ?>
    </div>
<?php endforeach; ?>
<br>

 <br>


<script id="wpcp_disable_selection" type="text/javascript">
//<![CDATA[
var image_save_msg='You Can Not Save images!';
	var no_menu_msg='Context Menu disabled!';
	var smessage = "Content is protected !!";

function disableEnterKey(e)
{
	if (e.ctrlKey){
     var key;
     if(window.event)
          key = window.event.keyCode;     //IE
     else
          key = e.which;     //firefox (97)
    //if (key != 17) alert(key);
     if (key == 97 || key == 65 || key == 67 || key == 99 || key == 88 || key == 120 || key == 26 || key == 85  || key == 86 || key == 83 || key == 43)
     {
          show_wpcp_message('You are not allowed to copy content or view source');
          return false;
     }else
     	return true;
     }
}

function disable_copy(e)
{	
	var elemtype = e.target.nodeName;
	var isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);
	elemtype = elemtype.toUpperCase();
	var checker_IMG = '';
	if (elemtype == "IMG" && checker_IMG == 'checked' && e.detail >= 2) {show_wpcp_message(alertMsg_IMG);return false;}
	if (elemtype != "TEXT" && elemtype != "TEXTAREA" && elemtype != "INPUT" && elemtype != "PASSWORD" && elemtype != "SELECT" && elemtype != "OPTION" && elemtype != "EMBED")
	{
		if (smessage !== "" && e.detail == 2)
			show_wpcp_message(smessage);
		
		if (isSafari)
			return true;
		else
			return false;
	}	
}
function disable_copy_ie()
{,
	var elemtype = window.event.srcElement.nodeName;
	elemtype = elemtype.toUpperCase();
	if (elemtype == "IMG") {show_wpcp_message(alertMsg_IMG);return false;}
	if (elemtype != "TEXT" && elemtype != "TEXTAREA" && elemtype != "INPUT" && elemtype != "PASSWORD" && elemtype != "SELECT" && elemtype != "OPTION" && elemtype != "EMBED")
	{
		//alert(navigator.userAgent.indexOf('MSIE'));
			//if (smessage !== "") show_wpcp_message(smessage);
		return false;
	}
}	
function reEnable()
{
	return true;
}
document.onkeydown = disableEnterKey;
document.onselectstart = disable_copy_ie;
if(navigator.userAgent.indexOf('MSIE')==-1)
{
	document.onmousedown = disable_copy;
	document.onclick = reEnable;
}
function disableSelection(target)
{
    //For IE This code will work
    if (typeof target.onselectstart!="undefined")
    target.onselectstart = disable_copy_ie;
    
    //For Firefox This code will work
    else if (typeof target.style.MozUserSelect!="undefined")
    {target.style.MozUserSelect="none";}
    
    //All other  (ie: Opera) This code will work
    else
    target.onmousedown=function(){return false}
    target.style.cursor = "default";
}
//Calling the JS function directly just after body load
window.onload = function(){disableSelection(document.body);};
//]]>
</script>
	<script id="wpcp_disable_Right_Click" type="text/javascript">
	//<![CDATA[
	document.ondragstart = function() { return false;}
	/* ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	Disable context menu on images by GreenLava Version 1.0
	^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ */
	    function nocontext(e) {
	       return false;
	    }
	    document.oncontextmenu = nocontext;
	//]]>
	</script>
<style>
.unselectable
{
-moz-user-select:none;
-webkit-user-select:none;
cursor: default;
}
html
{
-webkit-touch-callout: none;
-webkit-user-select: none;
-khtml-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
-webkit-tap-highlight-color: rgba(0,0,0,0);
}
</style>
<script id="wpcp_css_disable_selection" type="text/javascript">
var e = document.getElementsByTagName('body')[0];
if(e)
{
	e.setAttribute('unselectable',on);
}
</script></div>


</body></html>
