<?php 
class TodoController extends ASWController{


    function index(){
        $this->render('todo/index');
    }

    



    function create(){
        $this->render('todo/create');
    }

    function createPost(){
        $this->render('todo/create');
    }






    function edit(){
        $this->render('todo/edit');
    }

    function editPost(){
        $this->render('todo/edit');
    }


    


    function delete(){
        $this->render('todo/delete');
    }
    function deletePost(){
        $this->render('todo/delete');
    }
    

}
?>