<?php
/**
 * Created by PhpStorm.
 * User: minhphuc
 * Date: 06/01/2018
 * Time: 08:54
 *
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post[] $tops
 * @var \App\Model\Entity\Post[] $news
 * @var \App\Model\Entity\Post[] $highlights
 * @var \App\Model\Entity\Banner $top_banner
 * @var \App\Model\Entity\Banner $page_banner
 */

use Cake\Routing\Router;

?>

<?php if (!empty($tops)): ?>
    <div id="section158197f3e885100"
         class="vtem-section marketing_info text-center clearfix" style="background-color:rgba(255, 255, 255, 0); color:#222222;">
        <div class="vtem-section-inside container clearfix">
            <div class="row section-content clearfix">
                <?php foreach ($tops as $post): ?>
                    <div id="<?= h(md5($post->id . $post->created)) ?>"
                         style="background-color:rgba(255, 255, 255, 0); color:#333333"
                         class="vtem-block system widget-module col-md-4 col-sm-6 position-feature"  data-vgrid="4">
                        <div class="vtem-block-inside clearfix">
                            <div class="vtem-moduletable mod-basic clearfix moduletable">
                                <h3 class="moduletable-title basic-title "><?= h($post->title) ?></h3>
                                <div class="moduletable-content basic-body">
                                    <div class="custom"  >
                                        <div style="background: no-repeat 50%; background-size: cover; display: block; background-image: url(<?= Router::url(h($post->link_images), true) ?>);">
                                            <a href="<?= $this->Url->build(['_name' => 'services:view', h($post->slug)]) ?>">
                                                <img src="/images/thumbnails/thumbnail-bg.png" alt="<?= $post->title ?>" style="display: block; width: 100%; vertical-align: middle;">
                                                <img src="<?= Router::url(h($post->link_images), true) ?>" alt="<?= $post->title ?>" style="display: none; width: 100%; vertical-align: middle;" />
                                            </a>
                                            <span style="color: #333333;">
                                                <a href="<?= $this->Url->build(['_name' => 'services:view', h($post->slug)]) ?>" style="color: #333333;">
                                                    <?= h($post->header) ?>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
<?php endif ?>

<?php if (!empty($top_banner)): ?>
    <div id="section1581edbd6105334" class="vtem-section box-slideshow clearfix" style="background-color:rgba(255, 255, 255, 0); color:#333333;">
        <div class="vtem-section-inside container-fluid clearfix">
            <div class="row section-content clearfix">
                <div id="block1581edc59767466"
                     style="background-color:rgba(255, 255, 255, 0); color:#333333"
                     class="vtem-block extend widget-customhtml col-md-12" data-vgrid="12">
                    <div class="vtem-block-inside clearfix">
                        <div class="custom-html-content clearfix">
                            <div><a href="/"><img style="margin-top: -45px; text-align: center; display: block; margin-left: auto; margin-right: auto;" src="<?= h($top_banner->link_images) ?>" alt="<?= h($top_banner->title) ?>" width="1366" height="588" /></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<div id="section1580d299688953" class="vtem-section section-capabilities clearfix" style="background-color:rgba(255, 255, 255, 0); color:#333333;">
    <div class="vtem-section-inside container clearfix">
        <div class="row section-content clearfix">
            <div id="block158301f22274754" style="background-color:rgba(255, 255, 255, 0); color:#333333" class="vtem-block system widget-module  col-md-12   position-navigation"  data-vgrid="12">
                <div class="vtem-block-inside clearfix">
                    <script type="text/javascript">
                      var vtemnewsdrawer = jQuery.noConflict();
                      (function($){
                        $(document).ready(function(){
                          $('#vtem-newsdrawerid159-newsdrawer').zAccordion({
                            width: '100%',
                            tabWidth: '11%',
                            height: '30%',
                            auto: 1,
                            timeout: 3000,
                            startingSlide: 0,
                            trigger: "mouseenter",
                            speed: 300,			slideClass: "slider",
                            animationStart: function() {
                              $('#vtem-newsdrawerid159-newsdrawer').find("li.slider-open .newsdrawercaption").fadeIn();
                              $('#vtem-newsdrawerid159-newsdrawer').find("li.slider-open .vtemnewsdrawer_infor").css("display", "none");
                            },
                            animationComplete: function() {
                              $('#vtem-newsdrawerid159-newsdrawer').find("li.slider-open .newsdrawercaption").css("display", "none");
                              $('#vtem-newsdrawerid159-newsdrawer').find("li.slider-open .vtemnewsdrawer_infor").slideDown();
                            },
                            buildComplete: function () {$('#vtem-newsdrawerid159-newsdrawer .newsdrawercaption').width($('#vtem-newsdrawerid159-newsdrawer').width()*0.11);},
                            easing: "",
                            pause: 1,
                            invert: 1
                          });
                        });
                      })(jQuery);
                    </script>
                    <div id="vtemnewsdrawernewsdrawerid159" class="vtem-newsdrawer-style4 vtem_newsdrawer_item clearfix newsdrawer">
                        <ul id="vtem-newsdrawerid159-newsdrawer" class="vtemdrawer">
                            <?php foreach ($news as $post):?>
                                <li id='vtem<?= h($post->id) ?>' >
                                    <a href="<?= $this->Url->build(['_name' => 'app:details', h(strtolower($post->menu->slug)), h(strtolower($post->slug)), h(strtolower($post->id))], true) ?>"><img class="vtem_drawer_image" src="<?= h($post->link_images) ?>" /></a>
                                    <div class="vtemnewsdrawer_infor">
                                        <h4 class="vtem_newsdrawer_title"><a href="<?= $this->Url->build(['_name' => 'news:view', $post->slug]) ?>"><?= h($post->title) ?></a></h4>
                                    </div>
                                    <h4 class="newsdrawercaption"><span><?= h($post->title) ?></span></h4>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php if (!empty($page_banner)): ?>
                <div id="block1582127293d1725" style="background-color:rgba(255, 255, 255, 0); color:#333333" class="vtem-block system widget-module col-md-12 position-user"  data-vgrid="12">
                    <div class="vtem-block-inside clearfix">
                        <div class="custom"  >
                            <p><img src="<?= h($page_banner->link_images) ?>" alt="<?= h($page_banner->title) ?>" style="margin-top: 20px; margin-bottom: -10px;" /></p>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>

