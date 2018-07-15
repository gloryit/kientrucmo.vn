<?php
/**
 * @var \PahAdmin\View\AdminView $this
 * @var \App\Model\Entity\Post $posts
 * @var string $flash_error_key
 * @var string $option
 */
$flash_error_key = '1234';
?>
<div class="block">
    <div class="page-title">
        <div class="title_left">
            <h3>
                <a href="<?php $this->Url->build(['controller'=>'Posts','action'=>'index','plugin'=>'PahAdmin']) ?>">POSTS JOBS</a>
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
                            <a href="<?= $this->Url->build(['controller'=>'Posts','action'=>'index','plugin'=>'PahAdmin']) ?>" class="btn btn-default">
                                <i class="fa fa-reply" aria-hidden="true"></i> Back to list
                            </a>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div class="clearfix"></div>
                            <?= $this->Flash->render($flash_error_key) ?>
                            <div class="clearfix"></div>
                            <?= $this->Form->create($posts, [
                                'class' => 'form-horizontal form-label-left',
                                'type' => 'file',
                                'id' => 'edit-form',
                                'data-parsley-validate' => '',
                                'novalidate',
                            ]) ?>

                            <?php if($posts->id) : ?>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">ID:</label>
                                    <div class="col-sm-8">
                                        <h5><?= $posts->id ?></h5>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="company-id">Level:</label>
                                <div class="col-sm-8">
                                    <?= $this->Form->select('menu_id', $option, [
                                        'value' => $posts->menu_id ?? '',
                                        'class' => 'form-control',
                                        'data-parsley-required' => 'true',
                                        'data-parsley-trigger' => 'change',
                                        'label' => false
                                    ]) ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-2">Post Title:</label>
                                <div class="col-xs-8">
                                    <?= $this->Form->control('title', [
                                        'type' => 'text',
                                        'class' => 'form-control',
                                        'data-parsley-required' => 'false',
                                        'data-parsley-trigger' => 'change',
                                        'value' => !empty($posts->title) ? h($posts->title) : '',
                                        'label' => false
                                    ])?>
                                </div>
                            </div>

                            <!-- Images region -->
                            <div class="form-group">
                                <label class="control-label col-md-2">
                                    Logo <span class="required">*</span>
                                </label>
                                <div class="col-md-8 show-image-upload">
                                    <div class="input-group" style="margin-bottom: 0; padding-bottom: 0">
                                        <input type="text"
                                               class="form-control Posts"
                                               required="required"
                                               data-parsley-errors-container="#picture-errors"
                                               data-parsley-trigger="change"
                                               value="<?= $posts->uri ?>"
                                               placeholder="Image's link"
                                               disabled>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary select-picture" data-image-target=".Posts" >
                                                <i class="fa fa-image" aria-hidden="true"></i>
                                                Select picture
                                            </button>
                                        </span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div id="Posts"></div>
                                    <div class="clearfix"></div>

                                    <?php if ($posts->uri) : ?>
                                        <?php foreach (\App\Controller\API\StringAPI::filterSpace($posts->uri) as $image_uri) : ?>
                                            <img src="<?= $image_uri ?><?= $posts->modified?'?modified='.$posts->modified->timestamp:'' ?>" style="max-width: 100px; cursor: pointer; padding: 0 5px" class="posts image-show">
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <input value="<?= $posts->uri ?>" type="hidden" class="form-control Posts" name="image_uri">
                                </div>
                            </div>
                            <!-- End Images region -->

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Post Header:</label>
                                <div class="col-sm-8">
                                    <?= $this->Form->textarea('header', [
                                        'type' => 'quote',
                                        'id' => 'header',
                                        'class' => 'resizable_textarea form-control',
                                        'name' => 'header',
                                        'rows' => '3',
                                        'value' => !empty($posts->header) ? h($posts->header) : '',
                                        'placeholder' => 'This top content',
                                        'data-parsley-required' => 'false',
                                        'data-parsley-trigger' => 'change',
                                        'label' => false
                                    ]); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Post Content:</label>
                                <div class="col-sm-8">
                                    <?= $this->Form->textarea('content', [
                                        'type' => 'quote',
                                        'id' => 'content',
                                        'class' => 'editor-wrapper',
                                        'name' => 'content',
                                        'value' => !empty($posts->content) ? $this->Escape->purify($posts->content) : '',
                                        'contenteditable' => true,
                                        'data-parsley-trigger' => 'change',
                                        'label' => false
                                    ]); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Display order:</label>
                                <div class="col-sm-8">
                                    <?= $this->Form->control('dsp_order', [
                                        'type'      => 'number',
                                        'class'     => 'form-control',
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
                                            'checked' => $posts->is_active ?? true,
                                            'label' => false
                                        ]) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <a href="<?= $this->Url->build(['controller' => 'Posts', 'action' => 'index', 'plugin' => 'PahAdmin']) ?>" class="btn btn-default">
                                        <i class="fa fa-reply" aria-hidden="true"></i> Back to list
                                    </a>
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

  function appendImage(image) {
      var img = document.createElement('img');
      img.setAttribute('src', image)
      img.setAttribute('style', 'max-width: 100px; cursor: pointer; padding: 0 5px')
      img.setAttribute('class', 'image-show-multiple posts-multiple')
      return img;
  }

    // Form validation
    var $edit_form = $('#edit-form');
    $edit_form.dirtyForms();
    $edit_form.parsley();

    var uploadBox = new WebsiteImages();
    $('.select-picture').on('click', function(e) {
      var $this = $(this);
      uploadBox.onChoose = function(image) {
          var images = document.getElementsByTagName('img');
          for (var i = 0; i < images.length; i++) {
              images[0].parentNode.removeChild(images[0]);
          }
          var $url = '';
          for(var i = 0; i < image.length; i++) {
              $url += image[i].uri + ' '
              $('.show-image-upload').append(appendImage(image[i].uri));
          }
          $('input' + $this.data('image-target')).val($url).change();
      };
      uploadBox.open();
    });
    $('.image-show').on('click', function(){
      window.open($(this).attr('src'));
    })
  })
</script>
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
