<?php echo ASWHelper::getSubHeader(_tr('projeler'), 'fa fa-address-book',
    [
        [
            'title' => _tr('proje etiketleri'),
            'url' => url('project.tags', null, false),
            'class' => 'btn btn-warning btn-sm',
            'icon' => 'fa fa-tags'
        ],
        [   'title' => _tr('proje oluştur'),
            'url' => url('project.create', null, false),
            'class' => 'btn btn-primary btn-sm',
            'icon' => 'fa fa-plus'
        ]
    ] ); ?>


<?php require_once(__DIR__.'/../flash-messages.php'); ?>
<?php if(isset($projects)): ?>
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th width="50">#</th>
            <th><?php echo _tr('proje'); ?></th>
            <th><?php echo _tr('açıklama'); ?></th>
            <th width="260"><?php echo _tr('tarih'); ?></th>
            <th width="100"></th>
        </tr>
        </thead>

        <tbody>

        <?php foreach($projects as $project):  ?>
            <tr class="row-item-<?php echo $project->project_id; ?>">
                <td><?php echo $project->project_id; ?></td>
                <td><?php echo $project->project_status>0? '<span class="badge bg-success">active</span>' : '<span class="badge bg-danger">passive</span>'; ?>
                    <button class="btn btn-default btn-sm" onclick="getPopupInfo('<?php echo $project->urlPopup(); ?>')"><?php echo $project->project_title; ?></button></td>
                <td><?php echo $project->project_title; ?></td>
                <td><?php if($project->project_c_time){ echo date('d F Y', strtotime($project->project_c_time)); } ?></td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-primary fa fa-info text-center" onclick="getPopupInfo('<?php echo $project->urlPopup(); ?>')"></button>
                        <a href="<?php echo $project->urlEdit(); ?>" class="btn btn-warning fa fa-edit text-center"></a>
                        <button class="btn btn-danger fa fa-trash text-center" onclick="sweetDel('proje silinecek', 'projeyi silmek istediğinize emin misiniz? işlem bir daha geri alınamaz', '<?php echo $project->urlDelete(); ?>')"></button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
<?php endif; ?>
