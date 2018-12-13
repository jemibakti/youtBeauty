<?php $this->load->view('head'); ?>
<!-- MAIN PANEL -->
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <span class="ribbon-button-alignment"> 
            <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
                <i class="fa fa-refresh"></i>
            </span> 
        </span>
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><?php echo $title; ?></li>
        </ol>
    </div>
    <!-- END RIBBON -->
    <!-- MAIN CONTENT -->
    <div id="content">
        <!-- row -->
        <div class="row">
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <h1 class="page-title txt-color-blueDark">
                    <!-- PAGE HEADER -->
                    <i class="fa-fw fa fa-table"></i> 
                    <?php echo $title; ?>
                </h1>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <a href="<?php echo base_url() . "/AdminWeb/simpanFileVideo/".  base64_encode($group_id); ?>">
                    <button class="btn btn-block btn-success">Tambah Data</button>
                </a>
                <!-- Button trigger modal -->
            </div>
        </div>
        <!-- end row -->

        <?php if ($this->session->flashdata('info')) { ?>
            <div class="alert alert-block alert-success">
                <a class="close" data-dismiss="alert" href="#">×</a>
                <h4 class="alert-heading"><i class="fa fa-check-square-o"></i> <?php echo $this->session->flashdata('info'); ?></h4>
            </div>
        <?php } ?>
        <!-- row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
                    <!-- widget options:
                    usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                    data-widget-colorbutton="false"
                    data-widget-editbutton="false"
                    data-widget-togglebutton="false"
                    data-widget-deletebutton="false"
                    data-widget-fullscreenbutton="false"
                    data-widget-custombutton="false"
                    data-widget-collapsed="true"
                    data-widget-sortable="false"

                    -->
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>Column Filters </h2>

                    </header>

                    <!-- widget div-->
                    <div>

                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->

                        </div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body no-padding">

                            <table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">

                                <thead>
                                    <tr>
                                        <?php if($group_id == 1){?>{
                                        <th class="hasinput" style="width:10%">
                                        </th>
                                        <?php } ?>
                                        <th class="hasinput" >
                                            <input type="text" class="form-control" placeholder="Filter Title" />
                                        </th>
                                        <th class="hasinput" >
                                            <input type="text" class="form-control" placeholder="Filter From" />
                                        </th>
                                        <th class="hasinput" style="width:15%">
                                            <input type="text" class="form-control" placeholder="Filter Type" />
                                        </th>
                                        <th class="hasinput" style="width:8%">

                                        </th>
                                    </tr>
                                    <tr>
                                        <?php if($group_id == 1){?>{
                                        <th >Tumb</th>
                                        <?php } ?>
                                        <th >Title</th>
                                        <th >Link</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    foreach ($grid as $row) {
                                        ?>
                                        <tr>
                                        <?php if($group_id == 1){?>{
                                            <td class="text-center">
                                                <div class="embed-responsive embed-responsive-4by3">
                                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $row->link; ?>"></iframe> <br/>
                                                </div>
                                            </td>
                                        <?php } ?>
                                            <td><?php echo $row->title; ?></td>
                                            <td><?php echo $row->link; ?></td>
                                            <td class="text-center"><?php echo statusIcon($row->status); ?></td>
                                            <td class="text-center">
                                                <div class="btn-group dropup">
                                                    <button class="btn btn-xs dropdown-toggle bg-color-blue txt-color-white" data-toggle="dropdown">
                                                        Action <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu pull-right text-left">
                                                        <li>
                                                            <div class="padding-5">
                                                                <a href="<?php echo base_url() . "/AdminWeb/updateFile/" . base64_encode($row->id . "|"); ?>">
                                                                    <button class="btn btn-block btn-warning">Update</button>
                                                                </a>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="padding-5">
                                                                <a href="<?php echo base_url() . "/AdminWeb/deleteStatusRed/" . base64_encode("m_link|" . $row->id . "|adminWeb/".$direct); ?>">
                                                                    <button class="btn btn-block btn-danger">Deleted</button>
                                                                </a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- end widget content -->
                    </div>
                    <!-- end widget div -->
                </div>
            </div>
        </div>
        <!-- end row -->
        <!-- row -->
        <div class="row">
            <!-- a blank row to get started -->
        </div>
        <!-- end row -->
    </div>
    <!-- END MAIN CONTENT -->
</div>
<!-- END MAIN PANEL -->
<?php $this->load->view('js'); ?>

<script src="<?php echo base_url() . 'assets/'; ?>js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() . 'assets/'; ?>js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="<?php echo base_url() . 'assets/'; ?>js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="<?php echo base_url() . 'assets/'; ?>js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url() . 'assets/'; ?>js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        pageSetUp();
        /* // DOM Position key index //
         
         l - Length changing (dropdown)
         f - Filtering input (search)
         t - The Table! (datatable)
         i - Information (records)
         p - Pagination (paging)
         r - pRocessing 
         < and > - div elements
         <"#id" and > - div with an id
         <"class" and > - div with a class
         <"#id.class" and > - div with an id and class
         
         Also see: http://legacy.datatables.net/usage/features
         */

        /* BASIC ;*/
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };

        /* COLUMN FILTER  */
        var otable = $('#datatable_fixed_column').DataTable({
            //"bFilter": false,
            //"bInfo": false,
            //"bLengthChange": false
            //"bAutoWidth": false,
            //"bPaginate": false,
            //"bStateSave": true // saves sort state using localStorage
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth": true,
            "order": [[1, 'asc']],
            "oLanguage": {
                "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
            },
            "preDrawCallback": function () {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_datatable_fixed_column) {
                    responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_datatable_fixed_column.respond();
            }

        });
        // custom toolbar
        $("div.toolbar").html('<div class="text-right"></div>');
        // Apply the filter
        $("#datatable_fixed_column thead th input[type=text]").on('keyup change', function () {
            otable
                    .column($(this).parent().index() + ':visible')
                    .search(this.value)
                    .draw();
        });
        /* END COLUMN FILTER */
    })

    function edit(id) {
        $.ajax({
            type: 'post',
            url: "<?php echo base_url(); ?>Auth/getTable/mst_request_doc/",
            dataType: "json",
            data: "id=" + id,
            success: function (data) {
                if (data == 'kosong') {
                    $('#nama').val('Salah');
                } else {
                    $.each(data, function (i, n) {
                        $('#title').val(n['title']);
                        $('#status').val(n['status']);
                        $('#request_code').val(n['request_code']);
                        $('#request_from').val(n['request_from']);
                        $('#model_proses_id').val(n['model_proses_id']);
                        $('#source_request_id').val(n['source_request_id']);
                        $('#request_to').val(n['request_to']);
                        $('#id').val(n['id']);
                        var mydiv = document.getElementById("linkss");
                        $('#linkss').empty();
                        var aTag = document.createElement('a');
                        aTag.setAttribute('href', "<?php echo base_url('upload/attch/') ?>" + n['file']);
                        aTag.innerHTML = '<i class="fa fa-file-archive-o fa-4x text-success" ></i>';
                        mydiv.appendChild(aTag);
                    });
                }
            },
            error: function (data) {
                alert('Error input data');
            }
        });
    }
</script>
</body>
</html>