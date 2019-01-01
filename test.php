<!DOCTYPE html>
<head>
  <title>Auth</title>
  <meta charset="utf-8">
</head>
<body>
  <?php
  $mysqli = new mysqli("localhost", "123", "ufdhbi33", "new_db"); # 123 - user; 321- pass;
  $mysqli->set_charset("utf8");
  if ($mysqli->connect_errno){
  $json_array = array("error" => 1, "message" => "Ошибка подключения к БД");
  $json = json_encode($json_array, JSON_UNESCAPED_UNICODE);
  exit($json);
  }
  else {
    if (isset($_GET['code'])) {
      $query = "SELECT * FROM `users` WHERE CODE=".$_GET['code'];
      $sql = mysqli_query($mysqli,$query) or die(mysqli_error());
      if (mysqli_num_rows($sql) > 0) {
            $myrow = mysqli_fetch_array($sql);
            $date = date_create($myrow['date']);
            $curdate = date("d.m.Y");
            if (strtotime($curdate) < strtotime(date_format($date, 'd.m.y')))
            {
                $interval = date_diff($date, date_create($curdate));
                echo $interval->format("%d");
            }
            else
            {
                echo "The duration of the key has expired.";
            }
      }else{
        echo '-1';
      }
    }
  }
  ?>
</body>
