<?php

require_once __DIR__ . '/vendor/autoload.php'; // Autoload từ Composer

define('LAZER_DATA_PATH', __DIR__ . '/data'); // Đường dẫn đến thư mục lưu JSON

use Lazer\Classes\Database as Lazer;

// Nếu bảng chưa tồn tại thì tạo mới
try {
    \Lazer\Classes\Helpers\Validate::table('users')->exists();
} catch (\Lazer\Classes\LazerException $e) {
    Lazer::create('users', [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string'
    ]);
}

// Thêm bản ghi
$user = Lazer::table('users');
$user->name = 'Nguyen Van A';
$user->email = 'a@example.com';
$user->save();

// Lấy dữ liệu
$rows = Lazer::table('users')->findAll();
foreach ($rows as $row) {
    echo $row->id . ': ' . $row->name . ' (' . $row->email . ')' . PHP_EOL;
}
