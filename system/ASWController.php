<?php 


abstract class ASWController{

    /*
     * Controller dosyası içindeki bütün render işlemlerine gönderilecek olan datalar.
     * */
    protected $renderDatas = [];

    function __construct(){
        $this->baseLoginControl();
        $this->includeModels();
    }

    // PHP DOSYALARINI EKRANA BASAN FONKSİYON
    protected function render($path, $datas=[]){
        ASWView::include($path, array_merge($datas, $this->renderDatas), true, true);
    }

    // PHP DOSYALARINI INCLUDE İŞLEMLERİ OLMADAN EKRANA BASAN FONKSİYON
    protected function simpleRender($path, $datas=[]){
        ASWView::include($path, array_merge($datas, $this->renderDatas), false, false);
    }


    protected function jsonRender($datas = []){
        header('Content-Type: application/json');
        $result = $datas;
        if(is_array($datas) || is_object($datas)){
            $result = json_encode($datas);
        }
        echo $result;
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





    // AUTH CONTROL
    protected function baseLoginControl(){
        $allowNames = ['login'];
        $route = ASWRouter::getRoute();

        if(!in_array($route['name'], $allowNames) && !ASWSession::has('user')){
            redirect('login?to='.ASWRouter::currentUrl(true) );
        }
    }//baseLoginControl


}

?>