<?php

require_once 'vendor/autoload.php';

use Lazer\Classes\Database;
use Lazer\Classes\Helpers\Validate;
use Lazer\Classes\LazerException;

define('LAZER_DATA_PATH', __DIR__ . '/data/');

try {
    Validate::table('contacts')->exists();
    echo " Bảng 'contacts' đã tồn tại.\n";
} catch (LazerException $e) {
    Database::create('contacts', [
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string'
    ]);
    echo " Đã tạo bảng 'contacts' thành công.\n";
}
