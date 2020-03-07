<?php
  $link = mysqli_connect(
    'localhost',
    'root',
    '',
    'web0812'
  );
  // mysqli_set_charset($link, "utf8");

  // $query = "insert into test(EMAIL, FIO, REACTION) values('test@test.ru', 'Ivan Ivanov', '1');";
  // $res = mysqli_query($link, $query);

  // var_dump($res);

  // echo "<pre>";
  // var_dump($_POST);
  // echo "</pre>";

  if (!empty($_POST)) {
    if (!empty($_POST['fio']) && !empty($_POST['email']) && 
    (empty($_POST['reaction']) || !empty($_POST['reaction']) <= 5 && !empty($_POST['reaction']) > 0)) {
      $query = "insert into 
      test(
        FIO, EMAIL" . (!empty($_POST['reaction']) ? ", REACTION" : '')  ."
      ) 
      values(
        '" . htmlspecialchars($_POST['fio']) . "', 
        '" . htmlspecialchars($_POST['email']) . "'
        " . (!empty($_POST['reaction']) ? ', \'' . htmlspecialchars($_POST['reaction']) . '\'' : '') . "
      );";
      $res = mysqli_query($link, $query);
      if ($res) {
        $success = true;
        $_POST = [];
      } else {
        $success = false;
      }
    }
  }
  mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="css/style.css">

  <title>PHP</title>
</head>

<body>
  <style>
    form {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    form > label {
      display: flex;
      justify-content: space-between;
      margin-bottom: 1rem;
    }

    form > label > input {
      width: 200px;
    }

    form > label > span {
      margin-right: 1rem;
    }

    form > input {
      margin-top: 1rem
    }

    .emotions {
      display: flex;
    }

    .emotions label {
      display: flex;
      margin-right: 1rem;
    }

    .emotions label input[type="radio"]{
      display: none;
    }

    .emotions svg {
      width: 60px;
      height: 60px;
    }
  </style>

  <?php if(isset($success) && $success):?>
    <h3>Данные успешно записаны</h3>
    <?php elseif(isset($success) && !$success):?>
    <h3>Данные не записаны</h3>
  <?php endif;?>

  <?php if(!empty($_POST) && (empty($_POST['fio']) || empty($_POST['email']))):?>
    <h3>Нe все поля заполнены</h3>
  <?php endif;?>

  <form method="post" action="">
    <label>
      <span>ФИО</span>
      <input type="text" name="fio" required>
    </label>
    <label>
      <span>E-mail</span>
      <input type="email" name="email" required>
    </label>
    <div class="emotions">
          <!-- M 20, 40
            Q 20, 40 40, 40 -->
      <?php
        $emotions = [
          "M 20, 40 Q 30, 30 40, 40",
          "M 20, 40 Q 30, 35 40, 40",
          "M 20, 40 L 40, 40",
          "M 20, 40 Q 30, 45 40, 40",
          "M 10, 35 Q 30, 55 50, 35"
        ];
      ?>

      <?php foreach($emotions as $id => $path):?>

      <label>
        <svg viewBox="0 0 60 60" version="1.1" xmlns="http://www.w3.org/2000/svg"> 
          <circle cx="30" cy="30" r="29" fill="transparent" stroke-width="2" stroke="black"/>
          <circle cx="20" cy="20" r="2"/>
          <circle cx="40" cy="20" r="2"/>
          <path d="<?=$path?>" fill="transparent" stroke="black"/>
        </svg>
        <input type="radio" name="reaction" value="<?=$id+1?>">
      </label>

      <?php endforeach;?>

    </div>
    <input type="submit" value="Отправить">
  </form>
</body>

<script src="js/main.js"></script>

</html>