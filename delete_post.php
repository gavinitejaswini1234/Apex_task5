<?php
session_start();
include 'db.php';

if ($_SESSION['role'] !== 'admin') {
    die('Access Denied');
}

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    header("Location: index.php");
}
?>
