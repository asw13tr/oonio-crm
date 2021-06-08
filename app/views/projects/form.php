<?php echo ASWHelper::getSubHeader('proje oluştur', 'fa fa-plus',
    [
        [   'title' => 'Vazgeç',
            'url' => url('projects', null, false),
            'class' => 'btn btn-danger btn-sm',
            'icon' => 'fa fa-arrow-left'
        ]
    ] ); ?>
<?php require_once(__DIR__.'/../flash-messages.php'); ?>
<?php
$action = url('project.save', null, false);
$title = '';
$description = '';
$status = 1;
$url = '';
$content = '';
$ptags = [];
$pusers = [];
$pcontacts = [];
$button         = '<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> '._tr('oluştur').'</button>';

if(isset($project)){
    $extra       = json_decode($project->project_extra);
    $action      = url('project.update', ['id'=>$project->project_id], false);
    $title       = $project->project_title;
    $description = $project->project_description;
    $status      = $project->project_status;
    $url         = $extra->url;
    $content     = $project->project_content;
    $connections = $project->getConnections();
    $ptags       = array_map(function($i){ return $i->tax_id; }, $connections['tags']);
    $pusers      = array_map(function($i){ return $i->user_id; }, $connections['users']);
    $pcontacts   = array_map(function($i){ return $i->contact_id; }, $connections['contacts']);
    $button         = '<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> '._tr('güncelle').'</button>';
}
?>

        <form action="<?php echo $action; ?>" method="POST">
        <div class="row" id="app">





            <div class="col">
                <div class="card">
                    <div class="card-header"><h5><?php echo _tr('genel proje bilgileri'); ?></h5></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label"><?php echo _tr('proje adı'); ?></label>
                            <input type="text" class="form-control" name="project_title" value="<?php echo $title; ?>" require autofocus/>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?php echo _tr('kısa açıklama'); ?></label>
                            <textarea name="project_description" cols="30" rows="3" class="form-control"><?php echo $description; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?php echo _tr('durum'); ?></label>
                            <select name="project_status" id="" class="form-control">
                                <option value="1" <?php if($status==1){ echo 'selected'; } ?>><?php echo _tr('aktif'); ?></option>
                                <option value="0" <?php if($status!=1){ echo 'selected'; } ?>><?php echo _tr('pasif'); ?></option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?php echo _tr('link'); ?></label>
                            <input type="text" name="project_extra[url]" class="form-control"  value="<?php echo $url; ?>"/>
                        </div>

                        <!-- ETİKETLER  - TAGS -->
                        <div class="mb-3">
                            <label class="form-label"><?php echo _tr('etiketler'); ?></label>
                            <div class="border clearfix" id="tag-check-input">
                                <div class="btn btn-dark btn-sm m-1 invisible" v-if="tags.length<1">oonio</div>
                                <div class="btn btn-dark btn-sm m-1" v-for="value in tags">{{ value.value }} <span class="badge bg-danger" @click="removeTag(value.id)">x</span></div>
                            </div>
                        </div>

                        <!-- ÇALIŞANLAR - USERS -->
                        <div class="mb-3">
                            <label class="form-label"><?php echo _tr('bu projeyi görüntüleyebilecek kullanıcılar'); ?></label>
                            <div class="border clearfix" id="user-check-input">
                                <div class="btn btn-dark btn-sm m-1 invisible" v-if="users.length<1">oonio</div>
                                <div class="btn btn-success btn-sm m-1" v-for="user in users">{{ user.value }} <span class="badge bg-danger" @click="removeUser(user.id)">x</span></div>
                            </div>
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
                            <textarea name="project_content" cols="30" rows="10" class="summernote"><?php echo $content; ?></textarea>
                        </div>

                        <div class="mb-3 border-bottom"></div>
                        <div class="mb-3"><?php echo $button; ?></div>




                    </div>
                </div>
            </div>




            <div id="second-column" class="col-md-2">
                <!-- TAGS -->
                <div class="card border-dark">
                    <div class="card-header bg-dark text-light"><h5><?php echo _tr('proje etiketleri'); ?></h5></div>
                    <div class="card-body p-2">
                        <div class="mb-2"><input type="search" class="form-control" placeholder="<?php echo _tr('ara'); ?>"></div>
                        <div class="box-checklist">
                            <?php foreach($tags as $tag): ?>
                                <div class="form-check border-bottom py-1 px-4">
                                    <input class="form-check-input tag-check-input" <?php if(in_array($tag->tax_id, $ptags)){ echo 'checked'; } ?>
                                           name="project_tags[]"
                                           value="<?php echo $tag->tax_id; ?>"
                                           data-value="<?php echo $tag->tax_val; ?>"
                                           type="checkbox" @change="addTag($event, '<?php echo $tag->tax_id; ?>', '<?php echo $tag->tax_val; ?>')"
                                           id="cbtag-<?php echo $tag->tax_id; ?>">
                                    <label class="form-check-label" for="cbtag-<?php echo $tag->tax_id; ?>"><?php echo $tag->tax_val; ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div><!-- .card -->


                <!-- USERS  -->
                <div class="card my-4 border-success">
                    <div class="card-header bg-success text-light"><h5><?php echo _tr('ilgili çalışanlar'); ?></h5></div>
                    <div class="card-body p-2">
                        <div class="mb-2"><input type="search" class="form-control" placeholder="<?php echo _tr('ara'); ?>"></div>
                        <div class="box-checklist">
                        <?php foreach($users as $user): ?>
                            <div class="form-check border-bottom py-1 px-4">
                                <input class="form-check-input user-check-input"  <?php if(in_array($user->user_id, $pusers)){ echo 'checked'; } ?>
                                       name="project_users[]"
                                       value="<?php echo $user->user_id; ?>"
                                       data-value="<?php echo $user->user_name; ?>"
                                       type="checkbox"
                                       @change="addUser($event, '<?php echo $user->user_id; ?>', '<?php echo $user->user_name; ?>')"
                                       id="cbuser-<?php echo $user->user_id; ?>">
                                <label class="form-check-label" for="cbuser-<?php echo $user->user_id; ?>" title="<?php echo $user->user_slug; ?>"><?php echo $user->user_name; ?></label>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div><!-- .card -->


                <div class="card border-primary">
                    <div class="card-header bg-primary text-light"><h5><?php echo _tr('proje muhatapları'); ?></h5></div>
                    <div class="card-body p-2">
                        <div class="mb-2"><input type="search" class="form-control" placeholder="<?php echo _tr('ara'); ?>"></div>
                        <div class="box-checklist">
                        <?php foreach($contacts as $contact): ?>
                            <div class="form-check border-bottom py-1 px-4">
                                <input class="form-check-input contact-check-input"  <?php if(in_array($contact->contact_id, $pcontacts)){ echo 'checked'; } ?>
                                       name="project_contacts[]"
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
            tags: [],
            users: [],
            contacts: []

        },

        mounted: function(){
            document.querySelectorAll('.tag-check-input').forEach( item => {
                if(item.checked){ this.tags.push({id:item.value, value:item.dataset.value}); }
            } );
            document.querySelectorAll('.user-check-input').forEach( item => {
                if(item.checked){ this.users.push({id:item.value, value:item.dataset.value}); }
            } );
            document.querySelectorAll('.contact-check-input').forEach( item => {
                if(item.checked){ this.contacts.push({id:item.value, value:item.dataset.value}); }
            } );
        },



        methods: {

            // TAGS
            addTag: function(e, id, value){
                if(e.target.checked) { this.tags.push({id, value}); }else{ this.removeTag(id); }
            }, //addTag
            removeTag: function(id){
                document.querySelector('input#cbtag-'+id).checked = false;
                this.tags = this.tags.filter( item => { return id!==item.id } );
            }, //removeTag


            // USERS
            addUser: function(e, id, value){
                if(e.target.checked) { this.users.push({id, value}); }else{ this.removeUser(id); }
            }, //addTag
            removeUser: function(id){
                document.querySelector('input#cbuser-'+id).checked = false;
                this.users = this.users.filter( item => { return id!==item.id } );
            }, //removeUser


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