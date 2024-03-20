<?php
require "dbh/conn.php";
session_start();
if(!isset($_SESSION['user_id']) || !isset($_SESSION['email'])) {
    header("Location: {$BASE_URL}/login.php");
}
session_unset();
session_destroy();

header("Location: ".$BASE_URL);
exit();