<?php
require_once __DIR__ . '/../src/ContactManager.php';

$contactManager = new ContactManager();
$id = $_GET['id'] ?? null;

if ($id !== null) {
    $contactManager->deleteContact($id);
}

header('Location: index.php');
exit;
