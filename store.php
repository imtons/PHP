<?php
require_once 'vendor/autoload.php';
use Lazer\Classes\Database;

define('LAZER_DATA_PATH', __DIR__ . '/data/');

$contact = Database::table('contacts');
$contact->name  = $_POST['name'];
$contact->email = $_POST['email'];
$contact->phone = $_POST['phone'];
$contact->save();

header('Location: index.php');
exit;
