<?php
class  UserController extends ASWController{

    protected $models = ['User'];

    function index(){
        $user = new User();
        $datas = [
            'users' => $user->findAll('ORDER BY user_id DESC')
        ];
        $this->view('users/index', $datas);

    }





    function create(){
        $this->view('users/create');
    }

    function createPost(){
        $postDatas = $_POST;
        $postDatas['user_password'] = ASWHelper::encryptPass($_POST['user_password']);
        $postDatas['user_status'] = isset($_POST['user_status'])? 1 : 0;

        $user = new User($postDatas);
        $user = $user->save();

        if(!$user->user_id){
            print_r($user);
        }else{
            redirect('users');
        }
    }






    function edit($id){

        $user = new User( $id );
        echo '<pre>';
        print_r($user);
        exit;
        $this->view('users/edit');
    }

    function editPost(){
        $this->view('users/edit');
    }





    function delete(){
        $this->view('users/delete');
    }
    function deletePost(){
        $this->view('users/delete');
    }


}
?>
