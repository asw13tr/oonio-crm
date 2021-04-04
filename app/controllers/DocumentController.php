<?php 
class DocumentController extends ASWController{


    function index(){
        $this->view('documents/index');
    }

    



    function create(){
        $this->view('documents/create');
    }

    function createPost(){
        $this->view('documents/create');
    }






    function edit(){
        $this->view('documents/edit');
    }

    function editPost(){
        $this->view('documents/edit');
    }


    


    function delete(){
        $this->view('documents/delete');
    }
    function deletePost(){
        $this->view('documents/delete');
    }
    

}
?>