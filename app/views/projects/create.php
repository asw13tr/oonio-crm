<?php echo ASWHelper::getSubHeader('proje oluştur', 'fa fa-plus',
    [
        [   'title' => 'Vazgeç',
            'url' => url('projects', null, false),
            'class' => 'btn btn-danger btn-sm',
            'icon' => 'fa fa-arrow-left'
        ]
    ] ); ?>
<?php require_once(__DIR__.'/../flash-messages.php'); ?>

        <form action="<?php url('user.create.post'); ?>" method="POST">
        <div class="row" id="app">





            <div class="col">
                <div class="card">
                    <div class="card-header"><h5><?php echo _tr('genel proje bilgileri'); ?></h5></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label"><?php echo _tr('proje adı'); ?></label>
                            <input type="text" class="form-control" name="project_title" require autofocus/>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?php echo _tr('kısa açıklama'); ?></label>
                            <textarea name="project_description" cols="30" rows="3" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?php echo _tr('durum'); ?></label>
                            <select name="project_status" id="" class="form-control">
                                <option value="1"><?php echo _tr('aktif'); ?></option>
                                <option value="0"><?php echo _tr('pasif'); ?></option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><?php echo _tr('link'); ?></label>
                            <input type="text" name="project_extra[url]" class="form-control" />
                        </div>

                        <div class="mb-3 clearfix">
                            <label class="form-label"><?php echo _tr('ayrıntılar'); ?></label>
                            <textarea name="project_content" cols="30" rows="10" class="summernote"></textarea>
                        </div>

                        <div class="mb-3 border-bottom"></div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo _tr('oluştur'); ?></button>
                        </div>




                    </div>
                </div>
            </div>

            <div id="second-column" class="col-md-2">
                <div class="card">
                    <div class="card-header"><h5><?php echo _tr('proje etiketleri'); ?></h5></div>
                    <div class="card-body p-2" style="max-height: 250px; overflow: auto">
                        <?php foreach($tags as $tag): ?>
                            <div class="form-check border-bottom py-1 px-4">
                                <input class="form-check-input tag-check-input" type="checkbox" value="<?php echo $tag->tax_id; ?>" data-value="<?php echo $tag->tax_val; ?>" id="tag-<?php echo $tag->tax_id; ?>">
                                <label class="form-check-label" for="tag-<?php echo $tag->tax_id; ?>"><?php echo $tag->tax_val; ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div><!-- .card -->


                <div class="card my-4">
                    <div class="card-header"><h5><?php echo _tr('ilgili çalışanlar'); ?></h5></div>
                    <div class="card-body p-2" style="max-height: 250px; overflow: auto">
                        <?php foreach($users as $user): ?>
                            <div class="form-check border-bottom py-1 px-4">
                                <input class="form-check-input user-check-input" type="checkbox" value="<?php echo $user->user_id; ?>" data-value="<?php echo $user->user_name; ?>" id="user-<?php echo $user->user_id; ?>">
                                <label class="form-check-label" for="user-<?php echo $user->user_id; ?>"><?php echo $user->user_name.' ('.$user->user_slug.')'; ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div><!-- .card -->


                <div class="card">
                    <div class="card-header"><h5><?php echo _tr('proje muhatapları'); ?></h5></div>
                    <div class="card-body p-2" style="max-height: 250px; overflow: auto">
                        <?php foreach($contacts as $contact): ?>
                            <div class="form-check border-bottom py-1 px-4">
                                <input class="form-check-input user-check-input" type="checkbox" value="<?php echo $contact->contact_id; ?>" data-value="<?php echo $contact->contact_name; ?>" id="contact-<?php echo $contact->contact_id; ?>">
                                <label class="form-check-label" for="contact-<?php echo $contact->contact_id; ?>"><?php echo $contact->contact_name; ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div><!-- .card -->

            </div><!-- #second-column -->





        </div><!-- .row -->
        </form>


<script>
    var app = new Vue({
        el: '#app',

        data: {
            tags: [1,2,3,4,5,6,7,8,9]
        },

        methods: {

        }

    });
</script>