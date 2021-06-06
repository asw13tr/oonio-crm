<?php 
class TaskController extends ASWController{


    function index(){
        $this->render('tasks/index');
    }

    



    function create(){
        $this->render('tasks/create');
    }

    function createPost(){
        $this->render('tasks/create');
    }






    function edit(){
        $this->render('tasks/edit');
    }

    function editPost(){
        $this->render('tasks/edit');
    }


    


    function delete(){
        $this->render('tasks/delete');
    }
    function deletePost(){
        $this->render('tasks/delete');
    }
    

}
?>