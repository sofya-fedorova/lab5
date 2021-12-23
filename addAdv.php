<?php
require_once __DIR__ . "/database/pdo.php";
session_start();
$dbh = DB::getConnection();
$id_User = $_SESSION['id_User'];
$heading = $_POST['guruweba_example_text_addHeading'];
$price = $_POST['guruweba_example_text_addPrise'];
$description = $_POST['addOpes'];
$photo = "img/" . basename($_FILES['file']['name']);
$chapter = $_POST['category'];

$uploadfile = "img/" . basename($_FILES['file']['name']);

$types = array('image/png', 'image/jpeg', 'image/jpg');
if(!in_array($_FILES['file']['type'], $types)){
        echo "<script> alert('Запрещенный тип файла! Формат должен быть jpeg, png или jpg!')</script>";
    die();
}

if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
    //echo "Файл корректен и был успешно загружен.\n";
    $query = "INSERT INTO `advertisement` (`id_User`, `heading`, `price`,
                             `description`, `photo`, `charter`)
    VALUES (:id_User,:heading,:price,:description,:photo,:chapter)";
    $params = [
        ':id_User' => $id_User,
        ':heading' => $heading,
        ':price' => $price,
        ':description' => $description,
        ':photo' => $photo,
        ':chapter' => $chapter
    ];
    $stmt = $dbh->prepare($query);
    $stmt->execute($params);


} else {
    //echo "Возможная атака с помощью файловой загрузки!\n";
}
//echo 'Некоторая отладочная информация:';
//print_r($_POST);


//print "</pre>";


exit();
header("Location: http://lab2-main/index.php");

