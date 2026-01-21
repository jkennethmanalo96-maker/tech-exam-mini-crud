<?php
session_start();
require __DIR__ . '/../db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
    die('Invalid CSRF token');
}

$id = $_POST['id'] ?? null;

if (!$id || !ctype_digit($id)) {
    die('Invalid ID');
}

$stmt = $pdo->prepare("DELETE FROM songs WHERE id = ?");
$stmt->execute([$id]);

header('Location: index.php');
exit;
