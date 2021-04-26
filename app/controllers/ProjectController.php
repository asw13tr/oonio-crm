<?php
/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    19.04.2021 17:31
 */

class ProjectController extends ASWController{


    protected $models = ['Project', 'User', 'Contact', 'ProjectTag'];





    // PROJE LİSTESİ
    function index(){
        $project = new Project();
        $datas = [
            'projects' => $project->findAll('ORDER BY project_id DESC')
        ];
        $this->render('projects/index', $datas);

    }







    // YENİ PROJE OLUŞTURMA FORMU
    function create(){
        $tag = new ProjectTag();
        $user = new User();
        $contact = new Contact();

        $datas = [
            'tags' => $tag->findAll('ORDER BY tax_val ASC'),
            'users' => $user->findAll('ORDER BY user_slug ASC'),
            'contacts' => $contact->findAll('ORDER BY contact_name ASC')
        ];
        $this->render('projects/create', $datas);
    } //create


    // Rehber kişisini kayıt etmek
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


}


?>