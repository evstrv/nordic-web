<?php
date_default_timezone_get('UTC');
$link = mysqli_connect('localhost', 'root', '', 'evstrv');

$res = [
    'messages' => []
];

if(!empty($_GET) && !empty($_GET['from']) && !empty($_GET['to'])) {
    $from = htmlspecialchars($_GET['from']);
    $to = htmlspecialchars($_GET['to']);

    $query = "SELECT id,login FROM users WHERE login IN('$from', '$to') LIMIT 2";
    $resDb = mysqli_query($link, $query);

    while($user = mysqli_fetch_assoc($resDb)) {
        if($user['login'] === $from) {
            $from = $user['id'];
        } else if($user['login'] === $to) {
            $to = $user['id'];
        }
    }

    $query = "SELECT * FROM messages WHERE `from`='$from' AND `to`='$to' OR `from`='$to' AND `to`='$from' ORDER BY `datetime` desc LIMIT 10";
    $resDb = mysqli_query($link, $query);

    // var_dump(mysqli_error($link));

    while($message = mysqli_fetch_assoc($resDb)) {
        $res['messages'][] = [
            'text' => $message['text'],
            'myself' => $from === $message['from']
        ];
    }

    $res['messages'] = array_reverse($res['messages']);
}

mysqli_close($link);

die(json_encode($res));