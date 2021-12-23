<?php

class Db
{
    public static function getConnection()
    {
        $ini_array = parse_ini_file("./config/php.ini");

        $str = 'mysql:host=' . $ini_array['host'] . ';dbname=' . $ini_array['dbname'];
        $str1 = $ini_array['login'];
        $str2 = $ini_array['password'];

        try {
            return $dbh = new PDO($str, $str1, $str2);
        } catch
        (\Exception $exception) {
            echo "Ошибка при подключении к БД<br>";
            echo $exception->getMessage();
            die();
        }
    }
}
?>