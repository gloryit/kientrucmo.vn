<?php
/**
 * Created by PhpStorm.
 * User: glory
 * Date: 12/31/2017
 * Time: 3:10 AM
 *
 * @var \App\Model\Entity\Slide[] $app_slides
 * @var \App\View\AppView $this
 */
?>

<div id="section1528c3f3d897910"
     class="vtem-section box-slideshow clearfix" style="background-color:rgb(245, 245, 245); color:#333333;">
    <div class="vtem-section-inside container-fluid clearfix">
        <div class="row section-content clearfix">
            <div id="block158048411bf7592"
                 style="background-color:rgb(245, 245, 245); color:#333333"
                 class="vtem-block extend widget-slideshow col-md-12"  data-vgrid="12">
                <?php if (in_array($this->request->getUri()->getPath(), ['/', '/trang-chu'])): ?>
                <div class="vtem-block-inside clearfix">
                    <div id="slider158048411bf7592" class="vtem_main_slideshow box_skitter vtemskiter-none navpos-center">
                        <ul class="skitter-data" style="display:none">
                            <?php foreach ($app_slides as $slide): ?>
                                <li><img src="<?= h($slide->link_images) ?>" alt=""/></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $this->appendScriptsBottom() ?>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("#slider158048411bf7592").skitter({
            animation: "random",
            interval: 4000,
            mouseOverButton:false,
            mouseOutButton:false,
            width_label: "100%",
            labelAnimation: "slideUp",
            target_atual: "_blank",numbers: false, thumbs: false, dots: false, preview: false,theme: "default",
            numbers_align: "center",
            enable_navigation_keys: true,
            auto_play: true,
            stop_over: true,
            progressbar: false,
            navigation: true,
            width: "100%",
            height: "35%"
        });
    });
</script>
<?php $this->end() ?>
