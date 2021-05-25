<?php
class  UserController extends ASWController{

    protected $models = ['User'];

    private $loggedUser = [];

    public function __construct(){
        parent::__construct();
        $this->loggedUser = ASWSession::get('user', null);
    }


    // KULLANICI LİSTESİ
    function index(){
        $user = new User();
        $datas = [
            'users' => $user->findAll('ORDER BY user_id DESC')
        ];
        $this->render('users/index', $datas);

    }







    // KULLANICI OLUŞTURMA FORMU
    function create(){
        $this->render('users/create');
    } //create


    // YENİ KULLANICIYI VERİTABANINA KAYIT ETMEK
    function createPost(){
        $postDatas = $_POST;
        $postDatas['user_password'] = ASWHelper::encryptPass($_POST['user_password']);
        $postDatas['user_status'] = isset($_POST['user_status'])? 1 : 0;

        $user = new User();
        $user = $user->create($postDatas);

        if(!$user->user_id){
            ASWSession::setFlash('flash-danger', 'işlem sırasında beklenmedik bir hata oluştu.');
        }else{
            ASWSession::setFlash('flash-success', 'yeni kullanıcı oluşturuldu.');
        }
        redirect('users');
    } //createPost







    // KULLANICI DÜZENLEME FORMU
    function edit($id){
        $user = new User( $id );
        if(!$user->primaryVal){
            ASWSession::setFlash('flash-danger', 'kullanıcı bulunamadı');
            redirect('users');
        }else{
            $this->render('users/edit', [ 'user' => $user ]);
        }
    } //edit


    // KULLANICI HESABI GÜNCELLEME FONKSİYONU
    function editPost($id){
        $user = new User($id);
        if(!$user->primaryVal){
            ASWSession::setFlash('flash-danger', 'kullanıcı bulunamadı');
            redirect('users');
        }

        $postDatas = $_POST;
        $postDatas['user_status'] = isset($_POST['user_status'])? 1 : 0;

        unset($postDatas['user_password']);
        if(isset($_POST['user_password']) && strlen($_POST['user_password']) > 4){
            $postDatas['user_password'] = ASWHelper::encryptPass($_POST['user_password']);
        }

        $user = $user->update($postDatas);
        if(!$user){
            ASWSession::setFlash('flash-danger', 'kullanıcı hesabı güncellenirken bir sorun oluştu');
        }else{
            ASWSession::setFlash('flash-success', 'kullanıcı hesabı güncellendi');
        }
        redirect('user.edit', ['id'=>$user->user_id]);
    }







    // KULLANICI HESABI SİLMEK
    function delete($id){
        $user = new User($id);
        $result = [
            'status' => false,
            'title' => _tr('bir sorun oluştu'),
            'message' => _tr('sistemde beklenmedik bir sorun oluştu ve işlem gerçekleşemedi')
        ];
        if(!$user->primaryVal){
            $result['message'] = _tr('belirtilen hesap sistemde yok');
            $result['timer'] = 2000;
        }elseif($this->loggedUser->user_id==$id || $this->loggedUser->user_level<=$user->user_level){
            $result['message'] = _tr('bu hesabı silme yetkiniz yok');
            $result['timer'] = 2000;
        }else{
            $delete = $user->delete();
            if($delete){
                $result = [
                    'status'    => true,
                    'title'     => _tr('hesap silindi'),
                    'message'   => _tr('belirtilen kullanıcı hesabı silindi'),
                    'id'        => $id
                ];
            }
        }
        $this->jsonRender($result);
    } //delete







    // KULLANICI DURUMUNU DEĞİŞTİRMEK
    function changeStatus($id){
      $user = new User($id);
      $result = [
          'status' => false,
          'title' => 'işlem başarısız',
          'message' => 'sistemde beklenmedik bir hata oluştu'
      ];
      if(!$user->primaryVal){

      }else{
          $newStatus =  !$user->user_status? 1 : 0;
          $user = $user->update(['user_status' => $newStatus]);
          if(!$user){

          }else{
              $result = [
                  'status' => true,
                  'title' => 'durum değiştirildi',
                  'message' => 'kullanıcı hesabı durumu değiştirildi.',
                  'id' => $user->user_id,
                  'newStatus' => $newStatus
              ];
          }
      }
      $this->jsonRender($result);
    } //changestatus









}
?>
