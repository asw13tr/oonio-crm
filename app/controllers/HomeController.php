<?php 

class HomeController extends ASWController{

    protected $models = ['User'];

    function index(){
        $this->render('index');

    }   

}
?>