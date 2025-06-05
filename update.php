<?php
require_once 'vendor/autoload.php';

use Lazer\Classes\Database;

define('LAZER_DATA_PATH', __DIR__ . '/data/');

function getTableForName(string $name): string {
    $firstChar = mb_substr(trim($name), 0, 1);
    $firstChar = mb_strtoupper($firstChar);

    if (!preg_match('/[A-Z]/', $firstChar)) {
        return 'contacts_others';
    }
    return 'contacts_' . $firstChar;
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');

if (!$id || !$name || !$email || !$phone) {
    die("Thiếu dữ liệu bắt buộc.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Email không hợp lệ.");
}

// Các bảng có thể có
$chars = range('A', 'Z');
$chars[] = 'others';

$oldTable = null;
$oldContact = null;

// Tìm bảng chứa contact cũ theo ID
foreach ($chars as $ch) {
    $table = 'contacts_' . $ch;
    try {
        $contact = Database::table($table)->find($id);
        if ($contact) {
            $oldTable = $table;
            $oldContact = $contact;
            break;
        }
    } catch (Exception $e) {
        // Bảng chưa tồn tại, bỏ qua
    }
}

if (!$oldContact) {
    die("Không tìm thấy liên hệ cần cập nhật.");
}

$newTable = getTableForName($name);

try {
    if ($newTable === $oldTable) {
        // Cập nhật trực tiếp trong bảng cũ
        $oldContact->name = $name;
        $oldContact->email = $email;
        $oldContact->phone = $phone;
        $oldContact->save();
    } else {
        // Bảng tên thay đổi, xóa bản ghi cũ, thêm bản ghi mới ở bảng mới
        $oldContact->delete();

        Database::table($newTable)->insert([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ]);
    }
} catch (Exception $e) {
    die("Lỗi cập nhật liên hệ: " . $e->getMessage());
}

header('Location: index.php');
exit;