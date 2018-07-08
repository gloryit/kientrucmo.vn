<?php
/**
 * @var \PahAdmin\View\AdminView $this
 * @var \App\Model\Entity\Menu $menu
 * @var \App\Model\Entity\Menu $parentCategories
 * @var string $option
 */
?>
<div class="block">
    <div class="page-title">
        <div class="title_left">
            <h3>
                <a href="<?= $this->Url->build(['controller' => 'Menus', 'action' => 'index', 'plugin' => 'PahAdmin']) ?>">MENUS</a>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="clearfix"></div>
                            <?= $this->Form->create($menu, [
                                'class'     => 'form-horizontal form-label-left',
                                'type'      => 'file',
                                'id'        => 'edit-form',
                                'data-parsley-validate' => '',
                                'novalidate',
                            ]) ?>
                            <?php if(!empty($menu->id)) : ?>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">ID:</label>
                                    <div class="col-sm-8">
                                        <h5><?= $menu->id ?></h5>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="company-id">Level:</label>
                                <div class="col-sm-8">
                                    <?= $this->Form->select('parent_id', $option, [
                                        'value' => $menu->parent_id ?? '',
                                        'class' => 'form-control',
                                        'data-parsley-required' => 'false',
                                        'data-parsley-trigger' => 'change',
                                        'label' => false
                                    ]) ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-2">Name:</label>
                                <div class="col-xs-8">
                                    <?= $this->Form->control('name', [
                                        'type'      => 'text',
                                        'class'     => 'form-control',
                                        'data-parsley-required' => 'true',
                                        'data-parsley-trigger' => 'change',
                                        'value' => $menu->name ?? '',
                                        'label'     => false
                                    ])?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Description:</label>
                                <div class="col-sm-8">
                                    <?= $this->Form->control('description', [
                                        'type'      => 'text',
                                        'class'     => 'form-control',
                                        'value' => $menu->description ?? '',
                                        'data-parsley-required' => 'true',
                                        'data-parsley-trigger' => 'change',
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
                                            'checked' => ($menu->is_active) ?? true,
                                            'label' => false
                                        ]) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10 col-sm-10 col-xs-12 text-right">
                                     <a href="<?= $this->Url->build(['controller' => 'Menus', 'action' => 'index', 'plugin' => 'PahAdmin']) ?>" class="btn btn-default"><i class="fa fa-reply" aria-hidden="true"></i> Back to list</a>
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
