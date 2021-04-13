<?php 
class DocumentController extends ASWController{


    function index(){
        $this->render('documents/index');
    }

    



    function create(){
        $this->render('documents/create');
    }

    function createPost(){
        $this->render('documents/create');
    }






    function edit(){
        $this->render('documents/edit');
    }

    function editPost(){
        $this->render('documents/edit');
    }


    


    function delete(){
        $this->render('documents/delete');
    }
    function deletePost(){
        $this->render('documents/delete');
    }
    

}
?>