<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    echo "<p>Please <a href='login.php'>login</a>.</p>";
    exit;
}

$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
?>
<h2>Welcome, <?= $_SESSION['username'] ?> (<?= $_SESSION['role'] ?>)</h2>
<a href="add_post.php">Add Post</a> | <a href="logout.php">Logout</a>
<hr>

<?php foreach ($stmt as $post): ?>
    <div>
        <h3><?= htmlspecialchars($post['title']) ?></h3>
        <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
        <small><?= $post['created_at'] ?></small><br>
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="edit_post.php?id=<?= $post['id'] ?>">Edit</a> |
            <a href="delete_post.php?id=<?= $post['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
