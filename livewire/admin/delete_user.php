<?php
session_start();
include '../db_connect.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
$id = intval($_GET['id']);
mysqli_query($conn, "DELETE FROM users WHERE id=$id");
header('Location: manage_users.php');
exit();
