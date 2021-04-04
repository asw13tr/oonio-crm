<?php 
class TodoController extends ASWController{


    function index(){
        $this->view('todo/index');
    }

    



    function create(){
        $this->view('todo/create');
    }

    function createPost(){
        $this->view('todo/create');
    }






    function edit(){
        $this->view('todo/edit');
    }

    function editPost(){
        $this->view('todo/edit');
    }


    


    function delete(){
        $this->view('todo/delete');
    }
    function deletePost(){
        $this->view('todo/delete');
    }
    

}
?>