<?php class CustomerController extends ASWController{

    function index(){
        $this->view('customers/index');
    }

    



    function create(){
        $this->view('customers/create');
    }

    function createPost(){
        $this->view('customers/create');
    }






    function edit(){
        $this->view('customers/edit');
    }

    function editPost(){
        $this->view('customers/edit');
    }


    


    function delete(){
        $this->view('customers/delete');
    }
    function deletePost(){
        $this->view('customers/delete');
    }


}

?>