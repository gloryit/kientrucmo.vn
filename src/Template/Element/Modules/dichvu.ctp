<?php
/**
 * Created by PhpStorm.
 * User: minhphuc
 * Date: 03/01/2018
 * Time: 10:12
 *
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post[] $any
 */
?>

<?php if (!empty($any)): ?>
    <div class="moduletable">
    <h3>Bài viết liên quan</h3>
    <script type="text/javascript" src="/js/jquery.hoversliding.js"></script>
    <script type="text/javascript">
      var vtemnewsbox = jQuery.noConflict();
      jQuery(document).ready(function(){
        jQuery('#vtemnewsboxid165-box').hoverSliding({
          duration: 500,
          width: '337px',
          height: '225px',
          boxEasing: 'swing',
          boxtype: 'caption',
          titleHeight: ''
        });
      });
    </script>
    <div id="vtemnewsboxid165-box" class="vtem-newsbox clearfix newsbox- box-wrapper">
        <?php foreach ($any as $post): ?>
        <div class="vtemboxgrid caption vtem-boxgrid" style="width: 337px; height: 225px; float: left;">
            <img src="<?= \Cake\Routing\Router::url(h($post->link_images), true) ?>" alt="vtem news box">
            <div class="box-caption vtem-slideItem" style="top: 189px; left: 0px;">
                <div class="vtemnewsbox_inside">
                    <h4 class="vtem_news_box_title boxTitle"><a href="<?= $this->Url->build(['_name' => 'app:details', h(strtolower($post->menu->slug)), h(strtolower($post->slug)), h(strtolower($post->id))], true) ?>"><?= h($post->title) ?></a></h4>
                    <div class="vt_readmore clearfix"><a class="vtem-newsbox-readon" href="<?= $this->Url->build(['_name' => 'app:details', h(strtolower($post->menu->slug)), h(strtolower($post->slug)), h(strtolower($post->id))], true) ?>"><span>Xem chi tiết ...</span></a></div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>
