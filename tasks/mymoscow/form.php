<?php

$link = mysqli_connect('localhost', 'root', '', 'mymoscow');
mysqli_set_charset($link, "utf8");

if(!empty($_POST)) {
    if(!empty($_POST['name']) && !empty($_POST['mail']) && !empty($_POST['telephone']) && !empty($_POST['discription']) && !empty($_POST['attraction'])) {
        $name = htmlspecialchars($_POST['name']);
        $mail = htmlspecialchars($_POST['mail']);
        $tel = htmlspecialchars($_POST['telephone']);
        $disc = htmlspecialchars($_POST['discription']);
        $att = htmlspecialchars($_POST['attraction']);

        $query = "INSERT INTO form(`fio`, `email`, `tel`, `message`, `reaction`) VALUES('$name', '$mail', '$tel', '$disc', '$att')";
        mysqli_query($link, $query);
    }
}

mysqli_close($link);

?>