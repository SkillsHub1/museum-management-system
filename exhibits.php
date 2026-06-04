<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

require_once 'db.php';

if (isset($_POST['delete_id'])) {
    $stmt = $pdo->prepare("DELETE FROM exhibits WHERE exhibit_id = ?");
    $stmt->execute([$_POST['delete_id']]);
    header('Location: exhibits.php');
    exit;
}

$stmt = $pdo->query("SELECT * FROM exhibits");
$exhibits = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>David Korunoski - Museum DB</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Museum Exhibits Collection</h1>
        
        <div style="margin-bottom: 20px;">
            <a href="add.php" class="btn">Add New Exhibit</a> 
            <span style="margin: 0 10px; color: #ccc;">|</span>
            <a href="logout.php" style="color: #7f8c8d; font-weight: normal;">Logout</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Origin</th>
                    <th>Period</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($exhibits as $row): ?>
                <tr>
                    <td><?= htmlentities($row['exhibit_id']) ?></td>
                    <td><strong><?= htmlentities($row['name']) ?></strong></td>
                    <td><?= htmlentities($row['origin']) ?></td>
                    <td><?= htmlentities($row['period']) ?></td>
                    <td><?= htmlentities($row['status']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['exhibit_id'] ?>" class="btn" style="padding: 5px 15px; font-size: 13px;">Edit</a>
                        
                        <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this exhibit?');">
                            <input type="hidden" name="delete_id" value="<?= $row['exhibit_id'] ?>">
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
