<?php 

$link = mysqli_connect('localhost', 'root', '', 'evstrv');

$result = [
    'messages' => []
];

if(!empty($_GET) && !empty($_GET['from']) && !empty($_GET['to']) && !empty($_GET['datetime'])) {
    $from = htmlspecialchars($_GET['from']);
    $to = htmlspecialchars($_GET['to']);
    $datetime = date('Y-m-d h:i:s', htmlspecialchars($_GET['datetime']) / 1000 + 7200);

    $query = "SELECT id,login FROM users WHERE login IN('$from', '$to') LIMIT 2";
    $resDb = mysqli_query($link, $query);

    while($user = mysqli_fetch_assoc($resDb)) {
        if($user['login'] === $from) {
            $from = $user['id'];
        } else if($user['login'] === $to) {
            $to = $user['id'];
        }
    }

    $query = "SELECT * FROM messages WHERE `from` = '$to' AND `to` = '$from' AND `datetime`>'$datetime' ORDER BY `datetime` desc";
    $resDb = mysqli_query($link, $query);

    while($message = mysqli_fetch_assoc($resDb)) {
        $result['messages'][] = [
            'text' => $message['text'],
            'myself' => $from === $message['from']
        ];
    }

    $result['messages'] = array_reverse($result['messages']);
}

mysqli_close($link);

die(json_encode($result));