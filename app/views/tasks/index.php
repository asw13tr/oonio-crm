<?php echo ASWHelper::getSubHeader(_tr('görevler'), 'fa fa-tasks',
    [
        [   'title' => _tr('tümü'),
            'url' => url('tasks', null, false),
            'class' => 'btn btn-success btn-sm',
            'icon' => 'fa fa-tasks'
        ],
        [   'title' => _tr('yeni görev oluştur'),
            'url' => url('task.create', null, false),
            'class' => 'btn btn-primary btn-sm',
            'icon' => 'fa fa-plus'
        ]
    ] ); ?>


<?php require_once(__DIR__.'/../flash-messages.php'); ?>
<?php if(isset($tasks)): ?>
    <table class="table table-striped table-bordered table-hover align-middle">
        <thead>
        <tr>
            <th width="50">#</th>
            <th width="50"><?php echo _tr('önem'); ?></th>
            <th width="60"><?php echo _tr('durum'); ?></th>
            <th><?php echo _tr('görev'); ?></th>
            <th><?php echo _tr('açıklama'); ?></th>
            <th width="140"><?php echo _tr('sorumlular'); ?></th>
            <th width="140"><?php echo _tr('tarih'); ?></th>
            <th width="100"></th>
        </tr>
        </thead>

        <tbody>

        <?php foreach($tasks as $task):  ?>
            <tr class="row-item-<?php echo $task->task_id; ?>">
                <td><?php echo $task->task_id; ?></td>
                <td><a href="<?php url('task.filter', ['key'=>'importance', 'val'=>$task->task_importance]); ?>"><?php echo TASK_IMPORTANCE_LIST[$task->task_importance]; ?></a></td>
                <td><a href="<?php url('task.filter', ['key'=>'status', 'val'=>$task->task_status]); ?>"><?php echo TASK_STATUS_LIST[$task->task_status]; ?></a></td>
                <td><button class="btn btn-default btn-sm text-start" onclick="showTaskWithAjax('<?php echo $task->urlPopup(); ?>')"><?php echo $task->task_title; ?></button></td>
                <td><?php echo $task->task_description; ?></td>
                <td><a href="<?php url('task.filter', ['key'=>'user', 'val'=>$task->task_user]); ?>"><?php echo $task->user_name; ?></a></td>
                <td><?php if($task->task_c_time){ echo date('d F Y', strtotime($task->task_c_time)); } ?></td>
                <td>
                    <div class="btn-group">
                        <a href="<?php echo $task->urlShow(); ?>" class="btn btn-primary fa fa-info text-center"></a>
                        <a href="<?php echo $task->urlEdit(); ?>" class="btn btn-warning fa fa-edit text-center"></a>
                        <button class="btn btn-danger fa fa-trash text-center" onclick="sweetDel('görev silinecek', 'görevi silmek istediğinize emin misiniz? işlem bir daha geri alınamaz', '<?php echo $task->urlDelete(); ?>')"></button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
<?php endif; ?>
