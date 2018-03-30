<?php
/**
 * @var \PahAdmin\View\AdminView $this
 */
$form = $this->Form;
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Translate</h3>
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
                    <br />
                    <?= $form->create(null, [
                        'class' => 'form-horizontal form-label-left',
                        'type' => 'file',
                        'id' => 'edit-translate',
                        'data-parsley-validate' => '',
                        'novalidate'
                    ]) ?>

                        <span class="section">Personal Info</span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Translate Message <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?= $form->control('message', [
                                    'class' => 'form-control col-md-7 col-xs-12',
                                    'data-parsley-required' => 'true',
                                    'data-parsley-trigger' => 'change',
                                    'placeholder' => 'Translate Id',
                                    'required' => 'true',
                                    'label' => false,
                                    'value' => $translate->message??''
                                ]) ?>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Msg Viet Nam <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?= $form->control('lang_vi', [
                                    'class' => 'form-control col-md-7 col-xs-12',
                                    'data-parsley-required' => 'true',
                                    'data-parsley-trigger' => 'change',
                                    'placeholder' => 'Lang Vi',
                                    'required' => 'true',
                                    'label' => false,
                                    'value' => $translate->lang_vi??''
                                ]) ?>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Msg English <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?= $form->control('lang_en', [
                                    'class' => 'form-control col-md-7 col-xs-12',
                                    'data-parsley-required' => 'true',
                                    'data-parsley-trigger' => 'change',
                                    'placeholder' => 'Lang Vi',
                                    'required' => 'true',
                                    'label' => false,
                                    'value' => $translate->lang_en??''
                                ]) ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">Cancel</button>
                                <button id="send" type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    <?= $form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->appendScriptsBottom() ?>
<!-- FastClick -->
<script src="/gentelella/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="/gentelella/vendors/nprogress/nprogress.js"></script>
<!-- validator -->
<script src="/gentelella/vendors/validator/validator.js"></script>
<?= $this->end() ?>
