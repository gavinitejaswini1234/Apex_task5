?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    $stmt = $pdo->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->execute([$title, $content]);

    header("Location: index.php");
}
?>
<form method="post">
    <input type="text" name="title" required placeholder="Title"><br>
    <textarea name="content" required placeholder="Content"></textarea><br>
    <input type="submit" value="Post">
</form>
