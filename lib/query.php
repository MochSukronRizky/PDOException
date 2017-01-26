<?php
class query{
    protected $pdo;

    public function __construct($pdo){
        $this->pdo=$pdo;
    }
    public function select($tabel,$kolom=[]){
        if($kolom !=null){
            $kolom = implode(",",$kolom);
        }else{
            $kolom = '*' ;
        }


        $urute = $this->pdo->prepare("select {$kolom} from {$tabel}");
        $urute->execute();

        return $urute->fetchAll(PDO::FETCH_CLASS);
    }


    public function selectLike($tabel,$kolom="", $value=""){

        $urute = $this->pdo->prepare("select * from {$tabel} where {$kolom} like '%{$value}%'");
        $urute->execute();

        return $urute->fetchAll(PDO::FETCH_CLASS);
    }

    public function create($tabel,$id_product,$name,$stok,$img,$keterangan,$level)
    {
        try{
            $urute = $this->pdo->prepare("INSERT INTO {$tabel} VALUES(:id_product, :name, :stok, :img, :keterangan, :level)");
            $urute->bindparam(":id_product",$id_product);
            $urute->bindparam(":name",$name);
            $urute->bindparam(":stok",$stok);
            $urute->bindparam(":img",$img);
            $urute->bindparam(":keterangan",$keterangan);
            $urute->bindparam(":level",$level);
            $urute->execute();

            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id,$tabel)
    {
        $urute = $this->pdo->prepare("SELECT * FROM {$tabel} where id = :id");
        $urute->execute(array(":id => $id"));
        return $editRow;
    }

    public function delete($tabel,$id){
        $urute = $this->pdo->prepare("DELETE FROM {$tabel} WHERE id=:id");
        $urute->bindparam(":id",$id);
        $urute->execute();
        return true;
    }
    public function update($tabel, $id, $name, $stok, $img, $keterangan, $level)
    {
        try{
            $urute = $this->pdo->prepare("UPDATE ($tabel) SET
                name=:name,
                stok=:stok,
                img=:img,
                keterangan=:keterangan,
                level=:level
                WHERE id=:id
                ");
            $urute->bindparam(":nama",$nama);
            $urute->bindparam(":stok",$stok);
            $urute->bindparam(":img",$img);
            $urute->bindparam(":keterangan",$keterangan);
            $urute->bindparam(":level",$level);
            $urute->bindparam(":id",$id);
            $urute->execute();

            return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    public function dataVIew($query)
    {
        $urute = $this->pdo->prepare($query);
        $urute->execute();

        if($urute->rowCount()>0)
        {
            while ($row=$urute->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?php print($row['id']); ?></td>
                        <td><?php print($row['nama']); ?></td>
                        <td><?php print($row['stok']); ?></td>
                        <td><?php print($row['img']); ?></td>
                        <td><?php print($row['keterangan']); ?></td>
                        <td><?php print($row['level']); ?></td>
                        <td align="center">
                            <a href="../admin/edit-data.php?edit_id=<?php print($row['id']); ?>">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                        </td>
                        <td>
                            <a href="../admin/delete.php?delete_id=<?php print($row['id']); ?>">
                                <i class="glyphicon glyphicon-remove-circle"></i>
                            </a>
                        </td>
                    </tr>
                <?php
            }
        }
        else
        {
            ?>
                <tr>
                    <td>Nothing here...</td>
                </tr>
            <?php
        }
    }

    public function paging($query,$record_per_page)
    {
        $mulai_tempat = 0;
        if(isset($_POST['page_no']))
        {
            $mulai_tempat=($_POST['page_no']-1) *$record_per_page;
        }
        $query2=$query." limit $mulai_tempat,$record_per_page";

        return query2;
    }

    public function pagingLink($query,$record_per_page)
    {
        $self = $_SERVER['PHP_SELF'];

        $urute = $this->pdo->prepare($query);
        $urute->execute();

        $ttl_no_of_records = $urute->rowCount();

        if($ttl_no_of_records>0)
        {
            ?>
                <ul class="pagingnation">
            <?php
            $ttl_no_of_pages=ceil($ttl_no_of_records/$record_per_page);
            $curent_page=1;
            if(isset($_POST['page_no'])){
                $curent_page=$_POST['page_no'];
            }
            if($curent_page !=1)
            {
                $previous = $curent_page-1;
                echo "<li><a href='".$self."?page_no=1'>First</a></li>";
                echo "<li><a href='".$self."?page_no=".$previous."'>previous</a></li>";
            }
            for ($i=1; $i<=$ttl_no_of_pages ; $i++)
            {
                if($i==$curent_page)
                {
                    echo "<li><a href='".$self."?page_no=".$i."' style='color:white;text-decoration:none;'>".$i."</a></li>";
                }
                else
                {
                    echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
                }
            }
            if($curent_page!=$ttl_no_of_pages)
            {
                $next=$curent_page+1;
                echo "<li><a href='".$self."page_no=".$next."'>next</a></li>";
                echo "<li><a href='".$self."page_no=".$ttl_no_of_pages."'>Last</a></li>";
            }
            ?></ul><?php
        }
    }

    public function barang($tabel,$kolom="", $value=""){

        $urute = $this->pdo->prepare("select * from {$tabel} where {$kolom}");
        $urute->execute();

        return $urute->fetchAll(PDO::FETCH_CLASS);

    }

    public function insert($tabel,$ukuran){
        $query = sprintf(
            'insert into %s (%s) values (%s)',
            $tabel,
            implode(', ', array_keys($ukuran)),
            ':'.implode(', :',array_keys($ukuran))
            );

        try{
            $urute = $this->pdo->prepare($query);
            $urute->execute($ukuran);

            return true;
        }catch(\Exception $e){
            return false;
        }
    }
}
