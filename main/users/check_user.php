<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $query = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['exists' => true]);
    } else {
        echo json_encode(['exists' => false]);
    }
}
