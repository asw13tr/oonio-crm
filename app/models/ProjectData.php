<?php
/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    4.06.2021 15:58
 */
class ProjectData extends ASWModel{

    protected $table = 'project_datas';
    protected $primaryKey = 'data_id';
    protected $columns = ['data_id', 'data_project', 'data_title', 'data_description', 'data_value'];

    public function __construct($data4Fill = null){
        parent::__construct($data4Fill);
    } // __construct


    public function urlEdit(){
        return url('project.data.edit', ['id'=>$this->data_id], false);
    }

    public function urlDecrypt(){
        return url('project.data.decrypt', ['id'=>$this->data_id], false);
    }

    public function urlDelete(){
        return url('project.data.delete', ['id'=>$this->data_id], false);
    }


} // ProjectData
?>

