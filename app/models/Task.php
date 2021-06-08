<?php
/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    8.06.2021 17:33
 */

class Task extends ASWModel{
    protected $table = 'tasks';
    protected $primaryKey = 'task_id';
    protected $columns = [
        'task_id',
        'task_title',
        'task_description',
        'task_content',
        'task_user',
        'task_author',
        'task_importance',
        'task_project',
        'task_status',
        'task_order',
        'task_url',
        'task_extra',
        'task_c_time',
        'task_u_time'
    ];
    protected $models = ['User', 'Project'];


    public function __construct($data4Fill = null){
        parent::__construct($data4Fill);
    }


    public function getConnections(){
        $db = $this->getDB();
        $sqlContacts = "SELECT c.contact_id, c.contact_name FROM contacts AS c INNER JOIN task_contacts tc on c.contact_id = tc.contact_id WHERE tc.task_id=:tid";
        return [ 'contacts' => $db->query($sqlContacts, ['tid'=>$this->task_id]) ];
    } //getConnections


    public function connectTables($table, $col_name, $items){
        $db = $this->getDB();
        $db->exec("DELETE FROM {$table} WHERE task_id=?", [$this->task_id]);

        $statement= $db->prepare("INSERT INTO {$table}(task_id, {$col_name}) VALUES(:task_id, :item_id)");
        try{
            $db->beginTransaction();
            foreach($items as $item_id){
                $statement->execute( ['task_id'=>$this->task_id, 'item_id'=>$item_id] );
            }
            $db->commit();
        }catch(Exception $e){
            $db->rollBack();
            print_r($e->getMessage());
            exit;
        }
    } //connectTag


    public function deleteConnections($id){
        $db = $this->getDB();
        $db->exec('DELETE FROM task_contacts WHERE task_id=?', [$id]);
    } //deleteConnections



    public function getUser(){
        return @$this->task_user>0? new User($this->task_user) : null ;
    } // getUser();

    public function getProject(){
        return @$this->task_project>0? new Project($this->task_project) : null ;
    } // getProject();


    // URL FONKSİYONLARI
    public function urlShow(){
        return url('task.show', ['id' => $this->task_id], false);
    }

    public function urlEdit(){
        return url('task.edit', ['id' => $this->task_id], false);
    }

    public function urlDelete(){
        return url('task.delete', ['id' => $this->task_id], false);
    }

    public function urlPopup(){
        return url('task.popup', ['id' => $this->task_id], false);
    }




} // Task