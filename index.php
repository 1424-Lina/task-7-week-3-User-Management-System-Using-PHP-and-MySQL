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
        body {
            background-color: #ffe6f0; /* وردي فاتح */
            direction: rtl;
            font-family: Arial, sans-serif;
            color: black;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        input, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        button {
            background-color: gray; /* زر الإرسال رمادي */
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: center;
        }

        a {
            color: black; /* كلمة تبديل باللون الأسود */
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>نموذج إضافة مستخدم</h2>
    <form method="POST" action="">
        <input type="text" name="name" placeholder="الاسم" required>
        <input type="number" name="age" placeholder="العمر" required>
        <button type="submit">إرسال</button>
    </form>

    <h2>قائمة المستخدمين</h2>
    <table>
        <thead>
            <tr>
                <th>المعرف</th>
                <th>الاسم</th>
                <th>العمر</th>
                <th>الحالة</th>
                <th>تبديل</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= $row['age'] ?></td>
                    <td><?= $row['status'] ? "مفعل ✅" : "غير مفعل ❌" ?></td>
                    <td>
                        <a href="toggle.php?id=<?= $row['id'] ?>">تبديل</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>