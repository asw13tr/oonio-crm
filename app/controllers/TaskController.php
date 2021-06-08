<?php 
class TaskController extends ASWController{

    protected $models = ['Task', 'Project', 'User', 'Contact'];
    protected $renderDatas = [
        'Title' => 'Görevler',
        'footerScripts' => ['/static/js/tasks.js']
    ];

    private function findTasks($where=''){
        $task = new Task();
        $selectedColumns = 'tasks.*, u.user_name, p.project_title';
        $extraSql = 'LEFT JOIN users AS u ON u.user_id=tasks.task_user LEFT JOIN projects AS p ON p.project_id=tasks.task_project '.$where.' ORDER BY task_importance DESC, task_order ASC';
        return $task->findAll($extraSql, null, $selectedColumns);
    } //findTasks

    // GÖREV LİSTESİ
    function index(){
        $datas = [
            'tasks' => $this->findTasks(),
        ];
        $this->render('tasks/index', $datas);
    }


    function filter($key, $val){
        $where = "WHERE tasks.task_{$key}='{$val}'";
        $datas = [
            'tasks' => $this->findTasks($where),
        ];
        $this->render('tasks/index', $datas);
    } // filter







    function show($id){
        $task = new Task( $id );
        if(!$task->primaryVal){
            echo "false";
        }else{
            $datas = array_merge([
                'task' => $task,
            ], $this->getConnectionsForForm());
            $this->render('tasks/show', $datas);
        }
    } //show

    function popup($id){
        $task = new Task( $id );
        if(!$task->primaryVal){
            echo "false";
        }else{
            $datas = array_merge([
                'task' => $task,
            ], $this->getConnectionsForForm());
            $this->simpleRender('tasks/show', $datas);
        }
    } //popup










    // YENİ GÖREV OLUŞTURMA FORMU
    function create(){
        $datas = $this->getConnectionsForForm();
        $this->render('tasks/form', $datas);
    } //create


    // YENİ GÖREVİ KAYIT ETMEK
    function save(){
        $recordDatas = $_POST;
        $recordDatas['task_extra'] = json_encode(post('task_extra', []));
        $recordDatas['task_author'] = ASWSession::get('user')->user_id;
        $task = new Task();
        $task = $task->create($recordDatas);

        if(!$task){ // görev veritabanına eklenemedi.
            ASWSession::setFlash('flash-danger', 'işlem sırasında beklenmedik bir hata oluştu.');
        }else{
            $task->connectTables('task_contacts', 'contact_id', $_POST['task_contacts'] );
            ASWSession::setFlash('flash-success', 'yeni görev oluşturuldu');
        }
        redirect('tasks');
    } //save









    function edit($id){
        $task = new Task($id);
        if(!$task->primaryVal){
            ASWSession::setFlash('flash-danger', 'aranan görev bulunamadı');
            redirect('projects');
        }else{
            $datas = array_merge([
                'task' => $task,
            ], $this->getConnectionsForForm());

            $this->render('tasks/form', $datas);
        }
    }

    function update($id){
        $recordDatas = $_POST;
        $recordDatas['task_extra'] = json_encode(post('task_extra', []));
        $task = new Task($id);
        $task = $task->update($recordDatas);

        if(!$task){ // görev güncellenemedi.
            ASWSession::setFlash('flash-danger', 'işlem sırasında beklenmedik bir hata oluştu.');
        }else{
            $task->connectTables('task_contacts', 'contact_id', $_POST['task_contacts'] );
            ASWSession::setFlash('flash-success', 'görev güncellendi');
        }
        redirect('task.edit', ['id'=>$id]);
    }


    







    function delete($id){
        $task = new Task($id);
        $result = [
            'status' => false,
            'title' => _tr('bir sorun oluştu'),
            'message' => _tr('sistemde beklenmedik bir sorun oluştu ve işlem gerçekleşemedi')
        ];
        if(!$task->primaryVal){
            $result['message'] = _tr('belirtilen görev sistemde yok');
            $result['timer'] = 2000;
        }else{
            $delete = $task->delete();
            if($delete){
                $task->deleteConnections($id);
                $result = [
                    'status'    => true,
                    'title'     => _tr('görev silindi'),
                    'message'   => _tr('belirtilen görev sistemden silindi'),
                    'id'        => $id
                ];
            }
        }
        $this->jsonRender($result);
    }




    private function getConnectionsForForm(){
        $user = new User();
        $project = new Project();
        $contact = new Contact();

        return [
            'projects' => $project->findAll('ORDER BY project_id DESC', null, 'project_id, project_title', true),
            'users' => $user->findAll('ORDER BY user_slug ASC', null, 'user_id, user_slug, user_name', true),
            'contacts' => $contact->findAll('ORDER BY contact_name ASC', null, 'contact_id, contact_name', true)
        ];
    }
    

}
?>