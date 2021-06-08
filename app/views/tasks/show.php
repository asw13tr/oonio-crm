<?php
/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    8.06.2021 22:33
 */
?>

<div style="text-align: left">
<?php
    $connections = $task->getConnections();
    $extra = json_decode($task->task_extra);

    echo ASWHelper::getSubHeader($task->task_title, 'fa fa-chevron-right');
?>

    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th width="200"><?php echo _tr('görev'); ?></th>
            <td><?php echo $task->task_title; ?></td>
        </tr>

        <tr>
            <th width="200"><?php echo _tr('durum'); ?></th>
            <td><?php echo TASK_STATUS_LIST[$task->task_status]; ?></td>
        </tr>

        <tr>
            <th width="200"><?php echo _tr('önem'); ?></th>
            <td><?php echo TASK_IMPORTANCE_LIST[$task->task_importance]; ?></td>
        </tr>

        <tr>
            <th width="200"><?php echo _tr('özet'); ?></th>
            <td><?php echo $task->task_description; ?></td>
        </tr>


        <tr>
            <th width="200"><?php echo _tr('bağlı olduğu proje'); ?></th>
            <td><?php $project = $task->getProject();
                if($project){
                    echo '<button class="btn btn-dark btn-sm m-1" onclick="getPopupInfo(\''.$project->urlPopup().'\')">'.$project->project_title.'</button>';
                }
                ?></td>
        </tr>


        <tr>
            <th width="200"><?php echo _tr('sorumlu çalışan'); ?></th>
            <td><?php $user = $task->getUser(); if($user){ echo '<button class="btn btn-success btn-sm m-1">'.$user->user_name.'</button>'; }  ?></td>
        </tr>

        <tr>
            <th width="200"><?php echo _tr('muhataplar'); ?></th>
            <td><?php foreach($connections['contacts'] as $contact){
                    $popupUrl = url('contact.popup', ['id'=>$contact->contact_id], false);
                    echo '<button class="btn btn-primary btn-sm m-1" onclick="getPopupInfo(\''.$popupUrl.'\')">'._tr($contact->contact_name).'</button>'; }
                ?></td>
        </tr>

        <tr>
            <th width="200"><?php echo _tr('url'); ?></th>
            <td><a href="<?php echo ASWHelper::addhttp($task->task_url); ?>" target="_blank"><?php echo $task->task_url; ?></a></td>
        </tr>

        <tr><th colspan="2"><?php echo _tr('ayrıntılar'); ?></th></tr>
        <tr><td colspan="2"><?php echo $task->task_content; ?></td></tr>

        <tr>
            <th width="200"><?php echo _tr('eklenme'); ?></th>
            <td><?php echo $task->task_c_time; ?></td>
        </tr>

        <tr>
            <th width="200"><?php echo _tr('güncellenme'); ?></th>
            <td><?php echo $task->task_u_time; ?></td>
        </tr>

    </table>

    <?php require_once(__DIR__.'/notes.php'); ?>






</div>

