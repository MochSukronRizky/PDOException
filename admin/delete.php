<?php

    require_once '../lib/koneksi.php';

    if(isset($_POST['id'])){
        $user = $_POST['id'];

        $query = "DELETE FROM product WHERE id=:id";
        $unrute = $pdo->prepare($query);
        $unrute->execute([':id'=>$id_user]);

        header("location:inddex.php?p=terbaru");
    }


?>
