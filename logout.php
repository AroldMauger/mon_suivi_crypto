<?php

session_start();
 unset($SESSION["role"]);
 header("Location: index.php");
 exit;

?>