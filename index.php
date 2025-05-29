<?php

require_once 'vendor/autoload.php';

use Lazer\Classes\Database;

define('LAZER_DATA_PATH', __DIR__ . '/data/');

try {
    $contacts = Database::table('contacts')->findAll();
} catch (Exception $e) {
    die("Lỗi: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Quản lý danh bạ</title>
     <link rel="icon" href="image.png" type="image/svg+xml" />

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f8;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        a.add-btn {
            display: inline-block;
            margin-bottom: 15px;
            padding: 10px 20px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        a.add-btn:hover {
            background: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f0f4f8;
        }
        tr:hover {
            background-color: #f9fcff;
        }
        a.action-btn {
            margin-right: 10px;
            text-decoration: none;
            color: #007bff;
            font-weight: 600;
        }
        a.action-btn:hover {
            text-decoration: underline;
        }
        .no-data {
            text-align: center;
            padding: 30px 0;
            color: #777;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-book-half" viewBox="0 0 16 16" style="vertical-align: middle; margin-right: 8px;">
    <path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
  </svg>
  Quản lý danh bạ
</h1>


        <a class="add-btn" href="add.php">+ Thêm liên hệ mới</a>

        <?php if (count($contacts) === 0): ?>
            <div class="no-data">Chưa có liên hệ nào trong danh bạ.</div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contacts as $contact): ?>
                        <tr>
                            <td><?= htmlspecialchars($contact->name) ?></td>
                            <td><?= htmlspecialchars($contact->email) ?></td>
                            <td><?= htmlspecialchars($contact->phone) ?></td>
                            <td>
                                <a class="action-btn" href="edit.php?id=<?= $contact->id ?>">Sửa</a>
                                <a class="action-btn" href="delete.php?id=<?= $contact->id ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa liên hệ này?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