<div id="section1581df5c127330"
     class="vtem-section section-clientschoose text-center clearfix" style="background-color:rgba(255, 255, 255, 0); color:#333333;">
    <div class="vtem-section-inside container clearfix">
        <div class="row section-content clearfix">
            <div id="block1581ecabe431929" style="background-color:rgba(255, 255, 255, 0); color:#333333" class="vtem-block system widget-module  col-md-12  hidden-phone hidden-xs position-outline"  data-vgrid="12">
                <div class="vtem-block-inside clearfix">
                    <div class="custom"  >
                        <p><img src="/images/duantieubieu.png" alt="du-an-tieu-bieu" width="612" height="97" style="display: block; margin-left: auto; margin-right: auto;" /></p>
                    </div>
                    <script type="text/javascript">
                      var vtemnewsbox = jQuery.noConflict();
                      jQuery(document).ready(function(){
                        jQuery('#vtemnewsboxid153-box').hoverSliding({
                          duration: 500,
                          width: '326px',
                          height: '240px',
                          boxEasing: 'swing',
                          boxtype: 'captionfull',
                          titleHeight: ''
                        });
                      });
                    </script>
                    <div id="vtemnewsboxid153-box" class="vtem-newsbox clearfix newsbox-">
                        <?php foreach ($highlights as $post): ?>
                            <div class='vtemboxgrid captionfull'>
                                <img src="<?= h($post->link_images) ?>" alt="<?= h($post->slug) ?>" />
                                <div class="box-caption">
                                    <div class="vtemnewsbox_inside">
                                        <h4 class="vtem_news_box_title boxTitle"><a href="<?= $this->Url->build(['_name' => 'app:details', h(strtolower($post->menu->slug)), h(strtolower($post->slug)), h(strtolower($post->id))], true) ?>"><?= h($post->slug) ?></a></h4>
                                        <div class="vt_readmore clearfix"><a class="vtem-newsbox-readon" href="<?= $this->Url->build(['_name' => 'app:details', h(strtolower($post->menu->slug)), h(strtolower($post->slug)), h(strtolower($post->id))], true) ?>"><span>Xem chi tiết ...</span></a></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <div id="block158448bb92c7073"
                 style="background-color:rgba(255, 255, 255, 0); color:#333333"
                 class="vtem-block system widget-module  col-md-12  hidden-tablet hidden-sm hidden-desktop hidden-md hidden-lg position-search"  data-vgrid="12">
                <div class="vtem-block-inside clearfix">
                    <div class="custom"  >
                        <p><img src="/images/duantieubieu.png" alt="du-an-tieu-bieu" width="280" height="45" style="display: block; margin-left: auto; margin-right: auto; margin-bottom: -10px;" /></p>
                    </div>
                    <script type="text/javascript" src="/js/jquery.hoversliding.js"></script>
                    <script type="text/javascript">
                      var vtemnewsbox = jQuery.noConflict();
                      jQuery(document).ready(function(){
                        jQuery('#vtemnewsboxid166-box').hoverSliding({
                          duration: 500,
                          width: '150px',
                          height: '120px',
                          boxEasing: 'swing',
                          boxtype: 'caption',
                          titleHeight: ''
                        });
                      });
                    </script>
                    <div id="vtemnewsboxid166-box" class="vtem-newsbox clearfix newsbox-">
                        <?php foreach ($highlights as $highlight): ?>
                            <div class='vtemboxgrid caption'>
                                <img src="<?= h($highlight->link_images) ?>" alt="<?= h($highlight->slug) ?>" />
                                <div class="box-caption">
                                    <div class="vtemnewsbox_inside">
                                        <h4 class="vtem_news_box_title boxTitle"><a href="<?= $this->Url->build(['_name' => 'highlights:view', h($highlight->slug)]) ?>"><?= h($highlight->title) ?></a></h4>
                                        <div class="vt_readmore clearfix"><a class="vtem-newsbox-readon" href="<?= $this->Url->build(['_name' => 'highlights:view', h($highlight->slug)]) ?>"><span>+ Xem chi tiết ...</span></a></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

