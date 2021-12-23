<?php
require_once __DIR__ . "/database/pdo.php";

$dbh = DB::getConnection();
$id_User = 1;
$heading = $_POST[guruweba_example_text_addHeading];
$price = $_POST[guruweba_example_text_addPrise];
$description = $_POST[addOpes];
$photo = "img/" . basename($_FILES['file']['name']);
$chapter = $_POST[addOpes];

$uploadfile = "img/" . basename($_FILES['file']['name']);
//echo $uploadfile;

echo '<pre>';
if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
    //echo "Файл корректен и был успешно загружен.\n";
    $query = "INSERT INTO `advertisement` (`id_User`, `heading`, `price`,
                             `description`, `photo`, `chapter`)
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
//print_r($_FILES);


//print "</pre>";

$new_url = 'http://lab2-main/index.php';
header('Location: '.$new_url);
exit();
