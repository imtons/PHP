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

$deleted = false;

foreach ($chars as $ch) {
    $tableName = 'contacts_' . $ch;

    try {
        $contact = Database::table($tableName)->find($id);
        if ($contact) {
            $contact->delete();
            $deleted = true;
            break;
        }
    } catch (Exception $e) {
        // Bỏ qua lỗi bảng không tồn tại
    }
}

if (!$deleted) {
    die('Không tìm thấy liên hệ để xóa.');
}

header('Location: index.php');
exit();
