<?php
require_once __DIR__ . "/database/pdo.php";
require_once __DIR__ . "/header.php";
//require_once __DIR__ . "/addUser.php";
require_once __DIR__ . "/footer.php";
$dbh = DB::getConnection();
session_start();
$data = $dbh
->query("SELECT * FROM advertisement")
->fetchAll(PDO::FETCH_ASSOC);
if (!empty($_GET)) {
	if($_GET['namea'] == 'от А до Я'){
		$data = $dbh
		->query("SELECT * FROM `advertisement` ORDER BY heading")
		->fetchAll(PDO::FETCH_ASSOC);
	}
	if($_GET['named'] == 'от Я до А'){
		$data = $dbh
		->query("SELECT * FROM `advertisement` ORDER BY heading DESC")
		->fetchAll(PDO::FETCH_ASSOC);
	}
	if($_GET['pricea'] == 'возрастание'){
		$data = $dbh
		->query("SELECT * FROM `advertisement` ORDER BY price")
		->fetchAll(PDO::FETCH_ASSOC);
	}
	if($_GET['priced'] == 'убывание'){
		$data = $dbh
		->query("SELECT * FROM `advertisement` ORDER BY price DESC")
		->fetchAll(PDO::FETCH_ASSOC);
	}
}

if (!empty($_POST['users_log']) && !empty($_POST['users_pwd'])) {	
		$logIN = $_POST['users_log'];
		$Password = $_POST['users_pwd'];
		$data = $dbh->prepare("SELECT id_User, password, idaccessLevel FROM `user` WHERE email = ?");

		$data->execute([$logIN,]);

		$users_data = $data->fetch(PDO::FETCH_LAZY);

		if(!empty($users_data)){
			if(password_verify($Password, $users_data['password'])){
				$_SESSION['id_User'] = $users_data['id_User'];
				$_SESSION['idaccessLevel'] = $users_data['idaccessLevel'];
				$_SESSION['logged'] = 1;
			}
			else {
			echo "<script>alert('Неправильный логин или пароль!')</script>";
		}
		}
		else {
			echo "<script>alert('Неправильный логин или пароль!')</script>";
		}
}
if (!empty($_POST['but_exit'])) {
	session_unset();
}
if (!empty($_POST['logInSubmit'])) {
	$query = "INSERT INTO `statistics` (`id_statistics`, `id_User`, `datein`, `city`) VALUES (NULL, :id_us, NOW(), 'Липецк')";
		$param = [':id_us'=> $_SESSION['id_User']];
		$data = $dbh -> prepare($query);
		$data->execute($param);
}

if (!empty($_POST)) {
			if($_POST['category'] != "Все категории")
			{
				$search = $_POST['category'];
				$query = "SELECT * FROM advertisement WHERE `charter` LIKE ?";
				$params = ["%$search%"];
				$stmt = $dbh->prepare($query);
				$stmt->execute($params);
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		if($_POST['find_ads'] != null){
				$search = $_POST['find_ads'];
				$query = "SELECT * FROM advertisement WHERE `heading` LIKE ?";
				$params = ["%$search%"];
				$stmt = $dbh->prepare($query);
				$stmt->execute($params);
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			}
		if($_POST['category'] == "Все категории" && $_POST['find_ads'] == null)
		{
				$data = $dbh
		->query("SELECT * FROM advertisement")
		->fetchAll(PDO::FETCH_ASSOC);
		}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Объявления</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/main.css">

</head>
<body>	
	<header id = "header" class = "header">
		<div class = "container">
				<?php header_site();?>
	</header>

	<section id="about" class="about">
		<div class = "container">		
			<h1>Удачный выбор для всех и для каждого</h1>	
			<p class="p1">Найди свое среди тысячи товаров!</p>
			<a href="index2.php"><button type="button" class = "mainbut" id="addAdvertisement">
								Разместить объявление
							</button></a>
		</div>
	</section>

	<section>
		<div class = "container">
			<div id = "fon"> </div>
			<div id = "load"></div>

			<form class = "sort" method="GET" action="index.php">
					Сортировать по: <strong>имени</strong>(<input type="submit" name="namea" value = "от А до Я">/<input type="submit" name="named" value = "от Я до А">)<strong> цене</strong>(<input type="submit" name="pricea" value = "возрастание">/<input type="submit" name="priced" value = "убывание">)
			</form>
<div class = "search">
			<form class = "search1" method="POST" action="index.php" name = "form">
				
				<select name = "category" onchange="this.form.submit()">
				<option value="" selected disabled hidden>Категории</option>
				  <option>Все категории</option>
				  <option>Транспорт</option>
				  <option>Животные</option>
				  <option>Недвижимость</option>
				  <option>Другое</option>
				</select>
			</form>
				<form class = "search2" method="POST" action="index.php">
		    <input name="find_ads" type = "text" class="search_line" placeholder = "Поиск по объявлениям...">
		    <input type="image" class="find" src="img/find.png">
		    
	    </form>
</div>
			<div class = "cards">			                    
			<?php

				foreach ($data as $k => $v) {
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
	<?php footer_site(); ?>
<div id="zatemnenie" style="display:none"></div>
      <form id="okno" style="display:none" method="POST" action="index.php">
        <p>Вход</p>
        	<img src="img/cross.png" class = "cross">
	        <input type="text" name = "users_log" class = "name" placeholder = "Введите почту">
	    
	    	<div class = "textbox">
	        	<input type="password"  name = "users_pwd" class = "pword" placeholder = "Введите пароль"> 
	    	</div>
        	<button type="submit" name = "logInSubmit" id = "logIN" class = "newbut" value = "1">Войти </button>
      </form>
        
<form action="index.php" method="post" id="form1">
      <div id="okno2" style="display:none">

        <p>Регистрация</p>
        <img src="img/cross.png" class = "cross1">

	        <input type="text" class="new_name" placeholder = "Введите имя" name="userName">
	    
<div class = "textbox">
	        <input type="text" class="new_surname" placeholder = "Введите фамилию" name="userSur">
	    </div>

	    <div class = "textbox">
	        <input type="text" class="new_patr" placeholder = "Введите отчество" name="userPatron">
	    </div>

	    <div class = "textbox">
	        <input type="text" class="new_email" placeholder = "Введите email" name="userEmail"> 
	    </div>
	    <div class = "textbox">
	         <input type="text" class="new_phone" placeholder = "Введите телефон" name="userFone"> 
	    </div>
	    <div class = "textbox">
	         <input type="password" class="new_password" placeholder = "Введите пароль" name="userPass"> 
	    </div>
	    <div class = "textbox">
	         <input type="password" class="new_password_again" 
	        	placeholder = "Повторите пароль" name="userPassToo"> 
	    </div>

 
			    <div class="yes">
	    	<input type="checkbox" class="check_box"> <p class ="agree">Согласие на обработку данных</p>

</div>    
        	<button  type="submit" id = "Register" class = "newbut" >Зарегистрироваться</button>
      </div>
    </div>
    </form>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html>