<?php
/**
 * @var \PahAdmin\View\AdminView $this
 */
?>
<style type="text/css">
    #toppageLogo_table_paginate {
        position: absolute;
        top: 0;
        right: 45%;
        cursor: pointer;
    }
    div#toppageLogo_table_info {
        padding-top: 0;
    }
</style>
<div class="block">
    <div class="page-title">
        <div class="title_left">
            <h3>
                <a href="<?= $this->Url->build(array('controller' => 'Posts', 'action' => 'index', 'plugin' => 'PahAdmin')) ?>">
                    POSTS
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
                            <a href="<?= $this->Url->build(array('controller' => 'Posts', 'action' => 'edit', 'plugin' => 'PahAdmin')) ?>" id="s_reset" type="submit"
                               class="btn btn-primary">+ Create New Post</a>
                        </div>
                        <div class="cleafix"></div>
                        <div class="col-md-12">
                            <table id="toppageLogo_table" class="table table-striped jambo_table bulk_action dataTable">
                                <thead>
                                <tr>
                                    <th class="column-title">ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Menu</th>
                                    <th>Author</th>
                                    <th>Created</th>
                                    <th style="min-width: 75px">Action</th>
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
        var edit_url = "<?= $this->Url->build(['plugin' => 'PahAdmin', 'controller' => 'Posts', 'action' => 'edit']) ?>/";
        var datatables_config = {
            "dom": '<"top"i>prt<"bottom"l><"clear">',
            "rowId": 'id',
            "serverSide": true,
            "pageLength": 10,
            "ajax": {
                url: '<?= $this->Url->build(array('controller' => 'Posts', 'action' => 'datatables', 'plugin' => 'PahAdmin')) ?>',
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
                    "data": 'uri',
                    "render": function (data, type, full, meta) {
                        return '<img src="' + data + '" alt="" height="150" width="300">';
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
                    "data": 'menu_id',
                    // "render": function (data) {
                    //     var index = {
                    //         1: 'Giới thiệu',
                    //         2: 'Dịch vụ',
                    //         3: 'Dự án tiêu biểu',
                    //         4: 'Tin tức',
                    //         5: 'Đối tác',
                    //         6: 'Khách hàng',
                    //         7: 'Tuyển dụng',
                    //         8: 'Liên hệ'
                    //     };
                    //     return index[data];
                    // },
                    "searchable": false,
                    "orderable": false
                },
                {
                    "targets": 4,
                    "data": 'author',
                    "searchable": true,
                    "orderable": false
                },
                {
                    "targets": 5,
                    "data": 'created',
                    "render": function (data) {
                        var today = new Date(data);
                        var dd = today.getDate();

                        var mm = today.getMonth()+1;
                        if( today.getDate() < 10) {
                            dd = '0' + dd;
                        }

                        if(today.getMonth() < 10) {
                            mm = '0' + mm;
                        }
                        return dd + '/' + mm + '/' + today.getFullYear();
                    },
                    "searchable": false,
                    "orderable": false
                },
                {
                    "targets": 6,
                    "data": 'id',
                    "render": function (data, type, full, meta) {
                        return '<a href="' + edit_url + data + '"><i class="fa fa-edit"></i> Edit</a> ' +
                            '&nbsp;&nbsp;&nbsp;<a href="#" class="delete_post" data-id="' + data + '" style="color:red"><i class="fa fa-remove"></i></a>';
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
        $toppageLogo_table.on('click', '.delete_post', function (e) {
            e.preventDefault();
            var uri_id = Math.floor($(this).attr('data-id'));
            if (confirm("Are you sure?")) {
                $.ajax({
                    url: "<?= h($this->Url->build(['plugin' => 'PahAdmin', 'controller' => 'Posts', 'action' => 'delete'])) ?>",
                    type: 'DELETE',
                    dataType: 'JSON',
                    data: {
                        id: uri_id,
                        _csrfToken: '<?= $this->request->getParam('_csrfToken') ?>',
                    }
                }).done(function(ketqua) {
                    window.toppageLogo_table.ajax.reload()
                });
            }
        });
    });
</script>
<?php $this->end() ?>
