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

    public $levelColours = [
        1 => 'secondary',
        2 => 'dark',
        3 => 'info',
        4 => 'primary',
        5 => 'success',
        ];

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
        return '<span class="badge bg-'.$this->levelColours[$this->user_level].'">'.(USER_STATUS_LIST[$this->user_level]).'</span>';
    }





    function urlEdit(){
        return url('user.edit', ['id'=>$this->user_id], false);
    }

    function urlDelete(){
        return url('user.delete.post', ['id'=>$this->user_id], false);
    }

    function urlChangeStatus(){
        return url('user.change.status', ['id'=>$this->user_id], false);
    }


    

}
?>