<?php
session_start();
include 'db.php';

if ($_SESSION['role'] !== 'admin') {
    die('Access Denied');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$_POST['title'], $_POST['content'], $_POST['id']]);
    header("Location: index.php");
}

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $post = $stmt->fetch();
}
?>
<form method="post">
    <input type="hidden" name="id" value="<?= $post['id'] ?>">
    <input type="text" name="title" value="<?= $post['title'] ?>" required><br>
    <textarea name="content" required><?= $post['content'] ?></textarea><br>
    <input type="submit" value="Update">
</form>
