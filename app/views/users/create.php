<?php echo ASWHelper::getSubHeader('Hesap Oluştur', 'fa fa-user-plus', 
[ 
    [   'title' => 'Vazgeç',
        'url' => url('users', null, false),
        'class' => 'btn btn-danger btn-sm',
        'icon' => 'fa fa-arrow-left'
    ] 
] ); ?>
<?php require_once(__DIR__.'/../flash-messages.php'); ?>
<div class="card my-3">
    <div class="card-header ">
        <a href="<?php url('users'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-list-ul"></i> Kullanıcı Listesi</a>
    </div>

    <div class="card-body col-sm-6 col-md-4 crm-form">
    <form action="<?php url('user.create.post'); ?>" method="POST">



        <div class="mb-3">
            <label for="">Hesap Sahibi</label>
            <input type="text" class="form-control" name="user_name" require autofocus/>
        </div>
        
        <div class="mb-3">
            <label for="">Kullanıcı Adı</label>
            <input type="text" class="form-control" name="user_slug" require/>
        </div>

        <div class="mb-3">
            <label for="">E-posta </label>
            <input type="email" class="form-control" name="user_email" require/>
        </div>


        <div class="mb-3">
            <label for="">Şifre</label>
            <input type="password" class="form-control" name="user_password" require/>
        </div>

        <div class="mb-3">
            <label for="">Hesap Türü</label>
            <select  name="user_level" id="" class="form-select">
                <?php foreach(USER_STATUS_LIST as $key => $val){
                    echo "<option value='{$key}'>{$val}</option>";
                } ?>
            </select>
        </div>


        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input"  name="user_status" value="1" id="user_status" type="checkbox" />
                <label class="form-check-label" id="user_status" for="user_status">Kullanıcı sisteme giriş yapabilir.</label>
            </div>
        </div>

        <div class="">
            <button class="btn btn-primary" name="page" value="user" ><div class="fa fa-save"></div> Oluştur</button>
        </div>



    </form>
    </div>
</div>
