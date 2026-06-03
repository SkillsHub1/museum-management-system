<?php
require_once 'db.php';
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $origin = $_POST['origin'];
    $period = $_POST['period'];
    $status = $_POST['status'];

    if (empty($name)) {
        $error = "Name is required";
    } else {
        $stmt = $pdo->prepare("INSERT INTO exhibits (name, origin, period, status) VALUES (:name, :origin, :period, :status)");
        $stmt->execute(['name' => $name, 'origin' => $origin, 'period' => $period, 'status' => $status]);
        header('Location: exhibits.php');
        exit;
    }
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
        <h1>Add New Exhibit</h1>
        <?php if ($error) echo "<p style='color:var(--danger); font-weight:bold;'>$error</p>"; ?>
        
        <form method="POST">
            <label>Exhibit Name:</label>
            <input type="text" name="name" value="<?= htmlentities($_POST['name'] ?? '') ?>" required>
            
            <label>Origin Country:</label>
            <input type="text" name="origin" value="<?= htmlentities($_POST['origin'] ?? '') ?>">
            
            <label>Historical Period:</label>
            <input type="text" name="period" value="<?= htmlentities($_POST['period'] ?? '') ?>">
            
            <label>Current Status:</label>
            <select name="status">
                <option value="On Display">On Display</option>
                <option value="Stored">Stored</option>
            </select>
            
            <div style="margin-top: 10px;">
                <button type="submit">Save Exhibit</button>
                <a href="exhibits.php" style="margin-left: 15px; color: #7f8c8d;">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>