<?php
/**
 * @var \PahAdmin\View\AdminView $this
 * @var \App\Model\Entity\Group $group
 */
?>
<div class="block">
    <div class="page-title">
        <div class="title_left">
            <h3>
                <a href="<?php $this->Url->build(['controller'=>'Groups','action'=>'index','plugin'=>'PahAdmin']) ?>">GROUPS</a>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12" style="margin-bottom: 5px">
                            <a href="<?= $this->Url->build(['controller'=>'Groups','action'=>'index','plugin'=>'PahAdmin']) ?>" class="btn btn-default">
                                <i class="fa fa-reply" aria-hidden="true"></i> Back to list
                            </a>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div class="clearfix"></div>
                            <?= $this->Form->create('', [
                                'class'     => 'form-horizontal form-label-left',
                                'type'      => 'file',
                                'id'        => 'edit-form',
                                'data-parsley-validate' => '',
                                'novalidate',
                            ]) ?>
                            <?php if(!empty($group->id)) : ?>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">ID:</label>
                                    <div class="col-sm-8">
                                        <h5><?= $group->id ?></h5>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label class="control-label col-xs-2">Group Title:</label>
                                <div class="col-xs-8">
                                    <?= $this->Form->control('title', [
                                        'type'      => 'text',
                                        'class'     => 'form-control',
                                        'data-parsley-required' => 'true',
                                        'data-parsley-trigger' => 'change',
                                        'value' => !empty($group->title) ? h($group->title) : '',
                                        'label'     => false
                                    ])?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Display order:</label>
                                <div class="col-sm-8">
                                    <?= $this->Form->control('dsp_order', [
                                        'type'      => 'number',
                                        'class'     => 'form-control',
                                        'value' => !empty($group->dsp_order) ? h($group->dsp_order) : 0,
                                        'data-parsley-required' => 'true',
                                        'label'     => false
                                    ]);?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Active</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <div class="">
                                        <?= $this->Form->checkbox('is_active',[
                                            'class' => 'js-switch',
                                            'data-parsley-required' => 'true',
                                            'checked' => ($group->is_active) ?? true,
                                            'label' => false
                                        ]) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10 col-sm-10 col-xs-12 text-right">
                                    <!-- <a href="#" class="btn btn-default"><i class="fa fa-reply" aria-hidden="true"></i> Back to list</a>-->
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>
                            <?= $this->Form->end();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->appendStylesTop() ?>
<!-- jasny-bootstrap -->
<link href="/gentelella/vendors/switchery/dist/switchery.min.css?v=<?= ASSETS_VERSION ?>" rel="stylesheet">
<link href="/libs/jquery-ui/themes/base/jquery-ui.min.css?v=<?= ASSETS_VERSION ?>" rel="stylesheet">
<style type="text/css">
    .switchery {
        margin-top: 7px;
        width: 32px;
        height: 20px;
    }
    .switchery>small {
        width: 20px;
        height: 20px;
    }
    .ui-autocomplete {
        max-width: 200px;
        list-style: none;
        background: white;
        margin: 0;
        padding: 0;
    }
</style>
<link href="/css/images-modal.css" rel="stylesheet">
<?php $this->end() ?>

<?php $this->appendScriptsBottom() ?>
<!-- Switchery -->
<script src="/gentelella/vendors/switchery/dist/switchery.min.js?v=<?= ASSETS_VERSION ?>"></script>
<script src="/libs/jquery-ui/jquery-ui.min.js?v=<?= ASSETS_VERSION ?>" type="text/javascript"></script>
<script type="text/javascript" src="/js/website_images.js?v=<?= ASSETS_VERSION ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {

        // Form validation
        var $edit_form = $('#edit-form');
        $edit_form.dirtyForms();
        $edit_form.parsley();

        var uploadBox = new WebsiteImages();
        $('.select-picture').on('click', function(e) {
            var $this = $(this);
            uploadBox.onChoose = function(image) {
                $('input' + $this.data('image-target')).val(image.uri).change();
                $('img' + $this.data('image-target')).attr('src',image.uri);
            };
            uploadBox.open();
        });
        $('.image-show').on('click', function(){
            window.open($(this).attr('src'));
        })
    })
</script>
<?php $this->end() ?>
