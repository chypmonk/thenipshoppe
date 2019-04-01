<?php

session_start();
$loggedin = false;
$customizestring = file_get_contents ("customize.txt");
$customizearray = explode ("%%%", $customizestring);
$newusername = $newpassword = "";
if ($_SERVER ["REQUEST_METHOD"] === "POST" ) {  
   
    if (isset ($_POST['submit-change'])) {
        //request to change username and password
        if (isset ($_POST['newusername'])) {
            $newusername = $_POST['newusername'];
            $customizearray[1] = $newusername;
        }
        if (isset ($_POST['newpassword'])) {
            $newpassword = $_POST['newpassword'];
            $customizearray[2] = $newpassword;
        }     
    
        $customizestring = implode ("%%%", $customizearray);
        file_put_contents ("customize.txt", $customizestring);
        
    }
    else {
        // Checks if the user is trying to log in
        if (isset($_POST['username']))	{ 
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING) ;
        }

        if (isset($_POST['password'])) {      
           $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING) ;
        }

        if (trim($username) === $customizearray[1] && trim($password) === $customizearray[2]) { 
            $_SESSION['admin'] = $customizearray[0]; 
            $loggedin = true;
        } 
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
   <link href = "https://fonts.googleapis.com/css?family=Lato:300,300i,400,700|Roboto" rel="inc/stylesheet">    
   <link rel= 'stylesheet' type='text/css' href= 'style.css'> 
</head> 
<body>
    <main class = 'admin'> 
        <div class = 'title'><a href = 'index.php'>The Nip Shoppe</a></div>
        <h1>Log In</h1>        
        <?php        
        if ($loggedin === true) {           
            echo "<h2>You are now logged in</h2><br></div><br>";
            echo "<a class = 'button' href = 'admin.php'>Go to Administrator Page</a><br><br>";
            ?>
            <h3>Optional: Update username and password</h3>
            <form method="post" action="login.php">
               <h3><b>Username:</b>
               <input  type="text"  name="newusername" value = '<?php echo $username; ?>'></h3><br>
               <h3 ><b>Password:</b>
               <input  type="text"  name="newpassword" value = '<?php echo $password; ?>' ></h3><br>
               <input class = 'button' type="submit" value = "Change" name = 'submit-change'>
           </form>
        <?php 
        }
        else {
        ?>
            <h2>Please enter your username and password</h2>

            <form method="post" action="login.php">
               <h3><b>Username:</b>
               <input  type="text"  name="username"value = '<?php echo $customizearray['1']; ?>'> ></h3><br>
               <h3 ><b>Password:</b>
               <input   type="password"  name="password" value = '<?php echo $customizearray['2']; ?>'>></h3><br>
               <input class = 'button' type="submit" value = "Enter" name = 'submit'>
           </form>
      <?php
        }
               
        if ($loggedin === true) {
                 
            echo "<a href = 'logout.php'>Log Out </a>";
        }        
        ?>
        <br><br><br>Copyright &copy; <?php echo  date('Y'); ?> Susan Rodgers, <a href = 'https://lilaavenue.com'>Lila Avenue</a>
        <br><br><a href = 'login.php'>***</a>
        
    </main>
    </body>
</html>
 




   
