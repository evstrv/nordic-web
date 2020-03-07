<?php 

$link = mysqli_connect('localhost', 'root', '', 'evstrv');

$result = [
    'messages' => []
];

if(!empty($_GET) && !empty($_GEt['from']) && !empty($_GET['to']) && !empty($_GET['start'])) {
    $from = htmlspecialchars($_GET['from']);
    $to = htmlspecialchars($_GET['to']);
    $start = intval(htmlspecialchars($_GET['start']) + 1;

    $query = "SELECT id,login FROM users WHERE login IN('$from', '$to') LIMIT 2";
    $resDb = mysqli_query($link, $query);

    while($user = mysqli_fetch_assoc($resDb)) {
        if($user['login'] === $from) {
            $from = $user['id'];
        } else if($user['login'] === $to) {
            $to = $user['id'];
        }
    }

    $query = "SELECT * FROM messages WHERE `from`='$from' AND `to`='$to' OR `from`='$to' AND `to`='$from' ORDER BY `datetime` desc LIMIT $start, 10";
    $resDb = mysqli_query($link, $query);

    while($result = mysqli_fetch_assoc($resDb)) {
        $result['messages'][] = [
            'text' => $message['text'],
            'myself' => $from === $message['from']
        ];
    }

    $result['messages'] = array_reverse($result['messages']);
}

mysqli_close($link);

die(json_encode($result));