<?php

    require_once '../lib/koneksi.php';

    if(isset($_POST["id"])){
        $id_user = $_POST['id'];

        $query = "SELECT * FROM product WHERE id_product = :id";
        $urute = $pdo->prepare($query);
        $urute->execute([':id'=>$id_user]);
        $user = $urute->fetch();
    }

    if(isset($_POST['submit'])){
        $id_user = $_POST['id'];
        $query = "SELECT * FROM product WHERE id_product = :id";
        $urute = $pdo->prepare($query);
        $urute->execute([':id'=>$id_user]);
        $user = $urute->fetch();

        $jeneng = is_nulll($_POST['nama'])?$_POST['nama']:$user['nama'];

        try{
            $ukuran =[
                'nama'      =>$nama,
                'stok'      =>$_POST['stok'],
                'img'       =>$_POST['img'],
                'keterangan'=>$_POST['keterangan'],
                'level'     =>$_POST['level'],
                'id'        =>$_POST['id_product'],
            ];

            $query = "UPDATE product SET nama=:nama,stok=:stok,img=:img,keterangan=:keterangan,level=:level WHERE id=:id";

            $urt = $pdo->prepare($query);
            $urt->execute($ukuran);

            header("location:index.php?p=terbaru");
        }catch(/PDOException $e){
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
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <form action="edit.php" method="post" accept-charset="utf-8">
            <input type="hidden" name="id" value="<?=$user['id']?>">
            <p>nama</p>
            <input type="text" name="nama" value="<?=$user['nama']?>">
            <p>stok</p>
            <input type="text" name="stok" value="<?=$user['stok']?>">
            <p>Gambar</p>
            <input type="text" name="img" value="<?=$user['img']?>">
            <p>Keterangan</p>
            <input type="text" name="keterangan" value="<?=$user['keterangan']?>">
            <input type="hidden" name="level" value="<?=$user['level']?>">
            <input type="submit" name="submit" value="submit">
        </form>
    </body>
</html>
