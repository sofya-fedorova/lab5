<?php
require_once __DIR__ . "/database/pdo.php";
require_once __DIR__ . "/header.php";
require_once __DIR__ . "/modal.php";
require_once __DIR__ . "/footer.php";
$dbh = DB::getConnection();
session_start();
if (!empty($_POST['but_exit'])) {     
  session_unset();
}
$id_advertisement = $_GET['varname'];
$data = $dbh->prepare("SELECT * FROM user
inner join application ON (user.id_User = application.id_User)
where id_advertisement = ?");
$data->bindParam(1, $id_advertisement, PDO::PARAM_INT);
$data->execute();

$phone = $data->fetchAll(PDO::FETCH_ASSOC);

$photo = $dbh->prepare("SELECT * FROM advertisement
where id_advertisement = ?");

$photo->execute([$id_advertisement,]);

$ph = $photo->fetch(PDO::FETCH_LAZY);

  $id_advertisement_user = $dbh->prepare("SELECT `id_User` FROM `advertisement` WHERE id_advertisement = ?");
  $id_advertisement_user->execute([$id_advertisement,]);
  $id_advertisement_user_print = $id_advertisement_user->fetch(PDO::FETCH_LAZY);

if(($_POST['respond'])=="1" && $_SESSION['logged'] != 1){
  echo "<script> alert('Сначала необходимо авторизоваться!'); </script>";
}
if(($_POST['respond'])=="1" && $_SESSION['logged'] == 1){
$data = $dbh->prepare("SELECT * FROM `application` WHERE id_User = ? AND id_advertisement = ?");

$data->execute([$_SESSION['id_User'], $id_advertisement]);

$users_adv = $data->fetch(PDO::FETCH_LAZY);

if($users_adv == null){
  $query = ("INSERT INTO `application` (`id_User`, `id_advertisement`, `applicationData`, `applicationTime`) VALUES (:id_User, :id_advertisement, :date_, :time_)");
$params = [
        ':id_User' => $_SESSION['id_User'],
        ':id_advertisement' => $id_advertisement,
        ':date_' => date("Y-m-d"),
        ':time_' => date("H:i:s")
      ];
$stmt = $dbh->prepare($query);
$stmt->execute($params);
  echo "<script> alert('Вы откликнулись!'); </script>" ;
}
else{
  echo "<script>alert('Вы уже откликнулись на это объявление!');</script>";
}
}
?>

<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
<!doctype html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="css\stayl.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <title>Детали</title>
  </head>
<body>
  <header id = "header" class = "header">
		<div class = "container">
        <?php header_site();?>
		</div>
	</header>

  <section>
    	<div class = "container">
        <div class="description">

        <div class="photoDescription">
          <h4><?php echo $ph[heading];?></h4>
          <img src="<?php echo $ph[photo];?>" alt="Rectangle5" class="adve">
        </div>
        <div class="Information">
          <div class="InformationBut">

          <h4><?php echo $ph[price];?> ₽</h4>
          <button class="button Telephone">
            <span>Телефон: <br> 
              <?php
              if (!$_SESSION['logged']){
              echo "+7-xxx-xxx-xx-xx";  
              }
              else{
                $telephone = $dbh->prepare("SELECT `telephone` FROM `user` inner JOIN advertisement on advertisement.id_User = user.id_User WHERE `id_advertisement` = ?");
                  $telephone->execute([$id_advertisement,]);
                  $telephone_print = $telephone->fetch(PDO::FETCH_LAZY);
                  echo $telephone_print['telephone'];
              }
              ?>
          </span>
            </button>
            
            <form method="POST">         
            <?php  if ($_SESSION['id_User'] != $id_advertisement_user_print['id_User']){?>    
            <button type = "submit" name="respond" class="button Respond" value="1" style="width:500px">
              <span>Откликнуться</span>
              </button>
            <?php }?>
            </form>

              <p class="text" style="color:black">
                <?php echo $ph[description];?>
              </p>
        </div>
      </div>
      </div>
      <div class="listResponders">

 
<?php
  if ($_SESSION['id_User'] == $id_advertisement_user_print['id_User']){
                echo "<table  width='800' actiaon = '/index1.php' method = 'post'>
  <caption>Список откликнувшихся</caption>
  <thead>
    <tr>
      <th>ФИО пользователя</th>
      <th>Телефон</th>
    </tr>
  </thead>";
              foreach ($phone as $k => $v) {
             echo '<tbody>
                <tr>
                  <td>'.$v['surname'].' '.$v['name'].' '.$v['patronymic'].'</td>
                  <td>'.$v['telephone'].'</td>
                </tr>
              </tbody>';}
              echo "</table>";
              }
?>
      </div>
      </div>
  </section>
  <?php footer_site(); ?>
<?php modal_windows(); ?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html>
