<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json;");


include_once __DIR__ . '/connect.php';
require_once __DIR__ . '/functions.php';
global $connect;


$q = $_GET['q'];
$params = explode('/', $q);
$method = $_SERVER['REQUEST_METHOD'];

$type = $params[0];
$id = $params[1];



if ($method === 'GET') {
    if ($type === 'posts') {
        if (isset($id) and $id !== '') {
            getPost($connect, $id);
        } else {
            getPosts($connect);
        }
    }
} elseif ($method === 'POST') {
    if ($type === 'posts') {
        addPost($connect, $_POST);
    }
} elseif ($method === 'PATCH') {
    if ($type === 'posts') {
        if (isset($id) and $id !== '') {
            $data = file_get_contents('php://input');
            $data = json_decode($data, 1);
            updatePost($connect, $id, $data);
        }
    }
} elseif ($method === 'DELETE') {
    if ($type === 'posts') {
        if (isset($id) and $id !== '') {
            deletePost($connect, $id);
        } else {
            http_response_code(400);
            $res = [
                'status' => false,
                'message' => 'Bad request, please set ID post'
            ];
            file_put_contents('php://output', json_encode($res));
        }
    }
}



