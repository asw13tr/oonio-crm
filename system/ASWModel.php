<?php 

/*
  *
  * extends edilir.

    $table = 'DB tablo adı';
    $primaryKey = 'tablodaki birincil anahtar hücre adı'
    $columns = Dizi olarak tablodan çişlem görecek ve çekilecek hücre isimleri


    *
    * new ModelName($id)   // find methodunu çağırarak başlar
    * new ModelName(Array) // İçerisine gönderilen array ile kendini doldurur.
    * new ModelName(Object) // İçerisine gönderilen object ile kendini doldurur.
    *
    * ->find(id);          // TEKLİ OBJE DÖNDÜRÜR.
    * ->find( [3,5,7] );   // DİZİ DÖNDÜRÜR
    *
    *
    * ->findAll('sql')
    * ->findAll('sql ?,?,?', [x, y, z] );
    * ->findAll('sql :key=val', ['key'=> $val] );
  *
  *
  * */

    abstract class ASWModel{

        protected $table;
        protected $primaryKey;
        public $primaryVal;
        protected $columns;

        function __construct($data4Fill=null){
            $this->setClassVariables();

            if(is_numeric($data4Fill)){
                $this->fillWithId($data4Fill);

            }elseif(is_array($data4Fill)){
                $this->fillWidthArray($data4Fill);

            }elseif(is_object($data4Fill)){
                $this->fillWidthObject($data4Fill);

            }else{

            }
        } //__construct



        //SINIF İÇİ İŞLEMLER

        // SINIF İÇERİSİNDE DEĞİŞKENLER OLUŞTURUR.
        function extractColumns(){ if(is_array($this->columns)){ foreach($this->columns as $key => $val){ $this->$val = null; } }  }

        /*
         * Alt sınıflarda tanımsız değişken hatası almamak için, sınıf değişkenlerine varsayılan değerler atanıyor.
         * Bu kodun çalışması için her alt sınıfta __construct methodunda parent::__construct() komutu çalıştırılmalıdır.
         */
        private function setClassVariables(){
            $this->primaryVal = null;
        } //setClassVariables




        // Obje ile nesneyi doldurmak.
        function fillWidthObject($object=null){
            if($object && is_object($object)){
                foreach($object as $key => $val){
                    $this->$key = $val;

                    if($key==$this->primaryKey){
                        $this->primaryVal = $val;
                    }
                }
            }
        } // fillWidthObject

        // Array göndererek nesneyi doldurmak
        function fillWidthArray($array=null){
            if($array && is_array($array)){
                foreach($array as $key => $val){
                    $this->$key = $val;

                    if($key==$this->primaryKey){
                        $this->primaryVal = $val;
                    }
                }
            }
        }

        // ID ile databaseden çekerek nesneyi doldurmak
        function fillWithId($id){
            $fields = $this->find( intval($id) );
            if($fields){
                foreach($fields as $key => $val){
                    if(in_array($key, $this->columns)){
                        $this->$key = $val;

                        if($key==$this->primaryKey){
                            $this->primaryVal = $val;
                        } //if
                    } //if
                } //foreach
            } //if
        }//fillWithId





        // VERİTABANI İŞLEMLERİ

        function getDB(){
            return new ASWDatabase();
        }

        // SAVE
        function save(){
            $sqlDatas = [];
            // TODO: Bu alandaki update işlemini password gibi alanları boş kabul edecek ancak description gibi bölümleride boşa güncelleyecek şekilde ayarlamak gerek.
            /*
            foreach ($this->columns as $colName){
                if($colName != $this->primaryKey && !empty($this->$colName)){
                    $sqlDatas[$colName] = $this->$colName;
                } //if
            } //foreach
            */
            if(@$this->primaryVal > 0){
                $result = $this->update($sqlDatas);
            }else{
                $result = $this->create($sqlDatas);
            }

            return $result;
        } //save






        // CREATE
        function create($datas){
            if(!is_array($datas)){
                return '$datas bir array değil.';
            }else{
                $insertDatas = [];
                $setDatas = [];

                foreach($datas as $k => $v){
                    if(in_array($k, $this->columns)){
                        $insertDatas[$k] = $v;
                        $setDatas[] = "{$k}=:{$k}";
                    }
                }
                $setDatasStr = implode(', ', $setDatas);

                $db = $this->getDB();
                $query  = $db->prepare("INSERT INTO {$this->table} SET {$setDatasStr}");
                $exec   = $query->execute($insertDatas);
                return !$exec? false : $this->find( intval($db->lastInsertId()) );
            }
        } //create






        // UPDATE
        function update($datas){
            if(!is_array($datas)){
                return '$datas bir array değil.';
            }else{
                $executeDatas = ['primary_key_val'=>$this->primaryVal];
                $setDatas = [];

                foreach($datas as $k => $v){
                    if(in_array($k, $this->columns)){
                        $executeDatas[$k] = $v;
                        $setDatas[] = "{$k}=:{$k}";
                    }
                }
                $setDatasStr = implode(', ', $setDatas);

                $db = $this->getDB();
                $query  = $db->prepare("UPDATE {$this->table} SET {$setDatasStr} WHERE {$this->primaryKey}=:primary_key_val");
                $exec   = $query->execute($executeDatas);
                return !$exec? false : $this->find( intval($this->primaryVal) );
            }
        } //update






        // DELETE
        function delete($id=null){
            if(is_array($id)){
                $this->deleteMulti($id);
            }elseif(gettype($id)=='integer'){
                $this->deleteOne($id);
            }else{
                $primaryColName = $this->primaryKey;
                $id = $this->$primaryColName;
                if(!$id){

                }else{
                    $this->deleteOne($id);
                }
            }
        } //delete


            // DELETE ONE
            function deleteOne($id){
                $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey}=:id";
                $query = $this->getDB()->prepare($sql);
                return $query->execute(['id'=>$id]);
            } //deleteOne

            // DELETE MULTI
            function deleteMulti($ids){

            } //deleteMulti






        // FIND
        /*
         * ->find(id);          // TEKLİ OBJE DÖNDÜRÜR. DEĞİŞKENE ATAMA YAPMADAN DA VERİLER AYNI OBJEYE ÇEKİLİR.
         * ->find( [3,5,7] );   // DİZİ DÖNDÜRÜR
         * ->find('sql')
         * ->find('sql ?,?,?', [x, y, z])
         * ->find('sql :key=val', ['key'=> $val] );
         * */
        function find($idOrSql, $params=null){
            switch (gettype($idOrSql)){
                case 'integer':     return $this->findSingle($idOrSql); break;
                case 'array':       return $this->findMulti($idOrSql); break;
                case 'string':      return $this->findSql($idOrSql, $params); break;
                default:            return null; break;
            }
        }

        // FIND SINGLE
        function findSingle($id){
            $sql    = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} IN (?)";
            $query  = $this->getDB()->prepare($sql);
            $execute = $query->execute([$id]);
            return !$execute? false : $query->fetchObject(get_class($this));
        }

        // FIND MULTI
        function findMulti($ids){
            $params = implode(',', array_fill(0, count($ids), '?'));
            $sql    = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} IN ($params)";
            $query  = $this->getDB()->prepare($sql);
            $execute = $query->execute($ids);
            return !$execute? false : $query->fetchAll(PDO::FETCH_CLASS, get_class($this));
        }

        // FIND SQL
        function findSql($sql, $params=null){
            $query = $this->getDB()->prepare($sql);
            $execute = $query->execute($params);
            return !$execute? false : $query->fetchAll(PDO::FETCH_CLASS, get_class($this));
        }





        // FIND ALL
        /*
         * ->findAll('sql')
         * ->findAll('sql ?,?,?', [x, y, z] );
         * ->findAll('sql :key=val', ['key'=> $val] );
         *
         * */
        function findAll($extraSql=null, $params=null){
            $sql = "SELECT * FROM {$this->table} {$extraSql}";
            return $this->findSql($sql, $params);
        } 


        // Sql kodu çalıştırarak veri getiren kod



    }
?>