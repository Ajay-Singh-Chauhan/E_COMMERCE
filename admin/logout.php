<?php
require("connection_inc.php");
session_start();
unset($_SESSION['A_L']);
unset($_SESSION['name']);
session_destroy();
header("Location: $host/admin/login.php");
?>
