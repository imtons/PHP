<?php

require_once 'vendor/autoload.php';

use Lazer\Classes\Helpers\Validate;
use Lazer\Classes\LazerException;
use Lazer\Classes\Database;

define('LAZER_DATA_PATH', __DIR__ . '/data/');

$chars = range('A', 'Z');
$chars[] = 'others';

foreach ($chars as $ch) {
    $tableName = 'contacts_' . $ch;

    try {
        // Kiểm tra nếu bảng đã tồn tại
        Validate::table($tableName)->exists();
        echo "Bảng '$tableName' đã tồn tại.<br>";
    } catch (LazerException $e) {
        // Nếu chưa tồn tại thì tạo bảng mới với định nghĩa đơn giản
        try {
            Database::create($tableName, [
                'name' => 'string',
                'email' => 'string',
                'phone' => 'string'
            ]);
            echo "Đã tạo bảng '$tableName' thành công.<br>";
        } catch (Exception $ex) {
            echo "Lỗi khi tạo bảng '$tableName': " . $ex->getMessage() . "<br>";
        }
    }
}
