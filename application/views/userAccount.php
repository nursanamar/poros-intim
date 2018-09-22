<div class="container">
    <!-- BEGIN PAGE BREADCRUMBS -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="index.html">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Daftak akun PTKIN</span>
        </li>
    </ul>
<!-- BEGIN PAGE CONTENT INNER -->
<div class="page-content-inner">
    <div class="row">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">List User</span>
                </div>
            </div>
            <div class="portlet-body">
                <table id="tableAll" class="table table-striped table-bordered table-hover table-header-fixed">
                    <thead>
                        <td>PTKIN</td>
                        <td>Username</td>
                        <td>Aksi</td>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<!-- END PAGE CONTENT INNER -->
</div>

<script>

    $(document).ready(function () {
        $('#tableAll').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo site_url('ADashboard/usertable') ?>",
                type: "POST"
            },
            columns: [

                { data: "nama_ptkin", name: "nama_ptkin" },
                { data: "username", name: "username" },
                { data: "aksi", name: "aksi", orderable: false, searchable: false },
            ]
        });
    })
</script>