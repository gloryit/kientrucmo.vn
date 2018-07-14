<?php
/**
 * Created by PhpStorm.
 * User: glory
 * Date: 12/31/2017
 * Time: 3:08 AM
 *
 * @var \App\View\AppView $this
 * @var string $isPage
 */
?>
<div id="section14f64406ccc3815"
     class="vtem-section section-header clearfix" style="background-color:#4f6d78; color:#333333;">
    <div class="vtem-section-inside container clearfix">
        <div class="row section-content clearfix">
            <div id="block14f64417ade9461" style="background-color:rgba(255, 255, 255, 0); color:#333333" class="vtem-block system widget-logo  col-md-3 col-sm-6 col-xs-9"  data-vgrid="3">
                <div class="vtem-block-inside clearfix">
                    <div class="logo1 clearfix">
                        <a href="/">
                            <img src="/images/logo/logo-kien-truc-mo.png" alt="" class="" />
                        </a>
                    </div>
                </div>
            </div>

            <div id="block14e52c68f0e7306" style="background-color:; color:#FFFFFF" class="vtem-block system widget-menu  col-md-9 vtem-menu col-sm-9 col-xs-3" data-vgrid="9">
                <div class="vtem-block-inside clearfix">
                    <?= $this->element('Menu/menu') ?>
                    <script type="text/javascript">
                        jQuery(document).ready(function(){
                            jQuery("#menu14e52c68f0e7306").oMenu({
                                orientation: "Horizontal",
                                mouseEvent: "hover",
                                effect: "slide",
                                stick: 1,
                                subWidth: 260
                            });
                        });
                    </script>
                </div>
            </div>
            <?php if (!empty($app_slides)): ?>
                <div id="block1582babeb498723" style="background-color:rgba(255, 255, 255, 0); color:#333333" class="vtem-block extend widget-customhtml  col-md-12  hidden-tablet hidden-sm hidden-desktop hidden-md hidden-lg "  data-vgrid="12">
                    <div class="vtem-block-inside clearfix">
                        <div class="custom-html-content clearfix">
                            <?php foreach ($app_slides as $slide): ?>
                                <p><img src="<?= h($slide->link_images) ?>" width="1366" height="478" /></p>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>

<?php if (!in_array($this->request->getUri()->getPath(), [ '/', '/trang-chu'])&& !empty($page_banner)): ?>
    <div id="section1528c3f3d897910"
         class="vtem-section box-slideshow clearfix" style="background-color:rgb(245, 245, 245); color:#333333;">
        <div class="vtem-section-inside container-fluid clearfix">
            <div class="row section-content clearfix">
                <div id="block1581dd44ac23805" style="background-color:rgb(245, 245, 245); color:#333333" class="vtem-block extend widget-customhtml  col-md-12   "  data-vgrid="12">
                    <div class="vtem-block-inside clearfix">
                        <div class="custom-html-content clearfix">
                            <div><img src="<?= h($page_banner->link_images) ?>" alt="<?= h($page_banner->title) ?>" /></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
