<?php
function addUs(){
    require_once __DIR__ . "/database/pdo.php";
    $dbh = DB::getConnection();

    if (!empty($_POST)) {
        $telephone = htmlspecialchars($_POST[userFone]);
        $name = htmlspecialchars($_POST[userName]);
        $surname = htmlspecialchars($_POST[userSur]);
        $patronymic = htmlspecialchars($_POST[userPatron]);
        $email = htmlspecialchars($_POST[userEmail]);
        $password = password_hash($_POST[userPass], PASSWORD_BCRYPT);
        $registrationDate = date("Y-m-d");
        $token = "aasdasqwzcWA";
        $id_accessLevel = 2;

        $query = "INSERT INTO `user` 
    ( `telephone`, `name`, `surname`, `patronymic`, 
     `email`, `password`, `registrationDate`, `token`, `idaccessLevel`) 
     VALUES (:telephone, :name, :surname, :patronymic, 
             :email, :password, :registrationDate, :token, :id_accessLevel)";
        $params = [
            ':telephone' => $telephone,
            ':name' => $name,
            ':surname' => $surname,
            ':patronymic' => $patronymic,
            ':email' => $email,
            ':password' => $password,
            ':registrationDate' => $registrationDate,
            ':token' => $token,
            ':id_accessLevel' => $id_accessLevel
        ];
        $stmt = $dbh->prepare($query);
        $stmt->execute($params);


        echo json_encode(["errors" =>$stmt ->errorInfo()[2]==null ? null:$stmt ->errorInfo()[2]]);

    }
}
addUs();
