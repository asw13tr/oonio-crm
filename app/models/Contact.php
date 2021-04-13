<?php
/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    11.04.2021 18:23
 */
class Contact extends ASWModel{

    protected $table = 'contacts';
    protected $primaryKey = 'contact_id';

    public $columns = [ 'contact_id',
                        'contact_name',
                        'contact_gender',
                        'contact_email',
                        'contact_mobile',
                        'contact_phone',
                        'contact_address',
                        'contact_extra',
                        'contact_c_time',
                        'contact_u_time',];

    public function __construct($data4Fill = null){
        parent::__construct($data4Fill);
    }


    public function getTelA($key, $icon='phone'){
        if($this->$key){
            return '<a href="tel:'.$this->$key.'" class="badge bg-info text-decoration-none"><i class="fa fa-'.$icon.'" style="width:10px;"></i> '.$this->$key.'</a> ';
        }
    }


    public function urlEdit(){
        return url('contact.edit', ['id' => $this->contact_id], false);
    }

    public function urlDelete(){
        return url('contact.delete', ['id' => $this->contact_id], false);
    }
}

?>