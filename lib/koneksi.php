<?php

class koneksi{
    public static function make($koneksi)
    {
        try{
            $host   =$koneksi['host'];
            $db     =$koneksi['db'];
            $user   =$koneksi['user'];
            $pass   =$koneksi['pass'];

            return new PDO("mysql:host={$host};dbname={$db}",$user,$pass);
        }catch(PDOException $e){
            var_dump($e-getMessage());
        }
        include_once 'query.php';

        $crud = new crud($pdo);
    }
}

?>
