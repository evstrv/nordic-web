<?php
    class DbController {
        private static $DB_HOST = 'localhost';
        private static $DB_LOGIN = 'root';
        private static $DB_PASSWORD = '';
        private static $DB_NAME = 'evstrv';

        protected $link = null;

        function __construct() {
            $this->connect();
        }

        function __destruct() {
            mysqli_close($this->link);
            $this->link = null;
        }

        private function connect() {
            $this->link = mysqli_connect(
                $this::$DB_HOST,
                $this::$DB_LOGIN,
                $this::$DB_PASSWORD,
                $this::$DB_NAME
            );
        }

        public function login($login, $password) {
            $res = [];

            $login = htmlspecialchars($login);
            $password = htmlspecialchars($password);

            $query = "SELECT * FROM users WHERE login = '$login' AND password = '$password' LIMIT 1";
            $resDb = mysqli_query($this->link, $query);

            if($user = mysqli_fetch_assoc($resDb)) {
                if($user['active']) {
                    $query = "SELECT token FROM tokens WHERE login = {$user['id']} LIMIT 1";
                    $resDb = mysqli_query($this->link, $query);

                    if($token = mysqli_fetch_assoc($resDb)) {
                        $res['token'] = $token['token'];
                    } else {
                        $token = sha1($login . $password);
                        $query = "INSERT INTO tokens(token, login) VALUES ('$token', {$user['id']})";
                        $resDb = mysqli_query($this->link, $query);
                        $res['token'] = $token;
                    }
                }
            } else {
                $query = "INSERT INTO users(login, password) VALUES ('$login', '$password')";
                mysqli_query($this->link, $query);
                $id = mysqli_insert_id($this->link);

                if ($id > 0) {
                    $token = sha1($login . $password);
                    $query = "INSERT INTO tokens(token, login) VALUES ('$token', $id)";
                    $resDb = mysqli_query($this->$link, $query);
                    $res['token'] = $token['token'];
                }
            }

            return $res;
        }

        public function users() {
            $query = "SELECT login FROM users WHERE active = true";
            $resDb = mysqli_query($this->link, $query);

            $users = [];

            while($user = mysqli_fetch_assoc($resDb)) {
                $users[] = $user['login'];
            }
            
            return $users;
        }

        // abstract public function test();
    }
    
    $db = new DbController();

    // final class DbControllerApi extends DbController {
    //     function __construct() {
    //         parent::__construct();
    //     }

    //     public function test() {

    //     }
    // }

    // class TestDb extends DbControllerApi {

    // }

    // interface Api {
    //     public function connect();
    // }

    // class TestApi implements Api {
    //     public function connect() {

    //     }
    // }