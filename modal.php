<?php
function modal_windows(){?>
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
        <?php 
        if (!empty($_POST) && filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL)
            && $_POST['userPassToo'] == $_POST['userPass'] && mb_strlen($_POST['userFone']) == 11
            && mb_strlen($_POST['userName']) > 0 && mb_strlen($_POST['userSur']) > 0
            && mb_strlen($_POST['userPatron']) > 0 && mb_strlen($_POST['userPass']) > 0 ){
        	        addUs();
        }
        ?>

      <div id="okno2" style="display:none">

        <p>Регистрация</p>
        <img src="img/cross.png" class = "cross1">
<div class = "textbox">
	        <input type="text" class="new_surname" placeholder = "Введите фамилию" name="userSur">
	    </div>
	        <input type="text" class="new_name" placeholder = "Введите имя" name="userName">	    
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
<?php } ?>