<?php
require_once '_db.php';

$json = file_get_contents('php://input');
$params = json_decode($json);

$stmt = $db->prepare('SELECT * FROM admin WHERE admin_name = :admin_name');
$stmt->bindParam(':admin_name', $params->username);
$stmt->execute();
$admin = $stmt->fetch();

$found = $admin !=null;

class Result{}

if (!$found) {
    failed();
}

if (!password_verify($params->password, $admin['password'])){
    failed();
}

header('Content-Type: application/json');
echo json_encode($response);

function failed() {
    $response = new Result();
    $response->result = 'Failure';
    $response->message = 'Invalid Login: '.$admin;

    header('Content-Type: application/json');
    echo json_encode($response);
    die;
}

?>