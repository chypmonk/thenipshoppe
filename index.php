<?php
session_start();
$customizestring = file_get_contents ("customize.txt");
$customizearray = explode ("%%%", $customizestring);
$loggedin = false;
if (isset($_SESSION['admin'])) {    
   if ( $_SESSION['admin'] === $customizearray [0]) { 
       $loggedin =  true;
   }
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
    <main> 
        <div class = 'title'><a href = 'index.php'>The Nip Shoppe</a></div> 
        <div class = 'headerwrap'>
            <div class = 'header'>               
                <div class = 'description'>For All Your Catnip Needs </div>
            </div>
        </div>
        <div class = 'sidebar-column'>
            <?php echo  nl2br (file_get_contents ("page-sections/left-sidebar.txt"));?>           
        
        </div><div class = 'content-column'>
            <?php echo  nl2br (file_get_contents ("page-sections/center.txt"));?>    
            
        </div><div class = 'sidebar-column'>
            <?php echo  nl2br (file_get_contents ("page-sections/right-sidebar.txt"));?>               
        </div>        
        
        
        <?php        
        if ($loggedin === true) {
            echo "<a class = 'button' href = 'admin.php'>Administrative Page</a><br><br>";            
            echo "<a href = 'logout.php'>Log Out </a><br><br>";
        }        
        ?>
        <br><br><br>Copyright &copy; <?php echo  date('Y'); ?> Susan Rodgers, <a href = 'https://lilaavenue.com'>Lila Avenue</a>
       <br><br><a href = 'login.php'>***</a>
       
    </main>    
</body>
</html>
        