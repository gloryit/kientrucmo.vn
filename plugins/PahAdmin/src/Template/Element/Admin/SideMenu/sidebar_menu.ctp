<?php
/**
 * @var \PahAdmin\View\AdminView $this
 */
?>
<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li>
                <a href="<?= $this->Url->build(['controller' => 'Slides', 'action' => 'index', 'plugin' => 'PahAdmin']) ?>"><i class="fa fa-sliders"></i> SLIDES </a>
            </li>
            <li>
                <a href="<?= $this->Url->build(['controller' => 'Menus', 'action' => 'logo', 'plugin' => 'PahAdmin', '1']) ?>"><i class="fa fa-users"></i> LOGO </a>
            </li>
            <li>
                <a href="<?= $this->Url->build(['controller' => 'Menus', 'action' => 'index', 'plugin' => 'PahAdmin']) ?>"><i class="fa fa-users"></i> MENUS </a>
            </li>
            <li>
                <a href="<?= $this->Url->build(['controller' => 'Posts', 'action' => 'index', 'plugin' => 'PahAdmin']) ?>"><i class="fa fa-newspaper-o"></i> POSTS </a>
            </li>
            <li>
                <a href="<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'update', 'plugin' => 'PahAdmin', '1']) ?>"><i class="fa fa-address-card-o"></i> CONTACT </a>
            </li>
            <li>
                <a href="<?= $this->Url->build(['controller' => 'Banners', 'action' => 'update', 'plugin' => 'PahAdmin', 1]) ?>"><i class="fa fa-thumbs-up"></i> TOP BANNER </a>
            </li>
            <li>
                <a href="<?= $this->Url->build(['controller' => 'Banners', 'action' => 'update', 'plugin' => 'PahAdmin', 2]) ?>"><i class="fa fa-bars"></i> PAGE BANNER </a>
            </li>

        </ul>
    </div>
</div>
<!-- /sidebar menu -->
<?php $this->appendStylesTop() ?>
<!-- jQuery custom content scroller -->
<link href="/gentelella/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
<?php $this->end() ?>

<?php $this->appendScriptsBottom() ?>
<!-- jQuery custom content scroller -->
<script src="/gentelella/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript">
  /**
   * To change this license header, choose License Headers in Project Properties.
   * To change this template file, choose Tools | Templates
   * and open the template in the editor.
   */

  var CURRENT_URL = window.location.href.split('#')[0].split('?')[0],
    $BODY = $('body'),
    $MENU_TOGGLE = $('#menu_toggle'),
    $SIDEBAR_MENU = $('#sidebar-menu'),
    $SIDEBAR_FOOTER = $('.sidebar-footer'),
    $LEFT_COL = $('.left_col'),
    $RIGHT_COL = $('.right_col'),
    $NAV_MENU = $('.nav_menu'),
    $FOOTER = $('footer');

  // Sidebar
  $(document).ready(function() {
    // TODO: This is some kind of easy fix, maybe we can improve this
    var setContentHeight = function () {
      // reset height
      $RIGHT_COL.css('min-height', $(window).height());

      var bodyHeight = $BODY.outerHeight(),
        footerHeight = $BODY.hasClass('footer_fixed') ? -10 : $FOOTER.height(),
        leftColHeight = $LEFT_COL.eq(1).height() + $SIDEBAR_FOOTER.height(),
        contentHeight = bodyHeight < leftColHeight ? leftColHeight : bodyHeight;

      // normalize content
      contentHeight -= $NAV_MENU.height() + footerHeight;

      $RIGHT_COL.css('min-height', contentHeight);
    };

    $SIDEBAR_MENU.find('a').on('click', function(ev) {
      var $li = $(this).parent();

      if ($li.is('.active')) {
        $li.removeClass('active active-sm');
        $('ul:first', $li).slideUp(function() {
          setContentHeight();
        });
      } else {
        // prevent closing menu if we are on child menu
        if (!$li.parent().is('.child_menu')) {
          $SIDEBAR_MENU.find('li').removeClass('active active-sm');
          $SIDEBAR_MENU.find('li ul').slideUp();
        }

        $li.addClass('active');

        $('ul:first', $li).slideDown(function() {
          setContentHeight();
        });
      }
    });

    // toggle small or large menu
    $MENU_TOGGLE.on('click', function() {
      if ($BODY.hasClass('nav-md')) {
        $SIDEBAR_MENU.find('li.active ul').hide();
        $SIDEBAR_MENU.find('li.active').addClass('active-sm').removeClass('active');
      } else {
        $SIDEBAR_MENU.find('li.active-sm ul').show();
        $SIDEBAR_MENU.find('li.active-sm').addClass('active').removeClass('active-sm');
      }

      $BODY.toggleClass('nav-md nav-sm');

      setContentHeight();

      $('.dataTable').each ( function () { $(this).dataTable().fnDraw(); });
    });

    // check active menu
    $SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').parent('li').addClass('current-page');

    $SIDEBAR_MENU.find('a').filter(function () {
      return this.href === CURRENT_URL;
    }).parent('li').addClass('current-page').parents('ul').slideDown(function() {
      setContentHeight();
    }).parent().addClass('active');

    // recompute content when resizing
    $(window).smartresize(function(){
      setContentHeight();
    });

    setContentHeight();

    // fixed sidebar
    if ($.fn.mCustomScrollbar) {
      $('.menu_fixed').mCustomScrollbar({
        autoHideScrollbar: true,
        theme: 'minimal',
        mouseWheel:{ preventDefault: true }
      });
    }
  });
  // /Sidebar
</script>

<?php $this->end() ?>
