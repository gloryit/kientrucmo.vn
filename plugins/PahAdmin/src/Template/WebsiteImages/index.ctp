<?php
/**
 * @var \PahAdmin\View\AdminView $this
 * @var \IconicAdmin\Model\Entity\ToppageLogo $toppage_logo
 * @var string $flash_error_key
 */
?>
<div class="block">
    <div class="page-title">
        <div class="title_left">
            <h3>
                <a href="<?= $this->Url->build(['controller' => 'TestUpload', 'action' => 'edit', 'plugin' => 'PahAdmin']) ?>">TOPPAGE
                    LOGO</a>
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
                            <a href="<?= $this->Url->build(['controller' => 'TestUpload', 'action' => 'edit', 'plugin' => 'PahAdmin']) ?>"
                               class="btn btn-default">
                                <i class="fa fa-reply" aria-hidden="true"></i> Back to list
                            </a>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div class="clearfix"></div>
                            <?= $this->Form->create('', [
                                'class' => 'form-horizontal form-label-left',
                                'type' => 'file',
                                'id' => 'edit-form',
                                'data-parsley-validate' => '',
                                'novalidate',
                            ]) ?>
                            <?php if ($toppage_logo->id) : ?>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">ID:</label>
                                    <div class="col-sm-8">
                                        <h5><?= $toppage_logo->id ?></h5>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="company-id">Company ID:</label>
                                <div class="col-sm-8">
                                    <?= $this->Form->control('m_user_company_id', [
                                        'type' => 'text',
                                        'id' => 'company-id',
                                        'class' => 'form-control',
                                        'readonly' => 'readonly',
                                        'label' => false
                                    ]); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-2">Company Name:</label>
                                <div class="col-xs-8">
                                    <?= $this->Form->control('company.name_lo', [
                                        'id' => 'autocomplete-custom-append',
                                        'type' => 'text',
                                        'class' => 'select2_single form-control',
                                        'required' => true,
                                        'label' => false
                                    ]) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Display order:</label>
                                <div class="col-sm-8">
                                    <?= $this->Form->control('dsp_order', [
                                        'type' => 'number',
                                        'class' => 'form-control',
                                        'required' => true,
                                        'label' => false
                                    ]); ?>
                                </div>
                            </div>

                            <!-- Images region -->
                            <div class="form-group">
                                <label class="control-label col-md-2">
                                    Logo <span class="required">*</span>
                                </label>
                                <div class="col-md-8">
                                    <div class="input-group" style="margin-bottom: 0; padding-bottom: 0">
                                        <input type="text"
                                               class="form-control topPageLogos"
                                               required="required"
                                               data-parsley-errors-container="#picture-errors"
                                               data-parsley-trigger="change"
                                               value="<?= $toppage_logo->logo_url ?>"
                                               placeholder="Image's link"
                                               disabled>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary select-picture"
                                                    data-image-target=".topPageLogos">
                                                <i class="fa fa-image" aria-hidden="true"></i>
                                                Select picture
                                            </button>
                                        </span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div id="topPageLogos"></div>
                                    <div class="clearfix"></div>
                                    <img
                                        src="<?= $toppage_logo->link_image ?><?= $toppage_logo->modified ? '?modified=' . $toppage_logo->modified->timestamp : '' ?>"
                                        style="max-width: 200px; cursor: pointer" class="topPageLogos image-show">
                                    <input value="<?= $toppage_logo->logo_url ?>" type="hidden"
                                           class="form-control topPageLogos" name="image_uri">
                                </div>
                            </div>
                            <!-- End Images region -->

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Active</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <div class="">
                                        <?= $this->Form->checkbox('is_active', [
                                            'class' => 'js-switch',
                                            'checked' => true,
                                            'label' => false
                                        ]) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <a href="<?= $this->Url->build(['controller' => 'TestUpload', 'action' => 'edit', 'plugin' => 'PahAdmin']) ?>"
                                       class="btn btn-default">
                                        <i class="fa fa-reply" aria-hidden="true"></i> Back to list
                                    </a>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                            <?= $this->Form->end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->appendStylesTop() ?>
<!-- jasny-bootstrap -->
<link href="/gentelella/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
<link href="/libs/jquery-ui/themes/base/jquery-ui.min.css" rel="stylesheet">
<style type="text/css">
    .switchery {
        margin-top: 7px;
        width: 32px;
        height: 20px;
    }

    .switchery > small {
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
<script src="/gentelella/vendors/switchery/dist/switchery.min.js"></script>
<script type="text/javascript" src="/js/iconic_website_images.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        // var elem = document.querySelector('.js-switch');
        // var init_switch = new Switchery(elem);

        // Form validation
        var $edit_form = $('#edit-form');
        $edit_form.dirtyForms();
        $edit_form.parsley();

        var uploadBox = new WebsiteImages();
        $('.select-picture').on('click', function (e) {
            var $this = $(this);
            uploadBox.onChoose = function (image) {
                $('input' + $this.data('image-target')).val(image.uri).change();
                $('img' + $this.data('image-target')).attr('src', image.uri);
            };
            uploadBox.open();
        });
        $('.image-show').on('click', function () {
            window.open($(this).attr('src'));
        })
    })
</script>
<?php $this->end() ?>

