<?php
/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    8.06.2021 18:22
 */
echo ASWHelper::getSubHeader('yeni görev oluştur', 'fa fa-plus',
    [
        [   'title' => 'görevler',
            'url' => url('tasks', null, false),
            'class' => 'btn btn-danger btn-sm',
            'icon' => 'fa fa-arrow-left'
        ]
    ] ); ?>
<?php require_once(__DIR__.'/../flash-messages.php'); ?>
<?php
$action         = url('task.save', null, false);
$title          = ''; //
$description    = ''; //
$content        = ''; //
$user_id        = ''; //
$importance     = ''; //
$project_id     = ''; //
$status         = 1; //
$order          = 5; //
$url            = ''; //
$extra          = json_decode(json_encode([]));
$tcontacts      = [];
$button         = '<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> '._tr('oluştur').'</button>';

if(isset($task)){
    $action         = url('task.update', ['id'=>$task->task_id], false);
    $title          = $task->task_title;
    $description    = $task->task_description;
    $content        = $task->task_content;
    $user_id        = $task->task_user;
    $importance     = $task->task_importance;
    $project_id     = $task->task_project;
    $status         = $task->task_status;
    $order          = $task->task_order;
    $url            = $task->task_url;
    $extra          = json_decode($task->task_extra);
    $connections    = $task->getConnections();
    $tcontacts      = array_map(function($i){ return $i->contact_id; }, $connections['contacts']);
    $button         = '<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> '._tr('güncelle').'</button>';
}
?>

        <form action="<?php echo $action; ?>" method="POST">
        <div class="row" id="app">





            <div class="col">
                <div class="card">
                    <div class="card-header"><h5><?php echo _tr('genel görev bilgileri'); ?></h5></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label"><?php echo _tr('görev adı'); ?></label>
                            <input type="text" class="form-control" name="task_title" value="<?php echo $title; ?>" require autofocus/>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?php echo _tr('kısa açıklama'); ?></label>
                            <textarea name="task_description" cols="30" rows="3" class="form-control"><?php echo $description; ?></textarea>
                        </div>


                        <div class="mb-3">
                            <label class="form-label"><?php echo _tr('link'); ?></label>
                            <input type="text" name="task_url" class="form-control"  value="<?php echo $url; ?>"/>
                        </div>


                        <!-- MUHATAPLAR - CONTACTS -->
                        <div class="mb-3">
                            <label class="form-label"><?php echo _tr('bu projenin sahibi veya ilgilisi olan kişiler'); ?></label>
                            <div class="border clearfix" id="contact-check-input">
                                <div class="btn btn-dark btn-sm m-1 invisible" v-if="contacts.length<1">oonio</div>
                                <div class="btn btn-primary btn-sm m-1" v-for="contact in contacts">{{ contact.value }} <span class="badge bg-danger" @click="removeContact(contact.id)">x</span></div>
                            </div>
                        </div>

                        <div class="mb-3 clearfix">
                            <label class="form-label"><?php echo _tr('ayrıntılar'); ?></label>
                            <textarea name="task_content" cols="30" rows="10" class="summernote"><?php echo $content; ?></textarea>
                        </div>

                        <div class="mb-3 border-bottom"></div>
                        <div class="mb-3"><?php echo $button; ?></div>




                    </div>
                </div>
            </div>




            <div id="second-column" class="col-md-2">


                <div class="card mb-4 border-success">
                    <div class="card-header bg-success text-light"><h5><?php echo _tr('bağlantılar'); ?></h5></div>
                    <div class="card-body p-2">


                        <!-- STATUS  -->
                        <div class="mb-3">
                            <label class="form-label"><?php echo _tr('durum'); ?></label>
                            <select name="task_status" id="" class="form-control">
                                <?php foreach(TASK_STATUS_LIST as $key => $val){ $selected = $key==$status? 'selected' : 1;
                                    echo '<option value="'.$key.'" '.$selected.'>'.$val.'</option>'; } ?>
                            </select>
                        </div>


                        <!-- IMPORTANCE  -->
                        <div class="mb-3">
                            <label class="form-label"><?php echo _tr('önem'); ?></label>
                            <select name="task_importance" id="" class="form-control">
                                <?php foreach(TASK_IMPORTANCE_LIST as $key => $val){ $selected = $key==$importance? 'selected' : 1;
                                    echo '<option value="'.$key.'" '.$selected.'>'.$val.'</option>'; } ?>
                            </select>
                        </div>

                        <!-- GÖREV SIRASI  -->
                        <div class="mb-3">
                            <label class="form-label"><?php echo _tr('görev sırası'); ?></label>
                            <select name="task_order" id="" class="form-control">
                                <?php for($i=1; $i<=10; $i++){ $selected = $i==$order? 'selected' : 5;
                                    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>'; } ?>
                            </select>
                        </div>


                        <!-- USERS  -->
                        <div class="mb-3">
                            <label class="form-label"><?php echo _tr('ait kullanıcı'); ?></label>
                            <select name="task_user" id="" class="form-select form-select-md">
                                <option value="0"><?php echo _tr('bu görev kime ait?'); ?></option>
                                <?php foreach($users as $key => $user){ $selected = $user->user_id==$user_id? 'selected' : 1;
                                    echo '<option value="'.$user->user_id.'" '.$selected.'>'.$user->user_name.'</option>';
                                } ?>
                            </select>
                        </div>


                        <!-- PROJECTS  -->
                        <div class="mb-3">
                            <label class="form-label"><?php echo _tr('göreve bağlı proje'); ?></label>
                            <select name="task_project" id="" class="form-select form-select-md">
                                <option value="0"><?php echo _tr('bağlı proje yok'); ?></option>
                                <?php foreach($projects as $key => $project){ $selected = $project->project_id==$project_id? 'selected' : 1;
                                    echo '<option value="'.$project->project_id.'" '.$selected.'>'.$project->project_title.'</option>';
                                } ?>
                            </select>
                        </div>


                    </div><!-- .card-body -->
                </div><!-- .card -->


                <div class="card border-primary">
                    <div class="card-header bg-primary text-light"><h5><?php echo _tr('proje muhatapları'); ?></h5></div>
                    <div class="card-body p-2">
                        <div class="mb-2"><input type="search" class="form-control" placeholder="<?php echo _tr('ara'); ?>"></div>
                        <div class="box-checklist">
                        <?php foreach($contacts as $contact): ?>
                            <div class="form-check border-bottom py-1 px-4">
                                <input class="form-check-input contact-check-input"  <?php if(in_array($contact->contact_id, $tcontacts)){ echo 'checked'; } ?>
                                       name="task_contacts[]"
                                       value="<?php echo $contact->contact_id; ?>"
                                       data-value="<?php echo $contact->contact_name; ?>"
                                       type="checkbox" @change="addContact($event, '<?php echo $contact->contact_id; ?>', '<?php echo $contact->contact_name; ?>')"
                                       id="cbcontact-<?php echo $contact->contact_id; ?>">
                                <label class="form-check-label" for="cbcontact-<?php echo $contact->contact_id; ?>"><?php echo $contact->contact_name; ?></label>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div><!-- .card -->

            </div><!-- #second-column -->





        </div><!-- .row -->
        </form>


<script>

    var app = new Vue({
        el: '#app',

        data: {
            contacts: []
        },

        mounted: function(){
            document.querySelectorAll('.contact-check-input').forEach( item => {
                if(item.checked){ this.contacts.push({id:item.value, value:item.dataset.value}); }
            } );
        },



        methods: {

            // CONTACTS
            addContact: function(e, id, value){
                if(e.target.checked) { this.contacts.push({id, value}); }else{ this.removeContact(id); }
            }, //addContact
            removeContact: function(id){
                document.querySelector('input#cbcontact-'+id).checked = false;
                this.contacts = this.contacts.filter( item => { return id!==item.id } );
            } //removeContact


        }, //methods




    });
</script>