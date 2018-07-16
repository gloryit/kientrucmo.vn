<?php
/**
 * Created by PhpStorm.
 * User: glory
 * Date: 1/4/2018
 * Time: 7:10 PM
 * @var \App\Model\Entity\Contact $contact
 * @var \App\View\AppView $this
 */
?>

<div class="vtem-section-inside container clearfix">
    <div class="row section-content clearfix">
        <div id="block14f6445da903186" style="background-color:rgba(255, 255, 255, 0); color:#333333" class="vtem-block system widget-component col-md-12" data-vgrid="8">
            <div class="vtem-block-inside clearfix">
                <div class="item-page" itemscope="" itemtype="https://schema.org/Article">
                    <meta itemprop="inLanguage" content="vi-VN">
                    <div class="page-header">
                        <h2 itemprop="headline">
                            Liên Hệ Với <?= h($contact->company) ?> </h2>
                    </div>
                    <dl class="article-info muted">
                        <dt class="article-info-term">Chi tiết	</dt>
                        <dd class="createdby" itemprop="author" itemscope="" itemtype="https://schema.org/Person">Viết bởi <span itemprop="name"><?= h($contact->author) ?></span> </dd>
                        <dd class="category-name">Chuyên mục: <a href="<?= $this->Url->build(['_name' => 'app:contact']) ?>" itemprop="genre">liên hệ</a></dd>
                        <dd class="create">
                            <span class="icon-calendar" aria-hidden="true"></span>
                            <time datetime="2015-01-31T00:43:15+07:00" itemprop="dateCreated"><?= h(date_format($contact->created, 'd/m/Y')) ?></time>
                        </dd>
                    </dl>

                    <div itemprop="articleBody">
                        <div style="text-align: center;">
                            <span style="color: #ff0000;"><img src="<?= h($contact->link_images) ?>" alt="face" width="851" height="315" style="margin-bottom: 10px;"></span>
                            <h4 style="color: #ff0000;" class="text-uppercase"><?= h($contact->company) ?></h4>
                            <div><?= h($contact->address) ?></div>
                            <div>
                                Tel: <a href="tel:<?= h($contact->tel) ?>"><?= h($contact->tel) ?></a>
                                - Fax: <?= h($contact->fax) ?>
                                - MST: <?= h($contact->tax_code) ?>
                            </div>
                            <div>
                                Email: <a href="mailto:<?= h($contact->email) ?>"><?= h($contact->email) ?></a>
                                - Website: <a href="<?= h($contact->website) ?>"><?= h($contact->website) ?></a>
                                - Hotline:<a href="tel:<?= h($contact->hotline) ?>"><?= h($contact->hotline) ?></a>
                            </div>
                        </div>
                        <div class="moduletable">
                            <div id="vtemcontact1" class="vtem-contact-form vtem_contact " style="width:100%;">
                                    <?= $this->Form->create('', [
                                        'class' => 'uk-width-4-6',
                                        'id' => 'vtemailForm',
                                        'data-parsley-validate' => '',
                                        'novalidate'
                                    ]) ?>
                                    <div class="vtem_contact_intro_text"></div>
                                    <table border="0">
                                        <tbody>
                                            <tr>
                                                <td colspan="2">
                                                    <label for="vtem_contact_name">Name<span class="star">*</span></label>
                                                    <?= $this->Form->control('name', [
                                                        'class' => 'vt_inputbox required',
                                                        'id' => 'vtem_contact_name',
                                                        'data-parsley-required' => 'true',
                                                        'data-parsley-trigger' => 'change',
                                                        'label' => false
                                                    ]) ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <label for="vtem_contact_email">Email<span class="star">*</span></label>
                                                    <?= $this->Form->control('email', [
                                                        'type' => 'email',
                                                        'id' => 'vtem_contact_email',
                                                        'class' => 'vt_inputbox required validate-email',
                                                        'data-parsley-required' => 'true',
                                                        'data-parsley-trigger' => 'change',
                                                        'label' => false
                                                    ]) ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><label for="vtem_contact_subject">Subject<span class="star">*</span></label>
                                                    <?= $this->Form->control('subject', [
                                                        'id' => 'vtem_contact_subject',
                                                        'class' => 'vt_inputbox required',
                                                        'data-parsley-required' => 'true',
                                                        'data-parsley-trigger' => 'change',
                                                        'label' => false
                                                    ]) ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top" colspan="2">
                                                    <label for="vtem_contact_message">Message<span class="star">*</span></label>
                                                    <?= $this->Form->textarea('message', [
                                                        'type' => 'quote',
                                                        'class' => 'editor-wrapper vt_inputbox required',
                                                        'name' => 'content',
                                                        'cols' => 35,
                                                        'rows' => 6,
                                                        'data-parsley-required' => 'true',
                                                        'data-parsley-trigger' => 'change',
                                                        'label' => false
                                                    ]); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <input id="vtbutton" class="vtem_contact_button validate" type="submit" value="Send Message">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?= $this->Form->end() ?>
                            </div>
                        </div>

                        <div style='overflow:hidden;height:440px;width:100%;'>
                            <div id='gmap_canvas' style='height:440px;width:100%;'></div>
                        </div>
                        <script type='text/javascript'>
                            function initMap() {
                                var myOptions = {
                                    zoom: 19,
                                    center: new google.maps.LatLng(10.8249635, 106.6785964),
                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                };
                                map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
                                marker = new google.maps.Marker({
                                    map: map,
                                    position: new google.maps.LatLng(10.8249635, 106.6785964)
                                });
                                infowindow = new google.maps.InfoWindow({
                                    content: '<strong>Công ty TNHH kiến trúc nội thất MO</strong><br>254/7 Nguyen Van Cong street, 3 ward, Go Vap district, HCM city<br>'
                                });
                                google.maps.event.addListener(marker, 'click', function() {
                                    infowindow.open(map, marker);
                                });
                                infowindow.open(map, marker);
                            }
                        </script>
                        <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBBoZuKeZP3HGRD5fYIvLzVvcRQWqkIGgA&callback=initMap'></script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->appendStylesTop() ?>
