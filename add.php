<?php
require_once 'vendor/autoload.php';

use Lazer\Classes\Database;
use Lazer\Classes\Helpers\Validate;
use Lazer\Classes\LazerException;

define('LAZER_DATA_PATH', __DIR__ . '/data/');

// Hàm xác định tên bảng từ tên liên hệ
function getTableForName(string $name): string {
    $firstChar = mb_substr(trim($name), 0, 1, 'UTF-8');
    $firstChar = mb_strtoupper($firstChar, 'UTF-8');

    if (!preg_match('/[A-Z]/', $firstChar)) {
        return 'contacts_others';
    }
    return 'contacts_' . $firstChar;
}

// Tạo bảng nếu chưa có
function ensureTableExists(string $table) {
    try {
        Validate::table($table)->exists();
    } catch (LazerException $e) {
        Database::create($table, [
            'name' => 'string',
            'email' => 'string',
            'phone' => 'string'
        ]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    if ($name && $email && $phone) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Email không hợp lệ.");
        }

        $table = getTableForName($name);
        ensureTableExists($table);

        try {
            // Thêm dữ liệu bằng save()
            $record = Database::table($table);
            $record->name = $name;
            $record->email = $email;
            $record->phone = $phone;
            $record->save();

            header("Location: index.php");
            exit;
        } catch (Exception $e) {
            die("Lỗi thêm liên hệ: " . $e->getMessage());
        }
    } else {
        die("Vui lòng nhập đầy đủ thông tin.");
    }
}
?>





<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Thêm liên hệ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        form {
            max-width: 400px;
            background: #fff;
            padding: 25px 30px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-bottom: 15px;
            color: #555;
            font-weight: 600;
        }
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px 12px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus,
        input[type="email"]:focus {
            border-color: #1e90ff;
            outline: none;
        }
        button {
            width: 100%;
            background-color: #1e90ff;
            border: none;
            padding: 12px 0;
            font-size: 1.1em;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }
        button:hover {
            background-color: #1565c0;
        }
    </style>
</head>
<body>
    <h2>Thêm liên hệ</h2>
    <form action="add.php" method="POST">
        <label>Họ tên:
            <input type="text" name="name" required />
        </label>
        <label>Email:
            <input type="email" name="email" required />
        </label>
        <label>SĐT:
            <input type="text" name="phone" required />
        </label>
        <button type="submit">Lưu</button>
    </form>
</body>
</html>
