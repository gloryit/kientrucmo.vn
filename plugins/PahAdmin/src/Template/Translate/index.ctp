<?php
/**
 * @var \PahAdmin\View\AdminView $this
 */
?>
<style type="text/css">
    #toppageLogo_table_paginate {
        display: none;
    }
    div#toppageLogo_table_info {
        padding-top: 0px;
    }
</style>
<div class="block">
    <div class="page-title">
        <div class="title_left">
            <h3>
                <a href="<?= $this->Url->build(array('controller' => 'Translate', 'action' => 'index', 'plugin' => 'PahAdmin')) ?>">
                    TRANSLATE
                </a>
            </h3>
        </div>
    </div>
    <?= $this->Flash->render('success_toppage_Logo') ?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        <div class="clearfix"></div>
                        <div class="col-md-12 text-right">
                            <a href="<?= $this->Url->build(array('controller' => 'Translate', 'action' => 'edit', 'plugin' => 'PahAdmin')) ?>" id="s_reset" type="submit"
                               class="btn btn-primary">+ Create New Translate</a>
                        </div>
                        <div class="cleafix"></div>
                        <div class="col-md-12">
                            <table id="toppageLogo_table" class="table table-striped jambo_table bulk_action dataTable">
                                <thead>
                                <tr>
                                    <th class="column-title">ID</th>
                                    <th>Code</th>
                                    <th>Lang Vi</th>
                                    <th>Lang En</th>
                                    <th>Display order</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->appendStylesTop() ?>
<link href="/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css?v=<?= ASSETS_VERSION ?>" rel="stylesheet">
<link href="/gentelella/vendors/switchery/dist/switchery.min.css?v=<?= ASSETS_VERSION ?>" rel="stylesheet">
<style type="text/css">
    .switchery {
        margin-top: 7px;
        width: 32px;
        height: 20px;
    }
    .switchery>small {
        width: 20px;
        height: 20px;
    }
</style>
<?php $this->end() ?>
<?php $this->appendScriptsBottom() ?>
<script src="/gentelella/vendors/switchery/dist/switchery.min.js?v=<?= ASSETS_VERSION ?>"></script>
<script type="text/javascript" src="/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js?v=<?= ASSETS_VERSION ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var $toppageLogo_table = $('#toppageLogo_table');
        var edit_url = "<?= $this->Url->build(array('plugin' => 'PahAdmin', 'controller' => 'Translate', 'action' => 'edit')) ?>/";
        var datatables_config = {
            "dom": '<"top"i>prt<"bottom"l><"clear">',
            "rowId": 'id',
            "serverSide": true,
            "pageLength": 100,
            "ajax": {
                url: '<?= $this->Url->build(array('controller' => 'Translate', 'action' => 'datatables', 'plugin' => 'PahAdmin')) ?>',
                data: function (d) {
                }
            },
            "order": [[0, "desc"]],
            "oLanguage": {},
            "createdRow": function (row, data, index) {
            },
            'columnDefs': [
                {
                    "targets": 0,
                    "data": 'id',
                    "searchable": false,
                    "orderable": false
                },
                {
                    "targets": 1,
                    "data": 'message',
                    "searchable": false,
                    "orderable": false
                },
                {
                    "targets": 2,
                    "data": 'lang_vi',
                    "searchable": false,
                    "orderable": false
                },
                {
                    "targets": 3,
                    "data": 'lang_en',
                    "searchable": false,
                    "orderable": false
                },
                {
                    "targets": 4,
                    "data": 'dsp_order',
                    "searchable": false,
                    "orderable": false
                },
                {
                    "targets": 5,
                    "data": 'created',
                    "searchable": false,
                    "orderable": false
                },
                {
                    "targets": 6,
                    "data": 'id',
                    "render": function (data, type, full, meta) {
                        return '<a href="' + edit_url + data + '"><i class="fa fa-edit"></i> Edit</a>';
                    },
                    "searchable": false,
                    "orderable": false
                }
            ]
        };

        window.toppageLogo_table = $toppageLogo_table.on('processing.dt', function (e, settings, processing) {
            if (processing) {
                NProgress.start();
            } else {
                NProgress.done();
            }
        }).DataTable(datatables_config);
        /** Update flag */
        $toppageLogo_table.on('click change', 'input.is_check_logo', function () {
            var $this = $(this);
            var toppageLogoId = parseInt($this.closest('tr').attr('id'));
            $.get(is_check + '', {id: toppageLogoId, is_active: $(this).data('id')});
        });

        $toppageLogo_table.on('click', '.delete_logoTop', function (e) {
            e.preventDefault();
            var uri_id = Math.floor($(this).attr('data-id'));
            if (confirm("Are you sure?")) {
                $.post({
                    url: delete_url,
                    data: {
                        id: uri_id,
                        _csrfToken: '<?= $this->request->getParam('_csrfToken') ?>',
                    }
                }).done(function(data){
                    window.toppageLogo_table.ajax.reload()
                });
            }
        });
    });
</script>
<?php $this->end() ?>