<style>
    #gmap_canvas img{
        max-width:none!important;
        background:none!important
    }
    /* *********  form design  **************************** */

    .editor.btn-toolbar {
        zoom: 1;
        background: #F7F7F7;
        margin: 5px 2px;
        padding: 3px 0;
        border: 1px solid #EFEFEF;
    }

    .input-group {
        margin-bottom: 10px;
    }

    .ln_solid {
        border-top: 1px solid #e5e5e5;
        color: #ffffff;
        background-color: #ffffff;
        height: 1px;
        margin: 20px 0;
    }

    span.section {
        display: block;
        width: 100%;
        padding: 0;
        margin-bottom: 20px;
        font-size: 21px;
        line-height: inherit;
        color: #333;
        border: 0;
        border-bottom: 1px solid #e5e5e5;
    }

    .form-control {
        border-radius: 0;
        width: 100%;
    }

    .form-horizontal .control-label {
        padding-top: 8px
    }

    .form-control:focus {
        border-color: #CCD0D7;
        box-shadow: none !important;
    }

    legend {
        font-size: 18px;
        color: inherit;
    }

    .checkbox {
    }

    .form-horizontal .form-group {
        margin-right: 0;
        margin-left: 0;
    }

    .form-control-feedback {
        margin-top: 8px;
        height: 23px;
        color: #bbb;
        line-height: 24px;
        font-size: 15px;
    }

    .form-control-feedback.left {
        border-right: 1px solid #ccc;
        left: 13px;
    }

    .form-control-feedback.right {
        border-left: 1px solid #ccc;
        right: 13px;
    }

    .form-control.has-feedback-left {
        padding-left: 45px;
    }

    .form-control.has-feedback-right {
        padding-right: 45px;
    }

    .form-group {
        margin-bottom: 10px;
    }

    .validate {
        margin-top: 10px;
    }

    .invalid-form-error-message {
        margin-top: 10px;
        padding: 5px;
    }

    .invalid-form-error-message.filled {
        border-left: 2px solid #E74C3C;
    }

    p.parsley-success {
        color: #468847;
        background-color: #DFF0D8;
        border: 1px solid #D6E9C6;
    }

    p.parsley-error {
        color: #B94A48;
        background-color: #F2DEDE;
        border: 1px solid #EED3D7;
    }

    ul.parsley-errors-list {
        list-style: none;
        color: #E74C3C;
        padding-left: 0;
    }

    input.parsley-error, textarea.parsley-error, select.parsley-error {
        background: #FAEDEC;
        border: 1px solid #E85445;
    }

    .btn-group .parsley-errors-list {
        display: none;
    }

    .bad input, .bad select, .bad textarea {
        border: 1px solid #CE5454;
        box-shadow: 0 0 4px -2px #CE5454;
        position: relative;
        left: 0;
        -moz-animation: .7s 1 shake linear;
        -webkit-animation: 0.7s 1 shake linear;
    }

    .item input, .item textarea {
        -webkit-transition: 0.42s;
        -moz-transition: 0.42s;
        transition: 0.42s;
    }
</style>
<?php $this->end() ?>
