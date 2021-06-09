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


    // Rehber kişisini kayıt etmek
    function save(){
        $recordDatas = $_POST;
        if(strlen(post('contact_birth'))<10){
            unset($recordDatas['contact_birth']);
        }
        $recordDatas['contact_extra'] = json_encode($_POST['contact_extra']);
        $recordDatas['contact_mobile'] = str_replace(' ', '', $recordDatas['contact_mobile']);
        $recordDatas['contact_phone'] = str_replace(' ', '', $recordDatas['contact_phone']);
        $contact = new Contact();
        $contact = $contact->create($recordDatas);

        if(!$contact){
            ASWSession::setFlash('flash-danger', 'işlem sırasında beklenmedik bir hata oluştu.');
        }else{
            ASWSession::setFlash('flash-success', 'yeni kayıt eklendi');
        }
        redirect('contacts');
    } //createPost







    // Müşteri bilgileri düzenleme formu
    function edit($id){
        $contact = new Contact( $id );
        if(!$contact->primaryVal){
            ASWSession::setFlash('flash-danger', 'kişi bulunamadı');
            redirect('contacts');
        }else{
            $this->render('contacts/form', [ 'contact' => $contact ]);
        }
    } //edit


    // Müşteri bilgilerini güncellemek
    function update($id){
        $contact = new Contact($id);
        if(!$contact->primaryVal){
            ASWSession::setFlash('flash-danger', 'kişi bulunamadı');
            redirect('contacts');
        }

        $postDatas = $_POST;
        $postDatas['contact_extra'] = json_encode($_POST['contact_extra']);
        $contact = $contact->update($postDatas);

        if(!$contact){
            ASWSession::setFlash('flash-danger', 'kişi güncellenirken bir sorun oluştu');
        }else{
            ASWSession::setFlash('flash-success', 'kişi bilgileri güncellendi');
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
            $result['message'] = _tr('belirtilen müşteri sistemde yok');
            $result['timer'] = 2000;
        }else{
            $delete = $contact->delete();
            if($delete){
                $result = [
                    'status'    => true,
                    'title'     => _tr('hesap silindi'),
                    'message'   => _tr('belirtilen müşteri silindi'),
                    'id'        => $id
                ];
            }
        }
        $this->jsonRender($result);
    } //delete






    // Müşteri Bilgilerini Getirmek
    function popup($id){
        $contact = new Contact( $id );
        if(!$contact->primaryVal){

        }else{
            $this->simpleRender('contacts/popup', [ 'contact' => $contact ]);
        }
    } //edit












}
?>
