<?php

    require_once "../lib/koneksi.php";

    if(isset($_POST['submit'])){
        try{
            $ukuran = [
                ':id'        =>$_POST['id_product'],
                ':nama'      =>$_POST['nama'],
                ':stok'      =>$_POST['stok'],
                ':img'       =>$_POST['img'],
                ':keterangan'=>$_POST['keterangan'],
                ':level'     =>$_POST['level'],
            ];

            $query = "INSERT INTO product (id,nama,stok,img,keterangan,level) VALUES (:id,:nama,:stok,:img,:keterangan,:level)";
            $urute = $pdo->prepare($query);
            $urute->execute($ukuran);

            header("location:index.php?p=terbaru");
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <link rel="stylesheet" href="">
    </head>
    <body>

    </body>
</html>
