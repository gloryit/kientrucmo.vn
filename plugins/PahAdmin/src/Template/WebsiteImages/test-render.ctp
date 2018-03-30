<?php
/**
 * @var \PahAdmin\View\AdminView $this
 * @var \App\Model\Entity\Post $posts
 */
$form = $this->Form;
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>POSTS</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Text areas<small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <?= $form->create('', [
                        'class' => 'form-horizontal form-label-left',
                        'type' => 'file',
                        'id' => 'edit-posts',
                        'data-parsley-validate' => '',
                        'novalidate'
                    ]) ?>
                    <div id="alerts"></div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Group <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?= $form->select('group_id',[
                                '1' => 'Giới thiệu',
                                '2' => 'Dịch vụ',
                                '3' => 'Dự án tiêu biểu',
                                '4' => 'Tin tức',
                                '5' => 'Đối tác',
                                '6' => 'Khách hàng',
                                '7' => 'Tuyển dụng'
                            ], [
                                'class' => 'form-control col-md-7 col-xs-12',
                                'data-parsley-required' => 'true',
                                'data-parsley-trigger' => 'change',
                                'label' => false,
                                'required' => true
                            ]) ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?= $form->control('title', [
                                'class' => 'form-control col-md-7 col-xs-12',
                                'data-parsley-required' => 'true',
                                'data-parsley-trigger' => 'change',
                                'required' => true,
                                'label' => false
                            ]) ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Images <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?= $form->file('image', [
                                'type' => 'file',
                                'class' => 'btn btn-default btn-sm',
//                                'data-parsley-required' => 'true',
                                'data-parsley-trigger' => 'change',
//                                'required' => true,
                                'label' => false
                            ]) ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Header</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?= $form->textarea('header', [
                                'type' => 'quote',
                                'id' => 'header',
                                'class' => 'resizable_textarea form-control',
                                'name' => 'header',
                                'rows' => '3',
                                'placeholder' => 'This top content',
                                'data-parsley-required' => 'true',
                                'data-parsley-trigger' => 'change',
                                'required' => true,
                                'label' => false
                            ]); ?>
                        </div>
                    </div>

                    <div class="ln_solid"></div>

                    <?= $form->textarea('content', [
                        'type' => 'quote',
                        'id' => 'content',
                        'class' => 'editor-wrapper',
                        'name' => 'content',
                        'contenteditable' => true,
//                        'data-parsley-required' => 'true',
                        'data-parsley-trigger' => 'change',
//                        'required' => true,
                        'label' => false
                    ]); ?>
                    <br />

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button class="btn btn-primary" type="button">Cancel</button>
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button class="btn btn-success">Submit</button>
                        </div>
                    </div>
                    <?= $form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->appendStylesTop() ?>
<!-- bootstrap-wysiwyg -->
<link href="/gentelella/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
<!-- Select2 -->
<link href="/gentelella/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
<!-- Switchery -->
<link href="/gentelella/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
<!-- starrr -->
<link href="/gentelella/vendors/starrr/dist/starrr.css" rel="stylesheet">
<!-- Dropzone.js -->
<link href="/gentelella/vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
<?php $this->end() ?>
<?= $this->appendScriptsBottom() ?>
<!-- bootstrap-wysiwyg -->
<script src="/gentelella/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="/gentelella/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
<script src="/gentelella/vendors/google-code-prettify/src/prettify.js"></script>
<!-- jQuery Tags Input -->
<script src="/gentelella/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<!-- Switchery -->
<script src="/gentelella/vendors/switchery/dist/switchery.min.js"></script>
<!-- Select2 -->
<script src="/gentelella/vendors/select2/dist/js/select2.full.min.js"></script>
<!-- Autosize -->
<script src="/gentelella/vendors/autosize/dist/autosize.min.js"></script>
<!-- jQuery autocomplete -->
<script src="/gentelella/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
<!-- starrr -->
<script src="/gentelella/vendors/starrr/dist/starrr.js"></script>
<!-- Dropzone.js -->
<script src="/gentelella/vendors/dropzone/dist/min/dropzone.min.js"></script>

<script src="/gentelella/vendors/ckeditor/ckeditor.js"></script>

<?= $this->Html->script('config') ?>

<script>
    initEditor();
    CKEDITOR.editorConfig = function( config ) {
        config.language = 'es';
        config.uiColor = '#F7B42C';
        config.height = 300;
        config.toolbarCanCollapse = true;
    };
</script>
<?php $this->end() ?>
