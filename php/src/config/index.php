<?php

function json($status, $data) {
    $cors = "*";
    header("Access-Control-Allow-Origin: $cors");
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($status);
    echo json_encode($data);
}

require __DIR__ . '/routes.php';
// require __DIR__ . '/db.php';