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

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');

if (!$name || !$email || !$phone) {
    die("Vui lòng nhập đầy đủ thông tin.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Email không hợp lệ.");
}

$table = getTableForName($name);

try {
    $contact = Database::table($table);
    $contact->insert([
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
    ]);
} catch (Exception $e) {
    die("Lỗi khi lưu liên hệ: " . $e->getMessage());
}

header('Location: index.php');
exit;
