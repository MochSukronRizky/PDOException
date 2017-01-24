<?php
require_once '../lib/koneksi.php';
require_once '../lib/query.php';
require_once '../db/dbase.php';

$conn = koneksi::make($koneksi);

$db = new query($conn);

$query = isset($_POST['search']) ? $_POST['search'] : "";

$products = $db->selectLike('product', 'nama', $query);
?>
<html>
    <head>
        <title>AUTOFOCUSstore</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <div id="">
            <div class="">
                <h1>
                    welcome to AUTOFOCUS store
                </h1>
            </div>
                <form method="post" action="">
                    <table>
                        <div class="form">
                            <input type="text" id="search" name="search" placeholder="Search"/>
                            <button name="btn-submit">Search</button>
                        </div>
                    </table>
                </form>
            <div class="content">
                <div class="menu">
                    <ul id="nav" align="center">
                        <a href="index.php?p=dashboard">
                            <li>
                                Home
                            </li>
                        </a>
                        <a href="index.php?p=tshirt">
                            <li>
                                t-shirt
                            </li>
                        </a>
                        <a href="index.php?p=shoes">
                            <li>
                                Shoes
                            </li>
                        </a>
                    </ul>
                </div>
                <div class="isi">
                    <?php
                    if (isset($_POST['btn-submit'])) {
                        foreach($products as $p) {
                            echo "Nama Produk : ". $p->nama. " Stok : ". $p->stok;
                            echo "<br>";
                        }
                    }else{
                        $p=isset($_POST['p'])?$_POST['p']:'dashboard';
                        include $p.'.php';
                    }
                        ?>
                </div>
            </div>
            <div class="footer">
                footer
            </div>
        </div>
    </body>
</html>
