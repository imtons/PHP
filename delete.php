<?php
require_once 'vendor/autoload.php';

use Lazer\Classes\Database;

define('LAZER_DATA_PATH', __DIR__ . '/data/');

if (isset($_GET['id'])) {
    $id = (int) $_GET['id']; 

    $contact = Database::table('contacts')->find($id);
    $contact->delete();

    header('Location: index.php');
    exit();
}
?>
