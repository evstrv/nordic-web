<?php
include 'db_controller.php';

// $link = mysqli_connect('localhost', 'root', '', 'evstrv');

$postRaw = file_get_contents('php://input');
$post = json_decode($postRaw, true);

$res = [];  

if(!empty($post) && !empty($post['login']) && !empty($post['password'])) {
    // $db = new DbController();
    $res = $db->login($post['login'], $post['password']);

    // $login = htmlspecialchars($post['login']);
    // $password = htmlspecialchars($post['password']);

    // $query = "SELECT * FROM users WHERE login = '$login' AND password = '$password' LIMIT 1";
    // $resDb = mysqli_query($link, $query);

    // if($user = mysqli_fetch_assoc($resDb)) {
    //     if($user['active']) {
    //         $query = "SELECT token FROM tokens WHERE login = {$user['id']} LIMIT 1";
    //         $resDb = mysqli_query($link, $query);

    //         if($token = mysqli_fetch_assoc($resDb)) {
    //             $res['token'] = $token['token'];
    //         } else {
    //             $token = sha1($login . $password);
    //             $query = "INSERT INTO tokens(token, login) VALUES ('$token', {$user['id']})";
    //             $resDb = mysqli_query($link, $query);
    //             $res['token'] = $token;
    //         }
    //     }
    // } else {
    //     $query = "INSERT INTO users(login, password) VALUES ('$login', '$password')";
    //     mysqli_query($link, $query);
    //     $id = musqli_insert_id($link);

    //     if ($id > 0) {
    //         $token = sha1($login . $password);
    //         $query = "INSERT INTO tokens(token, login) VALUES ('$token', $id)";
    //         $resDb = mysqli_query($link, $query);
    //         $res['token'] = $token['token'];
    //     }
    // }
}

// mysqli_close($link);

die(json_encode($res));

// создаем БД или подключаем свою
// создаем таблицу users
// id (int 11) not null auto_increment
// login (varchar 256) not null
// password (varchar 256) not null
// active (boolean) not null default true

// создаем еще одну таблицу tokens
// id (int 11) not null auto_increment
// token (varchar 256) not null
// login (int 11) not null

// создаем еще одну таблицу messages
// id (int 11) not null auto_increment
// text (text) not null
// from (int 11) not null
// to (int 11) not null
// datetime (datetime) not null default current_timestamp