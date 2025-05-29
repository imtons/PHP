<?php
require_once 'vendor/autoload.php';

use Lazer\Classes\Database;

define('LAZER_DATA_PATH', __DIR__ . '/data/');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    $contact = Database::table('contacts')->find($id);

    $contact->name = $_POST['name'];
    $contact->email = $_POST['email'];
    $contact->phone = $_POST['phone'];
    $contact->save();

    header('Location: index.php');
    exit;
}
?>
