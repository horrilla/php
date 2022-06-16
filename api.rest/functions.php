<?php


function getPosts($connect) {
    $sql = 'SELECT * FROM posts';
    $query = $connect->prepare($sql);
    $query->execute();
    $res = $query->fetchAll();
    $res = json_encode($res);
    file_put_contents('php://output', $res);
}


function getPost($connect, $id) {
    $id = (int) htmlspecialchars($id);

    $sql = 'SELECT * FROM posts WHERE id = :id';
    $query = $connect->prepare($sql);
    $query->execute(['id' => $id]);
    $res = $query->fetch();

    if ($res == false) {
       http_response_code(404);
       $res = [
         'status' => '404',
         'message' => 'Post not found'
       ];
        file_put_contents('php://output', json_encode($res));
    } else {
        $res = json_encode($res);
        file_put_contents('php://output', $res);
    }
}


function addPost($connect, $data) {

    if (isset($data['title']) and isset($data['body'])) {
        $title = htmlspecialchars($data['title']);
        $body = htmlspecialchars($data['body']);

        $sql = 'INSERT INTO posts (title, body) VALUES (:title, :body)';
        $query = $connect->prepare($sql);
        $query->execute(['title' => $title, 'body' => $body]);

        if ($connect->lastInsertId()) {
            http_response_code(201);
            $res = [
                'status' => true,
                'post_id' => $connect->lastInsertId()
            ];

            file_put_contents('php://output', json_encode($res));
        }
    } else {
        http_response_code(400);
        $res = [
            'status' => false,
            'message' => 'Do not cretated'
        ];
        file_put_contents('php://output', json_encode($res));
    }
}


function updatePost($connect, $id, $data) {
    if (isset($data['title']) and isset($data['body'])) {
        $title = htmlspecialchars($data['title']);
        $body = htmlspecialchars($data['body']);
        $id = htmlspecialchars($id);

        $sql = 'UPDATE posts SET title = :title, body =:body WHERE id = :id';
        $query = $connect->prepare($sql);
        $res = $query->execute(['title' => $title, 'body' => $body, 'id' => $id]);

        if ($res) {
            http_response_code(200);
            $res = [
                'status' => true,
                'message' => 'Post is updated'
            ];

            file_put_contents('php://output', json_encode($res));
        }
    } else {
        http_response_code(400);
        $res = [
            'status' => false,
            'message' => 'Do not updated'
        ];
        file_put_contents('php://output', json_encode($res));
    }
}


function deletePost($connect, $id) {

    $id = htmlspecialchars($id);
    $sql = 'DELETE FROM posts WHERE id = :id';
    $query = $connect->prepare($sql);
    $res = $query->execute(['id' => $id]);

    if ($res) {
        $res = [
            'status' => true,
            'message' => 'Post deleted'
        ];

        file_put_contents('php://output', json_encode($res));
    } else {

        http_response_code(400);
        $res = [
            'status' => false,
            'message' => 'Post do not deleted'
        ];

        file_put_contents('php://output', json_encode($res));
    }
}

































