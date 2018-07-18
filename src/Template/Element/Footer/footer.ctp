<?php
/**
 * Created by PhpStorm.
 * User: glory
 * Date: 12/31/2017
 * Time: 3:13 AM
 *
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $app_introduce
 * @var \App\Model\Entity\Contact $app_contact
 */
?>

<div id="section14f779245e87121"
     class="vtem-section text-white footer clearfix" style="background-color:rgb(51, 51, 51); color:#999999;">
    <div class="vtem-section-inside container clearfix">
        <div class="row section-content clearfix">
            <?php if ($app_introduce) : ?>
            <div id="block1581c2e525d4645" style="background-color:rgba(255, 255, 255, 0); color:#333333" class="vtem-block system widget-module  col-md-4   position-top"  data-vgrid="4">
                <div class="vtem-block-inside clearfix">
                    <div class="vtem-moduletable mod-basic clearfix moduletable">
                        <h3 class="moduletable-title basic-title "><?= $app_introduce->title ?? '' ?></h3>
                        <div class="moduletable-content basic-body">
                            <div class="custom"  >
                                <p style="font-size: 17px; line-height: 22px; text-align: justify;"><a href="<?= $this->Url->build(['_name' => 'app:introduce']) ?>"><img src="<?= $app_introduce->uri ?? '' ?>" alt="slide1" style="border: 4px solid #ffffff; margin-bottom: 10px;" /></a><br /><?= $app_introduce->header ?? '' ?><span style="color: #ffcc00;"><a href="<?= $this->Url->build(['_name' => 'app:introduce']) ?>" style="color: #ffcc00;">+ Đọc tiếp</a></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div id="block1581c2e9a8c4204" style="background-color:rgba(255, 255, 255, 0); color:#333333" class="vtem-block system widget-module  col-md-4  hidden-phone hidden-xs position-bottom"  data-vgrid="4">
                <div class="vtem-block-inside clearfix">
                    <div class="vtem-moduletable mod-basic clearfix moduletable">
                        <h3 class="moduletable-title basic-title ">Về Chúng Tôi</h3>
                        <div class="moduletable-content basic-body">
                            <div class="custom"  >
                                <p><iframe width="330" height="330" src="https://www.youtube.com/embed/ALPFgUm594M" frameborder="0" allow="encrypted-media" allowfullscreen></iframe></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="block1581c2f4b9c6376" style="background-color:rgba(255, 255, 255, 0); color:#333333" class="vtem-block system widget-module  col-md-4  hidden-phone hidden-xs position-extra"  data-vgrid="4">
                <div class="vtem-block-inside clearfix">
                    <div class="vtem-moduletable mod-basic clearfix moduletable">
                        <h3 class="moduletable-title basic-title ">Fanpage Facebook</h3>
                        <div class="moduletable-content basic-body">
                            <div class="custom"  >
                                <iframe src="https://www.facebook.com/plugins/page.php?href=https://www.facebook.com/kientrucnoithatmo/&amp;tabs=timeline&amp;width=340&amp;height=330&amp;small_header=false&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=true&amp;appId=508941559268416" width="335" height="330" style="border: none; overflow: hidden;" frameborder="0" scrolling="no"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="section14e52c694f18990" class="vtem-section text-white-muted copyright clearfix" style="background-color:rgb(245, 245, 245); color:#222222;">
    <div class="vtem-section-inside container clearfix">
        <div class="row section-content clearfix">
            <div id="block14f64408fb04054" style="background-color:; color:#333333" class="vtem-block system widget-copyright  col-md-10 col-sm-10 col-xs-8 hidden-phone hidden-xs "  data-vgrid="10">
                <div class="vtem-block-inside clearfix">Copyright 2018 @ phucit.software@gmail.com. All rights reserved.</div>
            </div>
            <div id="block14f6440db201424" style="background-color:rgba(255, 255, 255, 0); color:#FFFFFF" class="vtem-block system widget-totop  col-md-2 col-sm-2 col-xs-4 hidden-phone hidden-xs "  data-vgrid="2">
                <div class="vtem-block-inside clearfix"><a class="vtemgotop pull-right fa fa-angle-up" href="#">&nbsp;</a></div>
            </div>
            <div id="block1582fa2e3f43929" style="background-color: #4f6d78; color:#ffffff" class="vtem-block system widget-module  col-md-12  hidden-tablet hidden-sm hidden-desktop hidden-md hidden-lg position-info"  data-vgrid="12">
                <div class="vtem-block-inside clearfix">
                    <div class="custom"  >
                        <div style="font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 80%; text-align: center;">
                            <span style="color: #ffcc00;"><?= h($app_contact->company) ?></span>
                            <br /><?= h($app_contact->address) ?><br />Tel: <?= h($app_contact->tel) ?> - Fax: <?= h($app_contact->fax) ?>
                            <br />MST:&nbsp;<?= h($app_contact->tax_code) ?>
                            -&nbsp;Email:&nbsp;<?= h($app_contact->email) ?>
                            <br /><?= h($app_contact->website) ?>&nbsp;
                            - Hotline:&nbsp;<?= h($app_contact->hotline) ?>
                            <br />Copyright 2018 © phucit.software@gmail.com.&nbsp;All rights reserved.</div>
                        <div style="text-align: center;">&nbsp;</div>
                        <p style="text-align: center;">&nbsp;</p>
                        <p>&nbsp;</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
