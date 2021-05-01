<?php 
/*
    $db = new ASWDatabase();
    $db->insert($table, $datas|[col1=>val2, col2=>val2]);

*/
class ASWDatabase extends PDO{


    function __construct(){
        
        $dsn = "DB_DRIVER:host=DB_HOST;port=DB_PORT;dbname=DB_NAME;charset=DB_CHARSET";
        $dsn = str_replace(['DB_DRIVER', 'DB_HOST', 'DB_PORT', 'DB_NAME', 'DB_CHARSET'], [DB_DRIVER, DB_HOST, DB_PORT, DB_NAME, DB_CHARSET], $dsn);
        

        if(DB_NAME && DB_USER){
            try{
                parent::__construct($dsn, DB_USER, DB_PASS);
                $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(Exception $e){
                print_r($e->getMessage());
                exit;
            }
        }

    }//__construct


    // DOĞAL MYSQL KODLARI
    /*
        ->query("SELECT * FROM users WHERE id=1");

        ->query("SELECT * FROM users WHERE id=?", [1]);

        ->query("SELECT * FROM users WHERE id=:id", [':id'=>1]);
    */

    function query($sql, $datas=null){
        $query = parent::prepare($sql);
        $query->execute($datas);
        return $query->fetchAll(PDO::FETCH_CLASS);
    }// query


    function queryOne($sql, $datas=null){
        $query = parent::prepare($sql);
        $query->execute($datas);
        return $query->fetchObject();
    }// queryOne


    function queryMulti($sql, $datas=null){
        $query = parent::prepare($sql);
        $query->execute($datas);
        return $query->fetchObject();
    }// queryOne


    function exec($sql, $datas=null){
        $query = parent::prepare($sql);
        $exec = $query->execute($datas);
        if($exec){
            if(strpos($sql, 'INSERT INTO')===0 || strpos($sql, 'insert into')===0){
                return parent::lastInsertId();
            }else{
                return true;
            }
        }else{
            return false;
        }
    }// exec
    function execute($sql, $datas=null){    return $this->exec($sql, $datas); }
    function run($sql, $datas=null){        return $this->exec($sql, $datas); }





    // KOLAY KULLANIM İÇİN HAZIRLANAN METHODLAR

    // BASİT ŞEKİLDE VERİTABANINA EKLEME İŞLEMİ
    function insert($table, $fields){

        $result = [
            'status' => false,
            'message' => '',
            'sql' => null,
            'lastInsertId' => 0,
            'affectedRows' => 0,
        ];
        
        
        if(!is_array($fields)){
            $result['message'] = 'insert fonksiyonu için gönderilen $fields parametresi dizi tipinde olmalı.';
        }else{

            //$insertFields = [];
            $insertFieldsPre = [];
            foreach($fields as $key => $val){
                //$insertFields[] = $key. '=' .(gettype($val)=='string'? "'$val'" : (gettype($val)=='boolean'? (!$val? 0 : 1) : $val));
                $insertFieldsPre[] = $key.' = :'.$key;
            }
            $insertFieldsStr = implode(', ', $insertFieldsPre);

            $result['sql'] = "INSERT INTO {$table} SET {$insertFieldsStr}";

            $query = parent::prepare($result['sql']);
            $insert = $query->execute($fields);
            if(!$insert){
                $result['message'] = 'SQL kodunda hata var';
            }else{
                $result['status'] = true;
                $result['affectedRows'] = $insert;
                $result['lastInsertId'] = parent::lastInsertId();
            }

        }

        return json_decode( json_encode( $result ) );

    } // insert





}
$db = new ASWDatabase();


?>