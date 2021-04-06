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
    } //create

    function createPost(){
        $postDatas = $_POST;
        $postDatas['user_password'] = ASWHelper::encryptPass($_POST['user_password']);
        $postDatas['user_status'] = isset($_POST['user_status'])? 1 : 0;

        $user = new User($postDatas);
        $user = $user->save();

        if(!$user->user_id){
            ASWSession:setFlash();
        }else{

        }
        redirect('users');
    } //createPost






    function edit($id){
        $user = new User( $id );
        if(!$user->primaryVal){
            redirect('users');
        }else{
            $this->view('users/edit', [ 'user' => $user ]);
        }
    } //edit

    function editPost($id){
        $user = new User($id);
        if(!$user->primaryVal){
            // TODO: Kullanıcı bulanamadı mesajı ile kullanıcı listesine yönlendirme yap
        }

        $postDatas = $_POST;
        $postDatas['user_status'] = isset($_POST['user_status'])? 1 : 0;

        unset($postDatas['user_password']);
        if(isset($_POST['user_password']) && strlen($_POST['user_password']) > 4){
            $postDatas['user_password'] = ASWHelper::encryptPass($_POST['user_password']);
        }

        $user = $user->update($postDatas);
        if(!$user){
            // TODO: Kullanıcı güncellenemedi hatası ile birlikte kullanıcı edit sayfasına yönlendir.
        }else{
            // TODO: Kullanıcı güncellendi bilgisi ile birlikte kullanıcı edit sayfasına yönlendir.
        }
        redirect('user.edit', ['id'=>$user->user_id]);
    }





    function delete(){
        $this->view('users/delete');
    }
    function deletePost(){
        $this->view('users/delete');
    }


}
?>
