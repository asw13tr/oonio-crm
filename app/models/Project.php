<?php
/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    26.04.2021 16:27
 */

class Project extends ASWModel{

    protected $table = 'projects';
    protected $primaryKey = 'project_id';
    protected $columns = [
        'project_id',
        'project_title',
        'project_description',
        'project_content',
        'project_status',
        'project_extra',
        'project_c_time',
        'project_u_time'
    ];
    protected $models = ['ProjectTag'];

    protected $projectTaxonomyTable = 'project_taxonomy';

    public function __construct($data4Fill = null){
        parent::__construct($data4Fill);
    }


    public function getConnections(){
        $datas = [];

        $db = $this->getDB();
        $sqlTags     = "SELECT t.tax_id, t.tax_val FROM taxonomies AS t INNER JOIN project_taxonomy pt on t.tax_id = pt.tax_id WHERE pt.project_id=:pid";
        $sqlUsers    = "SELECT u.user_id, u.user_slug, u.user_name FROM users AS u INNER JOIN project_users pu on u.user_id = pu.user_id WHERE pu.project_id=:pid";
        $sqlContacts = "SELECT c.contact_id, c.contact_name FROM contacts AS c INNER JOIN project_contacts pc on c.contact_id = pc.contact_id WHERE pc.project_id=:pid";
        $datas = [
            'tags' => $db->query($sqlTags, ['pid'=>$this->project_id]),
            'users' => $db->query($sqlUsers, ['pid'=>$this->project_id]),
            'contacts' => $db->query($sqlContacts, ['pid'=>$this->project_id]),
        ];

        return $datas;

    } //getConnections



    public function deleteConnections($id){
        $db = $this->getDB();
        $db->exec('DELETE FROM project_taxonomy WHERE project_id=?', [$id]);
        $db->exec('DELETE FROM project_users WHERE project_id=?', [$id]);
        $db->exec('DELETE FROM project_contacts WHERE project_id=?', [$id]);
    } //deleteConnections


    public function connectTables($table, $col_name, $items){
        $db = $this->getDB();

        $db->exec("DELETE FROM {$table} WHERE project_id=?", [$this->project_id]);

        $statement= $db->prepare("INSERT INTO {$table}(project_id, {$col_name}) VALUES(:project_id, :item_id)");
        try{
           $db->beginTransaction();
           foreach($items as $item_id){
               $statement->execute( ['project_id'=>$this->project_id, 'item_id'=>$item_id] );
           }
           $db->commit();
        }catch(Exception $e){
            $db->rollBack();
            print_r($e->getMessage());
            exit;
        }
    } //connectTag









    public function getDatas(){

        $db     = $this->getDB();
        $sql    = "SELECT * FROM project_datas WHERE data_project=:pid";
        return  $db->query($sql, ['pid'=>$this->project_id]);

    } //getDatas











    // URL FONKSİYONLARI
    public function urlShow(){
        return url('project.show', ['id' => $this->project_id], false);
    }

    public function urlEdit(){
        return url('project.edit', ['id' => $this->project_id], false);
    }

    public function urlDelete(){
        return url('project.delete', ['id' => $this->project_id], false);
    }

    public function urlPopup(){
        return url('project.popup', ['id' => $this->project_id], false);
    }

} // Project

?>