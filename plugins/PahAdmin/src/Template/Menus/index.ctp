<?php
/**
 * @var \PahAdmin\View\AdminView $this
 */
?>
<style type="text/css">
    #toppageLogo_table_paginate {
        position: absolute;
        z-index: 5;
        top: 0;
        right: 50%;
    }

    .dataTables_paginate {
        cursor: pointer;
    }
</style>
<div class="block">
    <div class="page-title">
        <div class="title_left">
            <h3>
                <a href="<?= $this->Url->build(array('controller' => 'Menus', 'action' => 'index', 'plugin' => 'PahAdmin')) ?>">
                    MENUS
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
                            <a href="<?= $this->Url->build(['controller' => 'Menus', 'action' => 'edit', 'plugin' => 'PahAdmin']) ?>"
                               id="s_reset" type="submit"
                               class="btn btn-primary">+ Create New Menu</a>
                        </div>
                        <div class="cleafix"></div>
                        <div class="col-md-12">
                            <table id="toppageLogo_table" class="table table-striped jambo_table bulk_action dataTable">
                                <thead>
                                <tr>
                                    <th class="column-title">ID</th>
                                    <th>Menu Level</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Display order</th>
                                    <th>Active</th>
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
<link href="/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css?v=<?= ASSETS_VERSION ?>"
      rel="stylesheet">
<link href="/gentelella/vendors/switchery/dist/switchery.min.css?v=<?= ASSETS_VERSION ?>" rel="stylesheet">
<style type="text/css">
    .switchery {
        margin-top: 7px;
        width: 32px;
        height: 20px;
    }

    .switchery > small {
        width: 20px;
        height: 20px;
    }
</style>
<?php $this->end() ?>
<?php $this->appendScriptsBottom() ?>
<script src="/gentelella/vendors/switchery/dist/switchery.min.js?v=<?= ASSETS_VERSION ?>"></script>
<script type="text/javascript"
        src="/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js?v=<?= ASSETS_VERSION ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var $level = <?= json_encode($options) ?>;
        var $datatables = $('#toppageLogo_table');
        var base_url = "<?= $this->Url->build(['plugin' => 'PahAdmin', 'controller' => 'Menus', 'action' => 'index']) ?>/";
        var datatables_config = {
            "ajax": {
                url: base_url + 'datatables'
            },
            "pageLength": 10,
            "serverSide": true,
            "order": [[0, "desc"]],
            "columnDefs": [
                {
                    "targets": 0,
                    "data": 'id',
                    "searchable": false,
                    "orderable": false
                },
                {
                    "targets": 1,
                    "data": 'child_menu',
                    "render": function (data, type, full, meta) {
                        return $level[data];
                    },
                    "searchable": true,
                    "orderable": false
                },
                {
                    "targets": 2,
                    "data": 'title',
                    "searchable": true,
                    "orderable": false
                },
                {
                    "targets": 3,
                    "data": 'slug',
                    "searchable": true,
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
                    "data": 'is_active',
                    "searchable": false,
                    "orderable": false
                },
                {
                    "targets": 6,
                    "data": 'created',
                    "searchable": false,
                    "orderable": false
                },
                {
                    "targets": 7,
                    "data": 'id',
                    "render": function (data, type, full, meta) {
                        return '<div style="min-width: 80px">' +
                            '<a href="' + base_url + 'edit/' + data + '" class="edit"><i class="fa fa-pencil"></i> Edit</a>'
                            + ' &nbsp;&nbsp; ' +
                            '<a style="color: red" href="' + base_url + 'delete/' + data + '" class="delete delete-featured-company"><i class="fa fa-remove"></i></a>' +
                            '</div>';
                    },
                    "searchable": false,
                    "orderable": false
                }
            ]
        };

        window.$datatable = $datatables.on('processing.dt', function (e, settings, processing) {
            if (processing) {
                NProgress.start();
            } else {
                NProgress.done();
            }
        }).DataTable(datatables_config);
        /** Delete rows */

        $datatables.on('click', '.delete-featured-company', function (e) {
            e.preventDefault();
            if (confirm('Are you sure ?')) {
                $.post($(this).attr('href'), {
                    _csrfToken: '<?= $this->request->getParam('_csrfToken') ?>'
                })
                .done(function (data) {
                    if (parseInt(data['status']) === 200) {
                        window.$datatable.ajax.reload();
                    }
                });
            }
        });
    });
</script>
<?php $this->end() ?>
