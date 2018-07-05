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
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Description</th>
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
<link href="/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css?v=<?= ASSETS_VERSION ?>" rel="stylesheet">
<style type="text/css">
    .switch {
        position: absolute;
        display: inline-block;
        width: 32px;
        height: 20px;
        vertical-align: middle;
        bottom: 8px;
        margin: 0 auto;
    }

    .switch input {display:none;}

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 0;
        bottom: 0;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: rgb(38, 185, 154);
    }

    input:focus + .slider {
        box-shadow: 0 0 1px rgb(38, 185, 154);
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(12px);
        -ms-transform: translateX(12px);
        transform: translateX(12px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
<?php $this->end() ?>
<?php $this->appendScriptsBottom() ?>
<script type="text/javascript" src="/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js?v=<?= ASSETS_VERSION ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var $datatables = $('#toppageLogo_table');
        var base_url = "<?= $this->Url->build(['plugin' => 'PahAdmin', 'controller' => 'Menus', 'action' => 'index']) ?>/";
        var datatables_config = {
            "ajax": {
                url: base_url + 'datatables'
            },
            "rowId": 'id',
            "pageLength": 10,
            "serverSide": true,
            "columnDefs": [
                {
                    "targets": 0,
                    "data": 'id',
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 1,
                    "data": 'name',
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 2,
                    "data": 'slug',
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 3,
                    "data": 'description',
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 4,
                    "data": 'is_active',
                    'render': function (data) {
                        if (data) {
                            return "<label class=\"switch\">\n" +
                                "  <input type=\"checkbox\" checked>\n" +
                                "  <span class=\"slider round\"></span>\n" +
                                "</label>"
                        }
                        return "<label class=\"switch\">\n" +
                            "  <input type=\"checkbox\">\n" +
                            "  <span class=\"slider round\"></span>\n" +
                            "</label>"
                    },
                    "searchable": false,
                    "orderable": true
                },
                {
                    "targets": 5,
                    "data": 'created',
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 6,
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
