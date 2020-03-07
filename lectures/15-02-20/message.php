<?php

$link = mysqli_connect('localhost', 'root', '', 'evstrv');

$post = json_decode(file_get_contents('php://input'), true);

if (!empty($post) && !empty($post['message']) && !empty($post['from']) && !empty($post['to'])) {
    $from = htmlspecialchars($post['from']);
    $to = htmlspecialchars($post['to']);
    $text = htmlspecialchars($post['message']);

    $query = "SELECT id,login FROM users WHERE login IN('$from', '$to') LIMIT 2";
    $resDb = mysqli_query($link, $query);

    var_dump(mysqli_error($link));

    while($user = mysqli_fetch_assoc($resDb)) {
        if($user['login'] === $from) {
            $from = $user['id'];
        } else if($user['login'] === $to) {
            $to = $user['id'];
        }
    }

    $datetime = date('Y-m-d h:i:s');
    $query = "INSERT INTO messages(`text`, `from`, `to`, `datetime`) VALUES('$text', $from, $to, '$datetime')";
    mysqli_query($link, $query);

    var_dump(mysqli_error($link));
}

mysqli_close($link);

die();