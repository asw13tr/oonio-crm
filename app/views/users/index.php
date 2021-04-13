<?php echo ASWHelper::getSubHeader('Kullanıcı Hesapları', 'fa fa-users', 
                        [ 
                            [   'title' => 'Hesap Oluştur',
                                'url' => url('user.create', null, false),
                                'class' => 'btn btn-primary btn-sm',
                                'icon' => 'fa fa-user-plus'
                            ] 
                        ] ); ?>
<?php require_once(__DIR__.'/../flash-messages.php'); ?>
<?php if($users): ?>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th width="50">#</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>E-mail</th>
            <th width="80">Level</th>
            <th width="60">Status</th>
            <th width="100"></th>
        </tr>
    </thead>

    <tbody>

        <?php foreach($users as $user): ?>
            <tr class="row-item-<?php echo $user->user_id; ?>">
                <td><?php echo $user->user_id; ?></td>
                <td><?php echo $user->user_slug; ?></td>
                <td><?php echo $user->user_name; ?></td>
                <td><a href="mailto:<?php echo $user->user_email; ?>" class="btn btn-success btn-sm fa fa-paper-plane"></a> <?php echo $user->user_email; ?></td>
                <td><?php echo $user->getLevel(); ?></td>
                <td><?php echo $user->getStatusButton(); ?></td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-primary fa fa-info text-center"></button>
                        <a href="<?php echo $user->urlEdit(); ?>" class="btn btn-warning fa fa-edit text-center"></a>
                        <button class="btn btn-danger fa fa-trash text-center" onclick="sweetDel('Hesap Siliniecek', 'Kullanıcıyı silmek istediğinize emin misiniz?', '<?php echo $user->urlDelete(); ?>')"></button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>
<?php endif; ?>

<script>
function ajaxChangeStatus(url){
    $.ajax({
        url: url,
        type: 'POST',
        data: '',
        dataType: 'json'
    }).done(response => {
        if(response.status){
            $('.row-item-'+response.id+' .status-button').toggleClass('d-none');
        }
    });
} // ajaxChangeStatus
</script>
