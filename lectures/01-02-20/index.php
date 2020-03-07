<?php
  $var1 = '';

  $arr = [
    'key' => 'value',
    10,
    'bool' => true,
    20
  ];
  $arr['key'];

  echo $arr['key'];
  echo '<br>';

  print_r($arr[0]);
  echo '<br>';

  echo '<pre>';
  var_dump($arr);
  echo '</pre>';

  for ($i = 0; $i < 10; $i++) {
    echo "$i <br>";
  }
  echo '<br>';

  while ($i >= 0) {
    echo "$i <br>";
    $i--;
  }
  echo '<br>';

  foreach ($arr as $item) {
    echo '<pre>';
    var_dump($item);
    echo '</pre>';
  }
  echo '<br>';

  foreach ($arr as $key => $value) {
    echo "$key => $value <br>";
  }
  echo '<br>';

  function add ($a = 0, $b = 0) {
    return $a + $b;
  }
  echo add(1, 10);
  echo '<br>';

  echo '<pre>';
  var_dump($_GET);
  echo '</pre>';

  // echo '<pre>';
  // var_dump($_POST);
  // echo '</pre>';

  if (empty($_GET)) { // isset($_GET)
    echo 'GET is empty';
    echo '<br>';
  } else if (!empty($_GET)) {
    echo 'GET is not empty';
    echo '<br>';
  }

  // echo $_GET['text'] ?: '';
  // empty($_GET['text']) ? echo $_GET['text'] : echo '';

  // if (empty($_GET['text'])) {
  //   echo $_GET['text'];
  // } else {
  //   echo '';
  // }

  // parseInt => is_number()
  // $str.replace($search, $replace) => str_replace($search, $replace, $str)
?>

<!-- <form method="get" action="" style="margin-top: 10px"> 
  <input type="text" name="text" value="<?=!empty($_GET) && !empty($_GET['text']) ? $_GET['name'] : ''?>">
  <button type="submit">Send GET</button>
</form> -->

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
  <form method="get" action="">
    <input type="text" name="surname" placeholder="Фамилия">
    <input type="text" name="name" placeholder="Имя">
    <input type="text" name="patronymic" placeholder="Отчество">
    <input type="tel" name="tel" placeholder="Телефон">
    <input type="email" name="mail" placeholder="E-mail">
    <textarea name="area1" placeholder="Что в форме хорошего?"></textarea>
    <textarea name="area2" placeholder="Что в форме плохого?"></textarea>
    <p>
      <input type="checkbox" name="cb" value="op1">Все хорошо<br>
      <input type="checkbox" name="cb" value="op2">Все плохо<br>
    </p>
    <div>
      <label>
        <input type="radio" name="rd" value="very-happy">
        <img src="images/icons/very-happy.png" alt="very-happy">
      </label>
      <label>
        <input type="radio" name="rd" value="happy">
        <img src="images/icons/happy.png" alt="happy">
      </label>
      <label>
        <input type="radio" name="rd" value="neutral">
        <img src="images/icons/neutral.png" alt="neutral">
      </label>
      <label>
        <input type="radio" name="rd" value="sad">
        <img src="images/icons/sad.png" alt="sad">
      </label>
      <label>
        <input type="radio" name="rd" value="very-sad">
        <img src="images/icons/very-sad.png" alt="very-sad">
      </label>
    </div>
    <button type="submit">Отправить</button>
  </form>
</body>

<script src="js/main.js"></script>

</html>