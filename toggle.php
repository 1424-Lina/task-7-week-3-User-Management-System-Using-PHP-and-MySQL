<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "user_lina";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// إضافة مستخدم جديد
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $conn->query("INSERT INTO users (name, age, status) VALUES ('$name', $age, 1)");
}

// جلب كل المستخدمين
$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إدارة المستخدمين</title>
    <style>
        body { font-family: Arial; padding: 20px; direction: rtl; }
        input { padding: 5px; }
        button { padding: 5px 10px; margin-right: 5px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
    </style>
</head>
<body>

<h2>إضافة مستخدم جديد</h2>
<form method="POST">
    الاسم: <input type="text" name="name" required>
    العمر: <input type="number" name="age" required>
    <input type="submit" value="إضافة">
</form>

<h3>قائمة المستخدمين</h3>
<table>
    <tr>
        <th>المعرف</th>
        <th>الاسم</th>
        <th>العمر</th>
        <th>الحالة</th>
        <th>تبديل</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= $row['age'] ?></td>
        <td class="status"><?= $row['status'] ? "مفعل ✅" : "غير مفعل ❌" ?></td>
        <td>
        <?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "user_lina";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $res = $conn->query("SELECT status FROM users WHERE id = $id");
    if ($row = $res->fetch_assoc()) {
        $newStatus = $row['status'] == 1 ? 0 : 1;
        $conn->query("UPDATE users SET status = $newStatus WHERE id = $id");
    }
}

// بعد التعديل، أعد التوجيه لصفحة المستخدمين
header("Location: index.php");
exit;