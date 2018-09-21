

<div class="container">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="index.html">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Tabel Pendaftar</span>
        </li>
    </ul>
    <div class="page-content-inner">
        <div class="row">
            <div class="col-md-12">
                <?php echo anchor('ADashboard/excelPeserta/'.$this->uri->segment(3), 'Export Excel', array('class'=>'btn btn-sm btn-primary')) ?>
                <div style="height: 25px"></div>
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">List Data Peserta</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-header-fixed" id="tableAll">
                            <thead>
                                <tr class="">
                                    
                                    <th> Nim </th>
                                    <th> Nama </th>
                                    <th> Jurusan </th>
                                    <th> Fakultas </th>
                                    <th> Cabang </th>
                                    <th> Jenis </th>
                                    <th> Dokumen </th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT INNER -->
</div>
<script>

    $(document).ready(function(){
        $('#tableAll').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "<?php echo site_url('ADashboard/tabelPeserta/').$this->uri->segment(3) ?>",
                        type: "POST"
                    },
                    columns: [
                       
                        { data: "nim", name: "nim" },
                        { data: "nama", name: "nama" },
                        { data: "jurusan", name: "jurusan" },
                        { data: "fakultas", name: "fakultas" },
                        { data: "nama_cabang", name: "nama_cabang" },
                        { data: "jenis", name: "jenis" },
                        { data: "dokumen", name: "dokumen",orderable:false, searchable: false },
                    ]
                });
    })
</script>
