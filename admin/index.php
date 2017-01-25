<?php
require_once '../lib/koneksi.php';
require_once '../lib/query.php';
require_once '../db/dbase.php';

$conn = koneksi::make($koneksi);

$db = new query($conn);

$query = isset($_POST['search']) ? $_POST['search'] : "";

//$tambah = $db->isnsert($_POST)

$img=isset($_POST['img'])?$_POST['img']:"";

$products = $db->selectLike('product', 'nama', $query);

$listbrg = $db->barang('product', 'level', $query);

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
            <div>
                <form method="post" action="">
                    <div class="form">
                        <button name="btn-signOut" style="float:right;">Sign Out</button>
                            <input type="text" id="search" name="search" placeholder="Search"/>
                        <button name="btn-submit">Search</button>
                    </div>
                    <div class="bgmn">
                        <div class="dropdown">
                            <button class="dropbtn" style="width:auto;">
                                <a href="index.php?p=edtUsr">edit user</a>
                            </button>
                        </div>
                        <div class="dropdown">
                            <button class="dropbtn" style="width:auto;">
                                <a href="index.php?p=frmTambahBrng">Tambah Barang</a>
                            </button>
                        </div>
                        <div class="dropdown">
                            <button class="dropbtn" style="width:auto;">
                                <a href="index.php?p=edtBrng">Edit barang</a>
                            </button>
                        </div>
                        <div class="dropdown">
                            <button class="dropbtn" style="width:auto;">
                                <a href="index.php?p=frmTambahUser">Tambah user</a>
                            </button>
                        </div>
                    </div>
                </form>
                </div>
                <div class="content">
                    <ul id="nav">
                        <div class="isi">
                            <?php
                            if (isset($_POST['btn-submit'])) {
                                foreach($products as $p) {
                            ?>
                            <table>
                                <tr>
                                    <td>
                                    <?php
                                        echo "Nama Produk : ". $p->nama;
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <?php
                                        echo " Stok : ". $p->stok;
                                        echo "<br>";

                                        echo "<img src=".$p->img.">";
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php
                                            echo "<img src=".$p->img.">";
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php
                                            echo "<button name='btn-dtl' style='width:100%;'>Detail</button>";
                                            echo "<script>location 'index.php?p=detail';</script>";
                                            ?>
                                    </td>
                                </tr>
                            </table>
                        <?php
                            }
                        }else{
                            $p=isset($_POST['p'])?$_POST['p']:'dashboard';
                            include $p.'.php';
                        }
                        ?>
                            </div>
                        <div class="menu">
                            <a href="index.php?p=dashboard"><li>Home</li></a>
                            <a href="index.php?p=tshirt"><li>T - Shirt</li></a>
                            <a href="index.php?p=shoes"><li>Shoes</li></a>
                        </div>
                    </ul>
                </div>
            </div>
            <div class="footer">
                footer
            </div>
        </div>
    </body>
</html>
