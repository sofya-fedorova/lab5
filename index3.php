<?php
require_once __DIR__ . "/database/pdo.php";
session_start();
if (!empty($_POST['but_exit'])) {     
  session_unset();
}
if($_SESSION['logged'] != 1){
  ob_start();
  $new_url = 'index.php';
  header('Location: '.$new_url);
  ob_end_flush();
}
$dbh = DB::getConnection();
session_start();
$id_user = $_SESSION['id_User'];

$about_user = $dbh->prepare("SELECT * FROM user WHERE id_User = ?");
$about_user->execute([$id_user,]);
$inf = $about_user->fetch(PDO::FETCH_LAZY);

$data = $dbh->prepare("SELECT * FROM advertisement WHERE id_User = ?");
$data->execute([$id_user,]);
$phone = $data->fetchAll(PDO::FETCH_ASSOC);
$id = $phone['id_advertisement'];

if (!empty($_POST)) {
  if($_POST['my_ads'] == 'Мои отклики'){
  $data = $dbh->prepare("SELECT * FROM advertisement INNER JOIN application on application.id_advertisement = advertisement.id_advertisement WHERE application.id_User = ?");
  $data->execute([$id_user,]);
  $phone = $data->fetchAll(PDO::FETCH_ASSOC);
  $id = $phone['id_advertisement'];
  }
} 

?>

<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
<!doctype html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="css\main.css">
      <link rel="stylesheet" href="css\check_box.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <title>Личный кабинет</title>
  </head>
<body>
<header id = "header" class = "header">
    <div class = "container">

      <div class="nav">
        
          <a href="index.php">
          <img src="img/logo.png" class="logo">
          </a>
          <img src="img/loc.png" class = "loc">
          <p class = "city">Липецк </p>
        
          <ul class = "menu">
            
            <li><a href="index.php">
                Главная
              </a>
            </li> 
            <li><a href="index2.php">
                Разместить объявление
              </a>
            </li>   

            <li>
              <p class="name"> Здравствуйте, <?php  echo $inf['name']?></p>
            </li>
            <li>
              <form method = 'POST' action="index.php">
              <button type='submit' name = 'but_exit' value = 'exit' id = 'Button_Exit' style = "margin-top: 17px;">Выход</button>
            </form>
            </li>   
          </ul>
        
          <button class="menu-open">
              <img src="img/menu.svg">
          </button>
       </div>
    </div>    
  </header>

  <section class = "ind3">
    	<div class = "container">
        <div class="about_user">
          <h1 class = "personal_information">Личная информация</h1>
          <p>Фамилия: <?php echo $inf['surname']?></p>
          <p>Имя: <?php  echo $inf['name']?></p>
          <p>Отчество: <?php echo $inf['patronymic']?></p>
          <p>Почта: <?php echo $inf['email']?></p>
          <p>Телефон: <?php echo $inf['telephone']?></p>
        </div>
      </div>
  </section>

<section class = "ind3">
    <div class = "container">
      <form class = "change_ads" method="POST" action="index3.php" name = "form">
          <input type="submit" class = "my_ads" name = "my_ads" value = "Мои объявления" id = "hello">
          <input type="submit" class = "my_ads" name = "my_ads" value = "Мои отклики">
      </form>
      <div class = "cards">                         
      <?php
        foreach ($phone as $k => $v) {
          $id = $v['id_advertisement'];
             ?>
          <a href="index1.php">
           <a href="index1.php?varname=<?php echo $id ?>">
           <?php echo
          '<div class ="card">        
            <div class = "inside">          
              <p>'.$v['heading'].'</p>
              <img class="img1" src="'.$v['photo'].'" >
              <p>'.$v['price'].'₽</p>
            </div>  
            <img src="img/card.png" class ="imgcard">
          </div>
          </a>';}
        ?>
      </div>    
    </div>  
  </section>

  <footer id = "footer">
    <div class="container">
      <div class ="text">
        <p class="mail">Разработчики:<br>
          sofya-fedorova-2014@mail.ru<br>
          albert.e.m@mail.ru
        </p>
        <p class="mail">
          Объявления.ru — сайт объявлений
        </p>
      </div>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="main.js"></script>
</body>
</html>
