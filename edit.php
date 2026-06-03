<?php
require_once 'db.php';
$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: exhibits.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM exhibits WHERE exhibit_id = ?");
$stmt->execute([$id]);
$exhibit = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("UPDATE exhibits SET name = :name, origin = :origin, period = :period, status = :status WHERE exhibit_id = :id");
    $stmt->execute([
        'name' => $_POST['name'],
        'origin' => $_POST['origin'],
        'period' => $_POST['period'],
        'status' => $_POST['status'],
        'id' => $id
    ]);
    header('Location: exhibits.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>David Korunoski - Museum DB</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Exhibit Details</h1>
        <form method="POST">
            <label>Exhibit Name:</label>
            <input type="text" name="name" value="<?= htmlentities($exhibit['name']) ?>">
            
            <label>Origin Country:</label>
            <input type="text" name="origin" value="<?= htmlentities($exhibit['origin']) ?>">
            
            <label>Historical Period:</label>
            <input type="text" name="period" value="<?= htmlentities($exhibit['period']) ?>">
            
            <label>Current Status:</label>
            <select name="status">
                <option value="On Display" <?= $exhibit['status'] == 'On Display' ? 'selected' : '' ?>>On Display</option>
                <option value="Stored" <?= $exhibit['status'] == 'Stored' ? 'selected' : '' ?>>Stored</option>
            </select>
            
            <div style="margin-top: 10px;">
                <button type="submit">Update Details</button>
                <a href="exhibits.php" style="margin-left: 15px; color: #7f8c8d;">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>