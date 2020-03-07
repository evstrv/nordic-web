<?php
    include 'db_controller.php';
    
    $users = $db->users();

    die(json_encode($users));
