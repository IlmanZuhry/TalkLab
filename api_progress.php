<?php
require_once 'core.php';
if (session_status() == PHP_SESSION_NONE) session_start();

header('Content-Type: application/json');

$app = new manz();
$app->ensureSession();
$currentUser = $app->getCurrentUser();

if (!$currentUser) {
    http_response_code(401);
    echo json_encode(['status' => false, 'message' => 'Anda harus login']);
    exit;
}

$action = $_POST['action'] ?? '';
$materialId = $_POST['material_id'] ?? '';

if (empty($materialId)) {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Material ID tidak ditemukan']);
    exit;
}

if ($action === 'get_progress') {
    $progress = $app->getMaterialProgress($currentUser['Id_User'], $materialId);
    echo json_encode([
        'status' => true,
        'progress' => $progress
    ]);
    exit;
}

if ($action === 'save_progress') {
    $progress = $_POST['progress'] ?? 0;
    $result = $app->saveMaterialProgress($currentUser['Id_User'], $materialId, $progress);
    
    if ($result) {
        echo json_encode([
            'status' => true,
            'message' => 'Progress berhasil disimpan',
            'progress' => $progress
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => false, 'message' => 'Gagal menyimpan progress']);
    }
    exit;
}

http_response_code(400);
echo json_encode(['status' => false, 'message' => 'Action tidak dikenali']);
