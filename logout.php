<?php


session_start();
session_unset();
session_destroy();

echo "You are now logged out.&nbsp;&nbsp; ";
echo "<a href = 'index.php'>Visit The Nip Shoppe</a>";
?>
