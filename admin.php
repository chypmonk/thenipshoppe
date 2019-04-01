<?php

session_start();
$customizestring = file_get_contents ("customize.txt");
$customizearray = explode ("%%%", $customizestring);
$loggedin = false;
if (isset($_SESSION['admin'])) {    
   if ($_SESSION['admin'] === $customizearray [0]) { 
        $loggedin = true;      
   }
}
if ($loggedin === false ) {
    header("Location: login.php"); exit; 
}          

$section = "";
if (isset ($_GET['section'])) {
    $section = $_GET['section'];
}
?>
 
<!DOCTYPE html>
<html>
<head>
<!--    Lila Avenue One Page -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">  
   <title>'The Nip Shoppe'</title> 
   <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Elsie" rel="stylesheet">      
   <link rel= 'stylesheet' type='text/css' href= 'style.css'> 
</head> 
<body>
    <main class = 'admin'> 
        <div class = 'title'><a href = 'index.php'>The Nip Shoppe</a></div>
        <br><br><br>
        <h2>Admin Page - Select section to edit</h2>  
        <a class = 'button' href = 'admin.php?section=left-sidebar'>Left Sidebar</a>
        <a class = 'button' href = 'admin.php?section=center'>Center Content</a>
        <a class = 'button' href = 'admin.php?section=right-sidebar'>Right Sidebar</a>
        <a class = 'button' href = 'index.php'>View Website</a>
    
        <?php 
        if ($section !== "") {
            $sectiontext = file_get_contents ("page-sections/" . $section . ".txt");

            if ($_SERVER ["REQUEST_METHOD"] == "POST" ) {  
               if (isset ($_POST['sectiontext'])) {
                   $sectiontext = $_POST['sectiontext'];
                   file_put_contents ("page-sections/" . $section . ".txt", $sectiontext);
               }
            }

            echo "<h2>Edit " . ucwords(str_replace ("-"," ", $section)) . "</h2>";
            echo "<form method = 'post' action = 'admin.php?section=" . $section . "'>";
            echo "<textarea name = 'sectiontext' rows = '10' cols = '60' >"  . ($sectiontext) . "</textarea>";
            echo "<br><br><input class = 'button' type = 'submit' name = 'submit' value='Publish'/>";
            echo "</form>";
        }             
       
        if ($loggedin === true) {                     
            echo "<br><br><a href = 'logout.php'>Log Out </a>";
        }        
        ?>
       <br><br><br>Copyright &copy; <?php echo  date('Y'); ?> Susan Rodgers, <a href = 'https://lilaavenue.com'>Lila Avenue</a>
       <br><br><a href = 'login.php'>***</a>  
        
    </main>    
</body>
</html>
        