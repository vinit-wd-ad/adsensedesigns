<?php
require_once "../../setting.php";

// Priority Update AJAX Handler
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_priority') {
    header('Content-Type: application/json');

    if (!isset($_SESSION['admin_role']) || !isset($_SESSION['admin_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized access.']);
        exit;
    }

    $clientId = isset($_POST['client_id']) ? intval($_POST['client_id']) : 0;
    $priority = isset($_POST['priority']) ? intval($_POST['priority']) : 0;

    if ($clientId > 0) {
        $db = new Database('portfolio_client');
        
        // Correct Usage: $data and $where arrays
        $data = ['priority' => $priority];
        $where = ['id' => $clientId];

        $updatedRows = $db->update($data, $where);

        if ($updatedRows !== false) {
            echo json_encode(['status' => 'success', 'message' => 'Priority updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update database.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid Client ID.']);
    }
    exit;
}