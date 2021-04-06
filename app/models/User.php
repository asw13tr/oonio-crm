<?php 


class User extends ASWModel{



    public $table = 'users';
    public $primaryKey = 'user_id';
    public $columns = [ 'user_id',
                        'user_slug',
                        'user_name',
                        'user_email',
                        'user_password',
                        'user_level',
                        'user_status',
                        'user_extra'];

    function __construct($obj=null){
        parent::__construct($obj);
    }


    function getStatus(){
        if(isset($this->user_status)){
            if(!$this->user_status){
                return 'Pasif';
            }else{
                return 'Aktif';
            }
        }else{
            return null;
        }
    } //getStatus


    function getLevel(){
        return USER_STATUS_LIST[$this->user_level];
    }

    

}
?>