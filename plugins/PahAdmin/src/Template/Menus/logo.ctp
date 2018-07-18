<?php
/**
 * @var \PahAdmin\View\AdminView $this
 * @var \App\Model\Entity\Logo $logo
 * @var string $contact_key
 */
?>
<div class="block">
    <div class="page-title">
        <div class="title_left">
            <h3>
                <a href="<?php $this->Url->build(['controller'=>'Memus','action'=>'logo','plugin'=>'PahAdmin']) ?>">CONTACT</a>
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
                            <a href="<?= $this->Url->build(['controller'=>'Contacts','action'=>'index','plugin'=>'PahAdmin']) ?>" class="btn btn-default">
                                <i class="fa fa-reply" aria-hidden="true"></i> Back to list
                            </a>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div class="clearfix"></div>
                            <?= $this->Flash->render($logo_key) ?>
                            <div class="clearfix"></div>
                            <?= $this->Form->create($logo, [
                                'class'     => 'form-horizontal form-label-left',
                                'type'      => 'file',
                                'id'        => 'edit-form',
                                'data-parsley-validate' => '',
                                'novalidate',
                            ]) ?>
                            <?php if($logo->id) : ?>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">ID:</label>
                                    <div class="col-sm-8">
                                        <h5><?= $logo->id ?></h5>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Images region -->
                            <div class="form-group">
                                <label class="control-label col-md-2">
                                    Logo <span class="required">*</span>
                                </label>
                                <div class="col-md-8">
                                    <div class="input-group" style="margin-bottom: 0; padding-bottom: 0">
                                        <input type="text"
                                               class="form-control Contacts"
                                               required="required"
                                               data-parsley-errors-container="#picture-errors"
                                               data-parsley-trigger="change"
                                               value="<?= $logo->uri ?>"
                                               placeholder="Image's link"
                                               disabled>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary select-picture" data-image-target=".Contacts" >
                                                <i class="fa fa-image" aria-hidden="true"></i>
                                                Select picture
                                            </button>
                                        </span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div id="Contacts"></div>
                                    <div class="clearfix"></div>
                                    <img src="<?= $logo->uri ?><?= $logo->modified?'?modified='.$logo->modified->timestamp:'' ?>" style="max-width: 200px; cursor: pointer" class="Contacts image-show">
                                    <input value="<?= $logo->uri ?>" type="hidden" class="form-control Contacts" name="image_uri">
                                </div>
                            </div>
                            <!-- End Images region -->

                            <div class="form-group">
                                <label class="control-label col-xs-2">Logo Name:</label>
                                <div class="col-xs-8">
                                    <?= $this->Form->control('name', [
                                        'type'      => 'text',
                                        'class'     => 'form-control',
                                        'data-parsley-required' => 'true',
                                        'data-parsley-trigger' => 'change',
                                        'value' => $logo->name ?? '',
                                        'label'     => false
                                    ])?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-2">Alias :</label>
                                <div class="col-xs-8">
                                    <?= $this->Form->control('alias', [
                                        'type'      => 'text',
                                        'class'     => 'form-control',
                                        'data-parsley-required' => 'true',
                                        'data-parsley-trigger' => 'change',
                                        'value' => $logo->alias ?? '',
                                        'label'     => false
                                    ])?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10 col-sm-10 col-xs-12 text-right">
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
                $('input' + $this.data('image-target')).val(image[0].uri).change();
                $('img' + $this.data('image-target')).attr('src',image[0].uri);
            };
            uploadBox.open();
        });
        $('.image-show').on('click', function(){
            window.open($(this).attr('src'));
        })
    })
</script>
<?php $this->end() ?>
