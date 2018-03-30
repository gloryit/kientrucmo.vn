
<?php
/**
 * Created by PhpStorm.
 * User: glory
 * Date: 1/3/2018
 * Time: 12:10 AM
 *
 * @var \App\Model\Entity\Post[] $app_highlights
 * @var \App\View\AppView $this
 */
?>

<div id="block14f6445fc705476" style="background-color:rgba(255, 255, 255, 0); color:#333333" class="vtem-block system widget-module  col-md-4  hidden-phone hidden-xs position-right" data-vgrid="4">
    <div class="vtem-block-inside clearfix">
<!--        <div class="vtem-moduletable mod-block well clearfix moduletable">-->
<!--            <h3 class="moduletable-title block-title ">Hotline Tư Vấn</h3>-->
<!--            <div class="moduletable-content block-body">-->
<!--                <div class="custom">-->
<!--                    <p style="text-align: center;"><img src="/images/hotro.png" alt="hotro" style="margin-top: 0px; margin-right: 0px; box-shadow: #444444 0px 5px 6px -6px; border-radius: 10px;"></p>-->
<!--                    <p style="text-align: center;"><a href="skype:khachoan32?chat"><img src="/images/skype.png" alt="skype" width="100" height="44" style="margin-bottom: 10px;">&nbsp; &nbsp;&nbsp;</a><a href="skype:khachoan32?chat" style="line-height: 16.7999992370605px; text-align: center;"><img src="/images/skype.png" alt="skype" width="100" height="44" style="margin-bottom: 10px;"></a></p>-->
<!--                    <p style="text-align: center;">Email: Adam.nguyen@+ p a h.vn</p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <div class="vtem-moduletable mod-block well clearfix moduletable">
            <h3 class="moduletable-title block-title ">Dự Án Tiêu Biểu</h3>
            <div class="moduletable-content block-body">
                <script type="text/javascript" src="/js/jquery.hoversliding.js"></script>
                <script type="text/javascript">
                    var vtemnewsbox = jQuery.noConflict();
                    jQuery(document).ready(function(){
                        jQuery('#vtemnewsboxid155-box').hoverSliding({
                            duration: 500,
                            width: '295px',
                            height: '210px',
                            boxEasing: 'swing',
                            boxtype: 'caption',
                            titleHeight: ''
                        });
                    });
                </script>
                <div id="vtemnewsboxid155-box" class="vtem-newsbox clearfix newsbox- box-wrapper">
                    <?php foreach ($app_highlights as $highlight): ?>
                    <div class="vtemboxgrid caption vtem-boxgrid" style="width: 295px; height: 210px; float: left;">
                        <img src="<?= h($highlight->link_images) ?>" alt="vtem news box">
                        <div class="box-caption vtem-slideItem" style="top: 173px;">
                            <div class="vtemnewsbox_inside">
                                <h4 class="vtem_news_box_title boxTitle"><a href="<?= $this->Url->build(['_name' => 'highlights:view', h($highlight->slug)]) ?>"><?= h($highlight->title) ?></a></h4>
                                <p></p>
                                <div class="vt_readmore clearfix"><a class="vtem-newsbox-readon" href="<?= $this->Url->build(['_name' => 'highlights:view', h($highlight->slug)]) ?>"><span>Xem chi tiết ...</span></a></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
<!--        <div class="vtem-moduletable mod-block well clearfix moduletable">-->
<!--            <h3 class="moduletable-title block-title ">Thống kê Online</h3>-->
<!--            <div class="moduletable-content block-body">-->
<!--                <p>Đang có 469&nbsp;khách và không thành viên đang online</p>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</div>
