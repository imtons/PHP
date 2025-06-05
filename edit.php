<?php
require_once 'vendor/autoload.php';

use Lazer\Classes\Database;

define('LAZER_DATA_PATH', __DIR__ . '/data/');

if (!isset($_GET['id'])) {
    die('Thiếu ID');
}

$id = (int) $_GET['id'];

$chars = range('A', 'Z');
$chars[] = 'others';

$contact = null;
$tableFound = '';

foreach ($chars as $ch) {
    $tableName = 'contacts_' . $ch;

    try {
        $found = Database::table($tableName)->find($id);
        if ($found) {
            $contact = $found;
            $tableFound = $tableName;
            break;
        }
    } catch (Exception $e) {
        // Bỏ qua nếu bảng chưa tồn tại hoặc lỗi
    }
}

if (!$contact) {
    die('Không tìm thấy liên hệ.');
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa liên hệ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f9fc;
            padding: 40px;
        }
        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        label {
            display: block;
            margin-bottom: 15px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Sửa liên hệ</h2>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $contact->id ?>">
            <label>
                Họ tên:
                <input type="text" name="name" value="<?= $contact->name ?>" required>
            </label>
            <label>
                Email:
                <input type="email" name="email" value="<?= $contact->email ?>" required>
            </label>
            <label>
                SĐT:
                <input type="text" name="phone" value="<?= $contact->phone ?>" required>
            </label>
            <button type="submit">Cập nhật</button>
        </form>
    </div>
</body>
</html>
