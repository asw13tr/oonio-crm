<?php echo ASWHelper::getSubHeader('Kullanıcı Hesapları', 'fa fa-users', 
                        [ 
                            [   'title' => 'Hesap Oluştur',
                                'url' => url('user.create', null, false),
                                'class' => 'btn btn-primary btn-sm',
                                'icon' => 'fa fa-user-plus'
                            ] 
                        ] ); ?>

<?php if($users): ?>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th width="50">#</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>E-mail</th>
            <th>Level</th>
            <th>Status</th>
            <th width="150"></th>
        </tr>
    </thead>

    <tbody>

        <?php foreach($users as $user): ?>
            <tr>
                <td><?php echo $user->user_id; ?></td>
                <td><?php echo $user->user_slug; ?></td>
                <td><?php echo $user->user_name; ?></td>
                <td><a href="mailto:<?php echo $user->user_email; ?>" class="btn btn-success btn-sm fa fa-paper-plane"></a> <?php echo $user->user_email; ?></td>
                <td><?php echo $user->getLevel(); ?></td>
                <td><?php echo $user->getStatus(); ?></td>
                <td class="py-0">
                    <div class="row px-1">
                        <div class="col-4 p-1"><button class="btn btn-primary w-100 fa fa-info text-center p-2"></button></div>
                        <div class="col-4 p-1"><a href="<?php echo url('user.edit', ['id'=>$user->user_id]); ?>" class="btn btn-warning w-100 fa fa-edit text-center p-2"></a></div>
                        <div class="col-4 p-1"><button class="btn btn-danger w-100 fa fa-trash text-center p-2"></button></div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>
<?php endif; ?>