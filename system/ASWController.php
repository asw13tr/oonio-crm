<?php 


abstract class ASWController{

    function __construct(){
        $this->includeModels();
    }

    // PHP DOSYALARINI EKRANA BASAN FONKSİYON
    protected function view($path, $datas=[]){
        ASWView::include($path, $datas, true, true);
    }


    // app/models içerisinden model dosyası import etmek.
    // miras alan sınıfta $models içeriğine gerekli modelleri gir.
    protected $models = [];
    protected function includeModels(){
        if(is_array($this->models) && $this->models){
            foreach($this->models as $model){
                require_once(realpath('.').'/app/models/'.$model.'.php');
            }
        }   
    }


}

?>