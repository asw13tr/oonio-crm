<?php
/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    19.04.2021 17:31
 */

class ProjectController extends ASWController{


    protected $models = ['Project', 'User', 'Contact', 'ProjectTag', 'ProjectData'];
    protected $renderDatas = [
        'Title' => 'Projeler',
        'footerScripts' => ['/static/js/projects.js']
    ];



    private function getConnectionsForForm(){
        $tag = new ProjectTag();
        $user = new User();
        $contact = new Contact();

        return [
            'tags' => $tag->findAll('ORDER BY tax_val ASC', null, 'tax_id, tax_val', true),
            'users' => $user->findAll('ORDER BY user_slug ASC', null, 'user_id, user_slug, user_name', true),
            'contacts' => $contact->findAll('ORDER BY contact_name ASC', null, 'contact_id, contact_name', true)
        ];
    }




    // PROJE LİSTESİ
    function index(){
        $project = new Project();
        $datas = [
            'projects' => $project->findAll('ORDER BY project_id DESC'),
        ];
        $this->render('projects/index', $datas);

    }






    // PROJE DETAYLARI
    function show($id){
        $project = new Project( $id );
        if(!$project->primaryVal){
            echo "false";
        }else{
            $datas = array_merge([
                'project' => $project,
            ], $this->getConnectionsForForm());
            $this->render('projects/show', $datas);
        }
    } //detail







    // YENİ PROJE OLUŞTURMA FORMU
    function create(){
        $tag = new ProjectTag();
        $user = new User();
        $contact = new Contact();

        $datas = $this->getConnectionsForForm();

        $this->render('projects/form', $datas);
    } //create


    // PROJEYİ KAYI ETMEK
    function save(){
        $postDatas = $_POST;
        $postDatas['project_extra'] = json_encode($_POST['project_extra']);
        $project = new Project();
        $project = $project->create($postDatas);

        if(!$project){ // Proje veritabanına eklenemedi.
            ASWSession::setFlash('flash-danger', 'işlem sırasında beklenmedik bir hata oluştu.');
        }else{
            $project->connectTables('project_taxonomy', 'tax_id', $_POST['project_tags'] );
            $project->connectTables('project_users', 'user_id', $_POST['project_users'] );
            $project->connectTables('project_contacts', 'contact_id', $_POST['project_contacts'] );
            ASWSession::setFlash('flash-success', 'yeni proje oluşturuldu');
        }
        redirect('projects');
    } //save







    // Müşteri bilgileri düzenleme formu
    function edit($id){
        $project = new Project( $id );
        if(!$project->primaryVal){
            ASWSession::setFlash('flash-danger', 'aranan proje bulunamadı');
            redirect('projects');
        }else{
            $datas = array_merge([
                'project' => $project,
            ], $this->getConnectionsForForm());

            $this->render('projects/form', $datas);
        }
    } //edit


    // Proje bilgilerini güncellemek
    function update($id){
        $project = new Project( $id );
        if(!$project->primaryVal){
            ASWSession::setFlash('flash-danger', 'güncellenecek bir proje bulunamadı');
            redirect('projects');
        }

        $postDatas = $_POST;
        $postDatas['project_extra'] = json_encode($_POST['project_extra']);
        $project = $project->update($postDatas);

        if(!$project){ // Proje güncellenemedi.
            ASWSession::setFlash('flash-danger', 'işlem sırasında beklenmedik bir hata oluştu.');
        }else{
            $project->connectTables('project_taxonomy', 'tax_id', $_POST['project_tags'] );
            $project->connectTables('project_users', 'user_id', $_POST['project_users'] );
            $project->connectTables('project_contacts', 'contact_id', $_POST['project_contacts'] );
            ASWSession::setFlash('flash-success', 'proje bilgileri güncellendi');
        }
        redirect('project.edit', ['id'=>$project->project_id]);
    } //update







    // Projeyi Silmek
    function delete($id){
        $project = new Project($id);
        $result = [
            'status' => false,
            'title' => _tr('bir sorun oluştu'),
            'message' => _tr('sistemde beklenmedik bir sorun oluştu ve işlem gerçekleşemedi')
        ];
        if(!$project->primaryVal){
            $result['message'] = _tr('belirtilen proje sistemde yok');
            $result['timer'] = 2000;
        }else{
            $delete = $project->delete();
            if($delete){
                $project->deleteConnections($id);
                $result = [
                    'status'    => true,
                    'title'     => _tr('proje silindi'),
                    'message'   => _tr('belirtilen proje sistemden silindi'),
                    'id'        => $id
                ];
            }
        }
        $this->jsonRender($result);
    } //delete


    function popup($id){
        $project = new Project( $id );
        if(!$project->primaryVal){
            echo "false";
        }else{
            $datas = array_merge([
                'project' => $project,
            ], $this->getConnectionsForForm());
            $this->simpleRender('projects/show', $datas);
        }
    } //popup






}


?>