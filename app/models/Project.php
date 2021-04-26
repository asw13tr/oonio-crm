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

    public function __construct($data4Fill = null){
        parent::__construct($data4Fill);
    }


    // ETİKETLERİ GETİR
    public function getTags(){

    }

    // URL FONKSİYONLARI
    public function urlEdit(){
        return url('project.edit', ['id' => $this->project_id], false);
    }

    public function urlDelete(){
        return url('project.delete', ['id' => $this->project_id], false);
    }

} // Project

?>