<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?= $this->element('Header/head')?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('styles_top'); ?>
</head>
<body id="vtem" class="site com_content opt-featured menuid101 template-style1 site-body layout-mode-full tpl-on homepage blog-basic" >
<div id="vtem-wrapper" class="vtem-wrapper clearfix">
    <div class="wrapper-content clearfix">

        <!-- Header-->
        <?= $this->element('Header/top_header')?>
        <!-- end header -->

        <!-- Slide Home Page -->
        <?= $this->element('Slide/slide') ?>
        <!-- end Slide Home Page -->

        <?= $this->Flash->render() ?>

        <div id="section14f6445ba467817" class="vtem-section main-content clearfix" style="background-color:rgb(34, 34, 34); color:#222222;">
            <?= $this->fetch('content') ?>
        </div>

        <?= $this->element('Footer/footer') ?>
    </div>
</div>
<?= $this->element('Footer/script') ?>
<?= $this->fetch('scripts_bottom') ?>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId            : '366828937116722',
            autoLogAppEvents : true,
            xfbml            : true,
            version          : 'v2.11'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/vi_VN/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<div class="fb-customerchat"
     page_id="1833818310010640"
     theme_color="#f49b00"
     greeting_dialog_display="fade"
     logged_in_greeting="Chào bạn, trò chuyện với chúng tôi để được hỗ trợ tốt nhất nhé."
     logged_out_greeting="Chào bạn, trò chuyện với chúng tôi để được hỗ trợ tốt nhất nhé."
     minimized="true">
</body>
</html>
