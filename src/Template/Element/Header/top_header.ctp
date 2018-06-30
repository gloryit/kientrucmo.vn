<?php
/**
 * Created by PhpStorm.
 * User: glory
 * Date: 12/31/2017
 * Time: 3:08 AM
 *
 * @var \App\Model\Entity\Post[] $app_introduces
 * @var \App\Model\Entity\Post[] $app_services
 * @var \App\Model\Entity\Contact $app_contact
 * @var \App\Model\Entity\Slide[] $app_slides
 * @var \App\Model\Entity\Banner $page_banner
 * @var \App\View\AppView $this
 * @var string $isPage
 */

?>
    <div id="section15804a027854024"
     class="vtem-section section-topinfo bg-theme clearfix" style="background-color:rgba(255, 255, 255, 0); color:#EEEEEE;">
    <div class="vtem-section-inside container clearfix">
        <div class="row section-content clearfix">
            <div id="block1581e6e8e915854"
                 style="background-color:rgba(255, 255, 255, 0); color:#EEEEEE"
                 class="vtem-block system widget-module col-md-9 text-right hidden-phone hidden-xs position-brand"  data-vgrid="7">
                <div class="vtem-block-inside clearfix">
                    <div class="custom"  >
                        <div><span style="font-size: 15px;">Hỗ trợ 24/7: <img src="images/phone-icon.png" alt="phone icon" width="28" height="28" style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; vertical-align: middle;" /><?= h($app_contact->tel) ?><img src="images/icon_email_bel.png" alt="icon email bel" width="27" height="28" style="vertical-align: middle;" />Email : <?= h($app_contact->email) ?></span></div>
                    </div>
                </div>
            </div>
            <div id="block15804daed542311"
                 style="background-color:rgba(255, 255, 255, 0); color:#EEEEEE"
                 class="vtem-block extend widget-customhtml col-md-3 text-right hidden-phone hidden-xs "  data-vgrid="3">
                <div class="vtem-block-inside clearfix">
                    <div class="custom-html-content clearfix">
                        <div>Theo dõi:
                            <a href="https://www.facebook.com/Ki%E1%BA%BFn-Tr%C3%BAc-N%E1%BB%99i-Th%E1%BA%A5t-p-a-h-1920286804668467/" target="_blank">
                                <img style="margin-top: -5px;" src="/images/Facebook%20(2).png" alt="Facebook (2)" width="32" height="32" />
                            </a>
                            <a href="#" target="_blank">
                                <img style="margin-top: -5px;" src="/images/GooglePlus.png" alt="GooglePlus" width="32" height="32" />
                            </a>
                            <a href="#" target="_blank">
                                <img style="margin-top: -5px;" src="/images/Twitter%20(2).png" alt="Twitter (2)" width="32" height="32" />
                            </a>
                            <a href="#">
                                <img style="margin-top: -5px;" src="/images/YouTube.png" alt="YouTube" width="32" height="32" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div id="section14f64406ccc3815"
         class="vtem-section section-header clearfix" style="background-color:rgb(255, 255, 255); color:#333333;">
        <div class="vtem-section-inside container clearfix">
            <div class="row section-content clearfix">
                <div id="block14f64417ade9461" style="background-color:rgba(255, 255, 255, 0); color:#333333" class="vtem-block system widget-logo  col-md-3 col-sm-6 col-xs-9"  data-vgrid="3">
                    <div class="vtem-block-inside clearfix">
                        <div class="logo1 clearfix">
                            <a href="/">
                                <img src="/assets/images/logo/logo-kientruc-mo.png" alt="Logo kiến trúc mo" class="logo-kien-truc-mo" />
                            </a>
                        </div>
                    </div>
                </div>

                <div id="block14e52c68f0e7306" style="background-color:; color:#FFFFFF" class="vtem-block system widget-menu  col-md-9 vtem-menu col-sm-9 col-xs-3" data-vgrid="9">
                    <div class="vtem-block-inside clearfix">
                        <ul class="nav menu nav-pills vtem-menu" id="menu14e52c68f0e7306">
                            <li class="item-188 deeper parent<?= ($isPage === 'introduces') ? ' active': '' ?>">
                                <span class="text-uppercase">GIỚI THIỆU</span>
                                <?php if (!empty($app_introduces)): ?>
                                    <ul class="nav-child unstyled small">
                                        <?php foreach ($app_introduces as $introduce) :?>
                                        <li class="item-<?= h($introduce->id) ?> text-uppercase"><a href="<?= $this->Url->build(['_name' => 'introduces:view', $introduce->slug]) ?>" ><?= h($introduce->title) ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                            <li class="item-103 deeper parent<?= ($isPage === 'services') ? ' active': '' ?>">
                                <?php if (!empty($app_services)): ?>
                                <span class="text-uppercase">DỊCH VỤ</span>
                                    <ul class="nav-child unstyled small">
                                        <?php foreach ($app_services as $service) :?>
                                            <li class="item-<?= h($service->id) ?> text-uppercase"><a href="<?= $this->Url->build(['_name' => 'services:view', $service->slug]) ?>"><?= h($service->title) ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                            <li class="item-103 deeper parent<?= ($isPage === 'highlights') ? ' active': '' ?>">
                                <?php if (!empty($app_services)): ?>
                                    <span class="text-uppercase">CÔNG TRÌNH THỰC TẾ</span>
                                    <ul class="nav-child unstyled small">
                                        <?php foreach ($app_services as $service) :?>
                                            <li class="item-<?= h($service->id) ?> text-uppercase"><a href="<?= $this->Url->build(['_name' => 'services:view', $service->slug]) ?>"><?= h($service->title) ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                            <li class="item-105 deeper parent<?= ($isPage === 'news') ? ' active': '' ?>"><a href="<?= $this->Url->build(['_name' => 'app:news']) ?>" >TIN TỨC</a></li>
                            <li class="item-106 deeper parent<?= ($isPage === 'contacts') ? ' active': '' ?>"><a href="<?= $this->Url->build(['_name' => 'app:contact']) ?>" >LIÊN HỆ</a></li>
                        </ul>
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
                    <div id="block1582babeb498723"
                         style="background-color:rgba(255, 255, 255, 0); color:#333333"
                         class="vtem-block extend widget-customhtml  col-md-12  hidden-tablet hidden-sm hidden-desktop hidden-md hidden-lg "  data-vgrid="12">
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

<?php if ($this->request->getUri()->getPath() !== '/' && !empty($page_banner)): ?>
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
