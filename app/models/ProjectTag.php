<?php
/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    26.04.2021 14:14
 */

class ProjectTag extends ASWModel{

    protected $table = 'taxonomies';
    protected $primaryKey = 'tax_id';
    protected $columns = ['tax_id', 'tax_parent', 'tax_key', 'tax_val', 'tax_extra'];

    public function __construct($data4Fill = null){
        parent::__construct($data4Fill);
    } // __construct


    public function urlEdit(){
        return url('project.tag.edit', ['id'=>$this->tax_id], false);
    }

    public function urlDelete(){
        return url('project.tag.delete', ['id'=>$this->tax_id], false);
    }


} // ProjectTag

?>