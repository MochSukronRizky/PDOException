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
/*
    public function deleteTabel($tabel,$kolom,$filed){
        if($tabel){
            $query = sprintf('DROP TABLE',$tabel);

            try{
                $this->pdo;
            }
        }elseif ($kolom) {
            $query = sprintf('ALTER TABLE {$tabel} DROP {$field}')
        }
    }

    public function deleteKolom($kolom){
        $query =
    }

    public function update($tabel,$kolom)
*/
}
