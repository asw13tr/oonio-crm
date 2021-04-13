<?php
class  ContactController extends ASWController{

    protected $models = ['Contact'];





    // REHBER
    function index(){
        $contact = new Contact();
        $datas = [
            'contacts' => $contact->findAll('ORDER BY contact_name DESC')
        ];
        $this->render('contacts/index', $datas);

    }







    // REHBERE EKLEME FORMU
    function create(){
        $this->render('contacts/form');
    } //create


    // REHBERE KİŞİ EKLEME İŞLEMİ
    function save(){
        $postDatas = $_POST;
        $postDatas['contact_extra'] = json_encode($_POST['contact_extra']);
        $contact = new Contact();
        $contact = $contact->create($postDatas);

        if(!$contact){
            ASWSession::setFlash('flash-danger', 'işlem sırasında beklenmedik bir hata oluştu.');
        }else{
            ASWSession::setFlash('flash-success', 'yeni kayıt eklendi');
        }
        redirect('contacts');
    } //createPost







    // KULLANICI DÜZENLEME FORMU
    function edit($id){
        $contact = new Contact( $id );
        if(!$contact->primaryVal){
            ASWSession::setFlash('flash-danger', 'kişi bulunamadı');
            redirect('contacts');
        }else{
            $this->render('contacts/form', [ 'contact' => $contact ]);
        }
    } //edit


    // KULLANICI HESABI GÜNCELLEME FONKSİYONU
    function editPost($id){
        $contact = new Contact($id);
        if(!$contact->primaryVal){
            ASWSession::setFlash('flash-danger', 'kullanıcı bulunamadı');
            redirect('contacts');
        }

        $postDatas = $_POST;
        $postDatas['contact_status'] = isset($_POST['contact_status'])? 1 : 0;

        unset($postDatas['contact_password']);
        if(isset($_POST['contact_password']) && strlen($_POST['contact_password']) > 4){
            $postDatas['contact_password'] = ASWHelper::encryptPass($_POST['contact_password']);
        }

        $contact = $contact->update($postDatas);
        if(!$contact){
            ASWSession::setFlash('flash-danger', 'kullanıcı hesabı güncellenirken bir sorun oluştu');
        }else{
            ASWSession::setFlash('flash-success', 'kullanıcı hesabı güncellendi');
        }
        redirect('contact.edit', ['id'=>$contact->contact_id]);
    }







    // Müşteri Hesabını Silmek
    function delete($id){
        $contact = new Contact($id);
        $result = [
            'status' => false,
            'title' => _tr('bir sorun oluştu'),
            'message' => _tr('sistemde beklenmedik bir sorun oluştu ve işlem gerçekleşemedi')
        ];
        if(!$contact->primaryVal){
            $result['message'] = _tr('belirtilen hesap sistemde yok');
            $result['timer'] = 2000;
        }else{
            $delete = $contact->delete();
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
        $contact = new Contact($id);
        $result = [
            'status' => false,
            'title' => 'işlem başarısız',
            'message' => 'sistemde beklenmedik bir hata oluştu'
        ];
        if(!$contact->primaryVal){

        }else{
            $newStatus =  !$contact->contact_status? 1 : 0;
            $contact = $contact->update(['contact_status' => $newStatus]);
            if(!$contact){

            }else{
                $result = [
                    'status' => true,
                    'title' => 'durum değiştirildi',
                    'message' => 'kullanıcı hesabı durumu değiştirildi.',
                    'id' => $contact->contact_id,
                    'newStatus' => $newStatus
                ];
            }
        }
        $this->jsonRender($result);
    } //changestatus









}
?>
